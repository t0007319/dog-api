<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class DogApiService
{
    /**
     * @var PendingRequest
     */
    private $client;

    public function __construct()
    {
        $this->client = Http::dogApi();
    }

    /**
     * @throws \JsonException
     */
    private function transformResponse(Response $response)
    {
        $data = json_decode(
            $response->getBody(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        if ($data['status'] === 'success') {
            return $data['message'];
        }

        return null;
    }

    public function allBreeds()
    {
        $response = $this->client->get('breeds/list/all');
        return $this->transformResponse($response);
    }

    public function getBreedTypesById($id)
    {
        $response = $this->client->get("breed/$id/list");
        return $this->transformResponse($response);
    }

    public function getRandomImage()
    {
        $response = $this->client->get('breeds/image/random');
        return $this->transformResponse($response);
    }

    public function getBreedImageById($id)
    {
        $response = $this->client->get("breed/$id/images/random");
        return $this->transformResponse($response);
    }
}
