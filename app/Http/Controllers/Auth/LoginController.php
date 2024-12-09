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
        $filename = '';
        $image = $request->image;
		if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = $request->username_reg.'-'.$request->company_name_reg.'.'.$extenstion;
            $file->move('assets/images/company/', $filename);
        }

        $data = [
            'email' => $request->email_reg,
            'phone_number' => $request->phone_reg,
            'username' => $request->username_reg,
            'company' => $request->company_name_reg,
            'image' => $filename,
            'password' => $request->password_reg,
            'X-API-KEY' => 'restapi123'
        ];

        api_data_post($_ENV['API_URL']."/register", $data);

    }

    public function set_register(string $token){
        
		$userData = json_decode(api_data_get($_ENV['API_URL'].'/register?token='.$token.'&X-API-KEY=restapi123'));
		
		return redirect()->intended('/login');
	}

    public function set_login(string $email){

		$userData = json_decode(api_data_get($_ENV['API_URL'].'/login?email='.$email.'&X-API-KEY=restapi123'));

		$data = [
			'email' => $userData->data[0]->email,
			'user_id' => $userData->data[0]->id,
			'username' => $userData->data[0]->username,
			'company_id' => $userData->data[0]->company_id,
			'company_name' => $userData->data[0]->company_name,
			'address' => $userData->data[0]->address,
			'logo' => $userData->data[0]->logo,
			'role_id' => $userData->data[0]->role_id,
			'is_active' => $userData->data[0]->is_active,
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
