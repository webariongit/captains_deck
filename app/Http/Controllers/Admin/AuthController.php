<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;



# 
use App\Models\User;

class AuthController extends Controller
{
    /**
     * login
     */
    //  public function login(Request $request){
    //     try {
    //         $validatedData = $request->validate([
    //             'email' => 'required|email:rds,dns',
    //             'password' => 'required'
    //         ],
    //         [
    //             'email.dns' => 'Email format is not valid',
    //             'email.rds' => 'Email format is not valid',
    //         ]);
        
    //         $user = User::where('email',$request->email)->where('user_type', 'admin')->first();
    //             if($user){
    //                 if (Hash::check($request->password, $user->password)) {
    //                     $token = JWTAuth::fromUser($user);
    //                     User::where('email',$validatedData['email'])->update([
    //                         'online' => 1,
    //                         'remember_token'=> $token
    //                     ]);
    //                 } else {
    //                     return response()->json(['message' => 'Entered password is incorrect', "status" => 400], 400);
    //                 }
    //             }else{
    //                  return response()->json(['message' => 'Email is incorrect', "status" => 400], 400);
    //             }
    //     } catch (ValidationException $exception) {
    //         $errors = $exception->errors();
    //         return response()->json(['message' => 'Validation failed', 'errors' => $errors, "status" => 400], 400);
    //     }
    // }

    /**
     * login.
     */
    public function login(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
            $user = User::where('email', $validatedData['email'])->first();
            if ($user && Hash::check($validatedData['password'], $user->password)) {
                $token = JWTAuth::fromUser($user);
                return response()->json(['token' => $token, 'user' => $user]);
            }
            return response()->json(['message' => 'Invalid credentials'], 401);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors(), 'status' => 400], 400);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred during login', 'status' => 500], 500);
        }
    }

    /**
     * changePassword.
     */
    public function changePassword(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:6',
                'confirm_password' => 'required|string|min:6|confirmed',
            ]);
            $user = auth()->user();
            if (Hash::check($validatedData['current_password'], $user->password)) {
                $user->update([
                    'password' => bcrypt($validatedData['new_password']),
                ]);
                return response()->json(['message' => 'Password changed successfully']);
            }
            return response()->json(['message' => 'Invalid current password'], 401);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors(), 'status' => 400], 400);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while changing the password', 'status' => 500], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
