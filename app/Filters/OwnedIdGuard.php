<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Class OwnedIdGuard
 */
class OwnedIdGuard implements FilterInterface
{
    /**
     * Check if the is giving to the function arguments his own id and not the id of someone else
     * @param RequestInterface $request
     * @param null $arguments
     * @return \CodeIgniter\HTTP\RedirectResponse|mixed|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        //this will check if the id of the user is the same as the id of the user in the url
        if (session()->get('id') !== preg_split("#/#", $_SERVER['REQUEST_URI'] )[2]) {
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
