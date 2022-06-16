<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
 * Class AuthGuard
 */
class SuperAdminGuard implements FilterInterface
{
    /**
     * Check if the user is a super admin
     * @param RequestInterface $request
     * @param null $arguments
     * @return \CodeIgniter\HTTP\RedirectResponse|mixed|void
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
     * @return mixed|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //not used
    }
}
