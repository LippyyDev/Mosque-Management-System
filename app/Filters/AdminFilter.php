<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Cek apakah user sudah login
        if (!$session->get('logged_in')) {
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu untuk mengakses halaman admin.');
            return redirect()->to('/auth/login');
        }
        
        $userData = $session->get('user_data');

        // Cek apakah user memiliki role admin
        if (empty($userData) || !isset($userData['role']) || $userData['role'] !== 'Admin') {
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke halaman admin. Hanya admin yang dapat mengakses halaman ini.');
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