<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkBreedToPark;
use App\Models\Breed;
use App\Models\Park;
use Illuminate\Http\JsonResponse;
use App\Services\DogApiService;
use Illuminate\Support\Facades\Redis;

/**
 * Used to get breed of dogs from DogApiService (curl call)
 */
class BreedController extends Controller
{
    /**
     * @var DogApiService
     */
    protected $dogApi;

    /**
     * @param DogApiService $dogApi
     */
    public function __construct(DogApiService $dogApi)
    {
        $this->dogApi = $dogApi;
    }

    /**
     * Get all breeds
     * @param Breed $breedModel
     * @return JsonResponse
     * @throws \JsonException
     */
    public function index(Breed $breedModel): JsonResponse
    {
        // could use hgetall if i had more time
        $breeds = json_decode(Redis::get('breeds'));

        // cache breeds to Redis, also could set time as const in class or make a service
        if (!$breeds) {
            // utilise service macro of dogApi
            $breeds = $this->dogApi->allBreeds();

            // could utilise hmset for arrays if there was more time
            Redis::set('breeds', json_encode($breeds, JSON_THROW_ON_ERROR));

            // new call made so save all breeds and sub breeds
            $breedModel->saveAllBreeds($breeds);
        }

        // return breeds loosely following jsonapi.org for now
        if ($breeds) {
            return response()->json([
                'data' => $breeds
            ]);
        }

        return response()->json(['error' => 'Failed to fetch breeds'], 500);
    }

    /**
     * Get a specific breed by ID
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $breeds = $this->dogApi->getBreedTypesById($id);

        if ($breeds) {
            return response()->json([
                'data' => $breeds
            ]);
        }

        return response()->json(['error' => 'Failed to fetch breed'], 500);
    }

    /**
     * Get an image by breed ID
     * @param string $id
     * @return JsonResponse
     */
    public function image(string $id): JsonResponse
    {
        $imageUrl = $this->dogApi->getBreedImageById($id);

        if ($imageUrl) {
            return response()->json([
                'data' => ['image' => $imageUrl]
            ]);
        }

        return response()->json(['error' => 'Failed to fetch breed'], 500);
    }

    /**
     * Get random breed image
     * @return JsonResponse
     */
    public function getRandomDogImage(): JsonResponse
    {
        $imageUrl = $this->dogApi->getRandomImage();

        if ($imageUrl) {
            return response()->json([
                'data' => ['image' => $imageUrl]
            ]);
        }

        return response()->json(['error' => 'Failed to fetch dog image'], 500);
    }

    public function linkBreedToPark(LinkBreedToPark $request, int $parkId): JsonResponse
    {
        $park = Park::findOrFail($parkId);
        $breed = Breed::firstOrCreate(['name' => $request->get('name')]);
        $park->breeds()->attach($breed);

        return response()->json([
            'message' => 'Breed linked to the park successfully.',
            'data' => ['park' => $park, 'breed' => $breed]
        ]);
    }
}
