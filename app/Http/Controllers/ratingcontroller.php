<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Resep;
use App\Models\User;
use App\Models\TempUser;
use Illuminate\Support\Facades\Validator;
Use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ratingcontroller extends Controller
{
     public function store(Request $request, $id)
    {
        $resep = Resep::find($id);
        $user = TempUser::first();
        if (!$resep) {
            return response()->json(['message' => 'Resep not found'], 404);
        }

        
       
        $existingRating = Rating::where('user_id', $user->user_id)
                                 ->where('resep_id', $id)
                                 ->first();

        if ($existingRating) {
            return response()->json(['message' => 'User has already rated this resep'], 422);
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $rating = Rating::create([
            'user_id' => $user->user_id,
            'resep_id' => $id,
            'rating' => $request->rating,
        ]);


        return response()->json(['data' => $rating], 201);
    }
}
