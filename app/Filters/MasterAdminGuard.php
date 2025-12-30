<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class MasterAdminGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // First check if logged in
        if (! session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'You must be logged in');
        }

        // Then check if master admin
        if (! session()->get('is_master')) {
            return redirect()->to('/dashboard')->with('error', 'Access Denied. Only Master Admin can access this section.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after
    }
}
