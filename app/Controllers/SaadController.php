<?php namespace App\Controllers;

use App\Models\ActualitesModel;
use App\Models\SaadModel;
use CodeIgniter\Controller;

class SaadController extends Controller
{
    public function index()
    {
        $model = new SaadModel();

        $data = [
            'saads' => $model->getSaads(),
            'title' => 'Liste des Saads',
        ];

        echo view('header', $data);
        echo view('saads', $data);
        echo view('footer', $data);
    }



}