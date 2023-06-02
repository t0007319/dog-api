<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssociateTypeRequest;
use App\Models\Breed;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function associateType(AssociateTypeRequest $request, User $userModel): JsonResponse
    {
        $parkId = $request->get('park_id');
        $breed = $request->get('breed');

        if ($parkId) {
            // Associate the park with the user
            $userModel->park()->associate($parkId);
            $userModel->save();
        }

        if ($breed) {
            // Find or create the breed based on the given breed name
            $breedModel = Breed::firstOrCreate(['name' => $breed]);

            // Associate the breed with the user
            $userModel->breeds()->syncWithoutDetaching([$breed->id]);
        }

        return response()->json(['message' => 'Park associated with user successfully']);
    }
}
