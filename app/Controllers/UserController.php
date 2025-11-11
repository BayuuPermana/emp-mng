<?php

namespace App\Controllers;

use App\Models\User;

// TODO: This controller uses server-side rendering, which is inconsistent with the
// Vue.js-based dashboard. This was done for simplicity and to meet the initial
// requirements. A future refactor should move this functionality to a RESTful API
// and a set of Vue.js components to create a more consistent architecture.
class UserController extends BaseController
{
    public function index()
    {
        $userModel = new User();
        $builder = $userModel->builder();

        $search = $this->request->getGet('search');
        $role = $this->request->getGet('role');

        if ($search) {
            $builder->like('username', $search);
        }

        if ($role) {
            $builder->where('role', $role);
        }

        $users = $builder->get()->getResultArray();

        return view('user_management', ['users' => $users]);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $userModel = new User();
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'     => $this->request->getPost('role'),
            ];

            if ($userModel->save($data)) {
                return redirect()->to('/admin/users');
            }
        }

        return view('user_form');
    }

    public function edit($id)
    {
        $userModel = new User();
        $user = $userModel->find($id);

        if ($this->request->getMethod() === 'post') {
            $data = [
                'username' => $this->request->getPost('username'),
                'role'     => $this->request->getPost('role'),
            ];

            if ($this->request->getPost('password')) {
                $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            }

            if ($userModel->update($id, $data)) {
                return redirect()->to('/admin/users');
            }
        }

        return view('user_form', ['user' => $user]);
    }

    public function delete($id)
    {
        $userModel = new User();
        $userModel->delete($id);

        return redirect()->to('/admin/users');
    }
}
