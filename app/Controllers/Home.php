<?php

namespace App\Controllers;

/**
 * Base Controller
 * @package App\Controllers
 */
class Home extends BaseController
{

    /**
     * Chargeuse de la home page
     */
    public function index()
    {
        echo view('header');
        echo view('welcome_message');
        echo view('footer');
    }
}
