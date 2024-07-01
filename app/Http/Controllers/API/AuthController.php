<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Trait\ApiReponse;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    /**
     * login a user of the resource.
     */
    use ApiReponse;
    public function login(LoginRequest $request)
    {
        $request->validated($request->all());
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Invalide credential', 401);
        }
        $user = User::firstWhere('email', $request->email);
        return $this->ok(
            'Authenticated',
            ['token' => $user->createToken('Tickets API tok-en for' . $user->email)->plainTextToken]
        );
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();
    
       // $request->user()->currentAcessToken()->delete();
        return $this->ok('');
    }

    /**
     * register a user of the resource.
     */
    public function register()
    {
        // return $this->Ok('Register');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
