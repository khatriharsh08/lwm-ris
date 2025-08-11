<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('admin/auth/login');
    }

    public function auth()
    {

        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[5]',
        ];

        if (! $this->validate($rules)) {
            return view('admin/auth/login', [
                'validation' => $this->validator,
            ]);
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        $userModel = new UserModel();
        $user = $userModel->where('email',$email)->first();

        if($user){
	        if (password_verify($password, $user['password'])) {
	            session()->set([
	            	'logged_in'=> true,
	            	'user_id' => $user['id'],
	            	'user_role' => $user['role'],
	            	'user_name' => $user['name'],
	            	'user_email' => $user['email'],
                    'user_photo' => $user['profile_photo'],
	            ]);

                // echo "<pre>"; print_r(session());die();
	            return redirect()->to('/dashboard');
	        } else {
	            return redirect()->back()->with('error', 'Incorrect password');
	        }
	    }else{
	    	return redirect()->back()->with('error','Email not found');
	    }
    }
    public function logout(){
    	session_destroy();
    	return redirect()->to('login');
    }
}
