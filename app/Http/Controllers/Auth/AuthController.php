<?php

namespace App\Http\Controllers;

use App\User;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;



class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return response()->json([
            'status' => 200,
            'data' => $user,
            'message' => 'you made it',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {
        // try {
        //     $request->validate([
        //     'email' => 'email|required',
        //     'password' => 'required'
        //     ]);
        //     $credentials = request(['email', 'password']);
        //     if (!Auth::attempt($credentials)) {
        //     return response()->json([
        //         'status_code' => 500,
        //         'message' => 'Email or Password is wrong'
        //     ]);
        //     }
        //     $user = User::where('email', $request->email)->first();
        //     if ( ! Hash::check($request->password, $user->password, [])) {
        //     throw new \Exception('Error in Login');
        //     }
        //     $tokenResult = $user->createToken('authToken')->plainTextToken;
        //     return response()->json([
        //         'status_code'=> 200,
        //         'access_token' => $tokenResult,
        //         'token_type' => 'Bearer',
        //     ]);
        // } catch (Exception $error) {
        //     return response()->json([
        //     'status_code' => 500,
        //     'message' => 'Error in Login',
        //     'error' => $error,
        //     ]);
        // }


        Route::post('/sanctum/token', function (Request $request) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'device_name' => 'required',
            ]);
        
            $user = User::where('email', $request->email)->first();
        
            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }
        
            $tokenResult = $user->createToken($request->device_name)->plainTextToken;

            return response()->json([
                    'status_code'=> 200,
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                ]);
            
        });
        // return response()->json([
        //     'status_code'=> 200,
        //     'access_token' => $tokenResult1,
        //     'token_type' => 'Bearer',
        // ]);
    }

    public function register(Request $request){
        // $validation = $this->validate($request, [
        //         'name' => 'required|max:250',
        //         'email' => 'required|email|unique:users,email',
        //         'password' => 'required|min:4',
        //     ]);
        try{

            

            $this->validate($request, [
                'name' => 'required|max:250',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:4',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user = User::where('email', $request->email)->first();

                if (! $user || ! Hash::check($request->password, $user->password)) {
                    throw ValidationException::withMessages([
                        'email' => ['The provided credentials are incorrect.'],
                    ]);
                }

                $tokenResult = $user->createToken($request->device_name)->plainTextToken;

                return response()->json([
                        'status_code'=> 200,
                        'access_token' => $tokenResult,
                        'token_type' => 'Bearer',
                    ]);

            

        } catch(Exception $error){
            return response()->json([
                'status_code' => 500,
                'message' => 'Error big time in register',
                'error' => $error,
                'validation' => 'Probably your email is already in use',
                
            ]);
        }
    }
    
}
