<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Breed;
use App\Models\User;

class BreedController extends Controller
{   
    // To Fetch all the breeds of the Dogs from the 3rd Party API, Used Laravel's HTTP Client to handle API requests
    public function getAllBreeds()
    {
        $response = Http::get('https://dog.ceo/api/breeds/list/all');
        //$breeds = $response->json()['message'];
        $breeds = $response->json();

        return response()->json($breeds);
    }

    // Fetch data of a specific breed by its ID.
    public function getBreed($id)
    {
        $response = Http::get("https://dog.ceo/api/breed/$id/list");
        $breed = $response->json();

        //$breed = Breed::with(['users', 'parks'])->findOrFail($id);
        
        return response()->json($breed);
    }

    // Fetch random images of breeds
    public function getRandomBreed()
    {
        $response = Http::get('https://dog.ceo/api/breeds/image/random');
        $breed = $response->json();

        return response()->json($breed);
    }

    // Fetch a random image of a specific breed by its ID.
    public function getBreedImage($id)
    {
        $response = Http::get("https://dog.ceo/api/breed/$id/images/random");
        $image = $response->json();

        return response()->json($image);
    }

    // Update the breed list from the external API and synchronize it with the database.
    public function getAllBreedsCronJob()
    {
        $response = Http::get('https://dog.ceo/api/breeds/list/all');
        
        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch breeds'], 500);
        }

        $breedsData = $response->json()['message'];

        // Flatten the breeds data to get all breeds and sub-breeds and combine them as single Name as Sub-bread Breed to store in DB
        $breedsFromApi = [];
        foreach ($breedsData as $breed => $subbreeds) {
            if (empty($subbreeds)) {
                $breedsFromApi[] = $breed;
            } else {
                foreach ($subbreeds as $subbreed) {
                    $breedsFromApi[] = "$subbreed $breed";
                }
            }
        }

        // Fetching existing breeds from the database to cross check with the API data
        $existingBreeds = Breed::pluck('name')->toArray();

        // Comparing the API data with the DB data to find the difference
        $breedsToAdd = array_diff($breedsFromApi, $existingBreeds);
        $breedsToDelete = array_diff($existingBreeds, $breedsFromApi);

        // Add the new Breeds missing in the DB
        foreach ($breedsToAdd as $breed) {
            Breed::create(['name' => $breed]);
        }

        // Deleting the Breeds from the DB
        Breed::whereIn('name', $breedsToDelete)->delete();

        return response()->json(['message' => 'Breeds updated successfully']);
    }

    // Display a specific breed along with its associated users and parks.
    public function show(Breed $breed)
    {
        $breed->load(['users', 'parks']);

        return response()->json([
            'breed' => $breed,
            'users' => $breed->users,
            'parks' => $breed->parks,
        ]);
    }

}
