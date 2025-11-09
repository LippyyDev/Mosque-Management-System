<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function login()
    {
        $session = session();
        
        // Jika sudah login, redirect ke dashboard sesuai role
        if ($session->get('logged_in')) {
            if ($session->get('role') == 'Admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/user/dashboard');
            }
        }

        $data = [];
        
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];

            if ($this->validate($rules)) {
                $userModel = new UserModel();
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                
                $user = $userModel->verifyPassword($username, $password);
                
                if ($user) {
                    $sessionData = [
                        'user_id'   => $user['id'],
                        'logged_in' => true,
                        'role'      => $user['role'],
                        'user_data' => [
                            'id'           => $user['id'],
                            'username'     => $user['username'],
                            'nama_lengkap' => $user['nama_lengkap'],
                            'role'         => $user['role'],
                            'foto_profil'  => $user['foto_profil'],
                        ],
                    ];
                    
                    $session->set($sessionData);
                    
                    // Redirect berdasarkan role
                    if ($user['role'] === 'Admin') {
                        return redirect()->to('/admin/dashboard');
                    }
                    
                    return redirect()->to('/user/dashboard');
                } else {
                    $data['error'] = 'Username atau password salah';
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('auth/login', $data);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    // Middleware untuk mengecek apakah user sudah login
    public function checkAuth()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/auth/login');
        }
    }

    // Middleware untuk mengecek role admin
    public function checkAdmin()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('user_data')['role'] !== 'Admin') {
            return redirect()->to('/auth/login');
        }
    }

    // Middleware untuk mengecek role user
    public function checkUser()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('user_data')['role'] !== 'User') {
            return redirect()->to('/auth/login');
        }
    }
}

