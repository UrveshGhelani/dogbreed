<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Park;
use App\Models\Breed;

class ParkController extends Controller
{
    /**
     * Associate a breed with a park.
     *
     */   

    public function getAssociateBreed(Request $request, $id)
    {
        $park = Park::findOrFail($id);

        $breedId = $request->input('breed_id');
        $breed = Breed::findOrFail($breedId);

        // Attach the breed to the park
        $park->allowedBreeds()->attach($breed->id);

        return response()->json(['message' => 'Breed associated with park successfully'], 200);
    }

    
}
