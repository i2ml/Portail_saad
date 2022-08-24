<?php

namespace App\Filters;

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
 * Class SuperAdminGuard
 */
class SuperAdminGuard implements FilterInterface
{
    /**
     * Check if the user is a super admin
     * @param RequestInterface $request
     * @param null $arguments
     * @return RedirectResponse|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('accountType') !== SUPER_ADMIN) {
            return redirect()
                ->to('/connexionReussie');
        }
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param null $arguments
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //not used
    }
}
