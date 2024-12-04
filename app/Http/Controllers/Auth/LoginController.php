<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function login(Request $request) 
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
            'X-API-KEY' => 'restapi123'
        ];

        api_data_post($_ENV['API_URL']."/login", $data);

    }

    public function register(Request $request) 
    {
        $data = [
            'email' => $request->email,
            'username' => $request->username,
            'company' => $request->company,
            'image' => $request->image,
            'password' => $request->password,
            'X-API-KEY' => 'restapi123'
        ];

        api_data_post($_ENV['API_URL']."/register", $data);

    }

    public function set_login(string $email){

		$userData = json_decode(api_data_get($_ENV['API_URL'].'/login?email='.$email.'&X-API-KEY=restapi123'));

		$data = [
			'email' => $userData->data[0]->email,
			'user_id' => $userData->data[0]->id,
			'name' => $userData->data[0]->name,
			'role_id' => $userData->data[0]->role_id,
		];

        Session::put('data', $data);

		// print_r(Session::get('data')['email']);
		
		return redirect()->intended('/dashboard');
	}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
