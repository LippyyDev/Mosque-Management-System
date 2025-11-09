<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class UserFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Cek apakah user sudah login
        if (!$session->get('logged_in')) {
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu untuk mengakses halaman user.');
            return redirect()->to('/auth/login');
        }
        
        $userData = $session->get('user_data');
        
        // Cek apakah user memiliki role user
        if (empty($userData) || !isset($userData['role']) || $userData['role'] !== 'User') {
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke halaman user. Hanya user yang dapat mengakses halaman ini.');
            // Hancurkan sesi yang salah dan redirect ke login
            $session->destroy();
            return redirect()->to('/auth/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
} 