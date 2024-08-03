<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Park;
use App\Models\Breed;

class UserController extends Controller
{
    /**
     * Associate a park or breed with a user.
     */


     public function getAssociateUser(Request $request, $id)
     {
         $user = User::findOrFail($id);
         
         $type = $request->input('type');
         $typeId = $request->input('type_id');
 
         
 
         if ($type === 'park') {
            $park = Park::findOrFail($typeId);
            $user->parks()->attach($park->id);
        } elseif ($type === 'breed') {
            $breed = Breed::findOrFail($typeId);
            $user->breeds()->attach($breed->id);
        }
 
         
 
         return response()->json(['message' => 'Association created successfully']);
     }
     
}
