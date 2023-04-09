<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\Resep;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\TempUser;
Use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class komentarcontroller extends Controller
{
    public function store(Request $request, $id)
    {
        $user_id = Komentar::find('user_id');
        $resep = Resep::find($id);
        $user = TempUser::first();
        if (!$resep) {
            return response()->json(['message' => 'Resep not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'komentar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $komentar = Komentar::create([
            'resep_id' => $id,
            'komentar' => $request->komentar,
            'user_id' => $request->user()->id,
            // 'user_id' => $request->user_id,
        ]);
        $komentar->save();


        return response()->json(['data' => $komentar], 201);

}
}