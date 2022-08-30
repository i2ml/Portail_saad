<?php

namespace App\Controllers;

use App\Models\PublicModel;

/**
 * Base Controller
 * @package App\Controllers
 */
class Home extends BaseController
{
    private $publicModel;

    public function __construct()
    {
        $this->publicModel = new PublicModel();
    }

    /**
     * Chargeuse de la page d'accueil
     */
    public function index()
    {
        $data['publics'] = $this->publicModel->getPublics();
        echo view('header');
        echo view('welcome_message' , $data);
        echo view('footer');
    }
}
