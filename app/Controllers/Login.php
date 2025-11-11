<?php

namespace App\Controllers;

// TODO: This is a simplified authentication system for demonstration purposes
// and is not production-ready. It lacks features like password recovery,
// rate limiting, and robust session management.
class Login extends BaseController
{
    public function index()
    {
        return view('login_form');
    }

    public function attemptLogin()
    {
        $session = session();
        $userModel = new \App\Models\User();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set('isLoggedIn', true);
            $session->set('roles', [$user['role']]);
            return redirect()->to('/admin/users');
        }

        return redirect()->back()->with('error', 'Invalid username or password.');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/login');
    }
}
