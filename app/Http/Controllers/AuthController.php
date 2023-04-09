<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\TempUser;
Use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {        
        // $request->user()->id,
        $user_id = Auth::id();
        $user = User::where('email',$request->email)->first();

        // if($user::Where('user_id',$request->user_id)){
        //     return response();
        // }
        if(!$user){
            return response()->json(['ERROR'=>'USER NOT FOUND.'],401);
        }
        if(!Hash::check($request->password,$user->password)){
            return response()->json(['error'=>'LOGIN FAILED'],401);
        }
        else{
            auth()->login($user);
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            $response=[
                'massage'=>'LOGIN Successfull',
                'token' => $token
            ];
            $temp = TempUser::create([
                // $temp->user_id = request()->user()->id,
                $user_id = request()->user()->id,
                'user_email'=> $token->name,
                'user_id'=> $token->id,
                // 'user_id' => $request->user_id,
                'user_id' => $request->user()->id,
            ]);
            
            return response()->json($response, 200);
        }
        
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validatedData = Validator::make($request->all(),[
            'namauser' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
            'bio' => ['required', 'string'],
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try{ $user = User::create([
            'namauser' => $request->namauser,
            'email' => $request->email,
            'password' => hash::make($request->password),
            'bio' => $request->bio,
        ]);
        $user->save();
        $response=[
            'massage'=>'Register Successfull'
        ];
        return response()->json($response,Response::HTTP_CREATED);
    }
       
    catch(QueryException $e){
      
        return response()->json([
            'message'=> 'Register Failed' 
        ]);}
    }
    
}