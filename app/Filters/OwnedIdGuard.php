<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RedirectResponse;
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
     * @return RedirectResponse|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        //this will check if the id of the user is the same as the id of the user in the url
        $idUrl = preg_split("#/#", current_url() )[4];
        if (session()->get('id') !== $idUrl) {
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
