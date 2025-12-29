<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during normal execution.
     *
     * @param RequestInterface $request
     * @param array|null $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // jika belum login, arahkan ke halaman login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // jika route memberikan argumen pertama sebagai role, periksa role user
        if (is_array($arguments) && isset($arguments[0]) && $arguments[0] !== '') {
            $requiredRole = $arguments[0];
            $userRole = $session->get('role');

            if ($userRole !== $requiredRole) {
                return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
            }
        }
    }

    /**
     * Allows after filter to inspect and modify the response.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array|null $arguments
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No post-processing required
    }
}
