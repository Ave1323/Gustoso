<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
Use Illuminate\Database\QueryException;
Use Symfony\Component\HttpFoundation\Response;
use App\Models\Resep;
use App\Models\Bda;

class resepcontroller extends Controller
{
    public function tambah(Request $request)
    {
        $validatedData = Validator::make($request->all(),[
            'namaresep' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'waktuproses' => ['required', 'numeric'],
            'views' => ['required', 'numeric'],
            'resep_id' => ['required', 'numeric'],
            'caramembuat' => ['required', 'string'],
            'bahan'=>['required'],
            'alat'=>['required',]
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try{ 
            $resep = Resep::create([
                'namaresep' => $request->namaresep,
                'deskripsi' => $request->deskripsi,
                'waktuproses' => $request->waktuproses,
                'views' => $request->views,
                'resep_id' => $request->resep_id,
                'caramembuat' => $request->caramembuat,
            ]);
            $resep->save();

            $resep_id = $resep->resep_id;

            $bda = Bda::create([
                'alat' => $request->alat,
                'bahan' => $request->bahan,
                'resep_id' => $resep_id
            ]);
            $bda->save();

            $response=[
                'massage'=>'Resep Created Successfull',
                'data'=> $resep.$bda,
            ];
            return response()->json($response,200);
        }       
        catch(QueryException $e){
            return $e;
      
        return response()->json([
            'message'=> $e 
            ]);}
        }
}