<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
    
        if (!auth()->attempt($loginData)) {
    
            return response([
                'response' => 'Invalid Credentials',
                'message' => 'error'
            ]);
        }
    
        $accessToken = auth()->user()->createToken('authToken') -> accessToken;
    
        return response([
            'profile' =>auth()->user(),
            'accessToken' => $accessToken,
            'message' => 'success'
        ]);
    } 
}

