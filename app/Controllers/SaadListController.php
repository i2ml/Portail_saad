<?php

namespace App\Controllers;

use App\Models\PersonneModel;
use App\Models\SaadListModel;
use App\Models\SaadModel;
use CodeIgniter\Controller;

/**
 * SaadListController
 */
class SaadListController extends Controller
{

    /**
     * Charge les composants de la page permettant de lier les saads
     * @param $idPersonne l'id de la personne dont on veut lier les saads
     */
    public function saadLink($idPersonne)
    {
        $model = new SaadModel();
        $saadListModel = new SaadListModel();
        $personneModel = new PersonneModel();

        // on récupère la liste des saads
        $saads = $model->getSaads();

        foreach ($saads as $key => $saad) {
            // on récupère la liste des personnes liées à ce saad sous forme de tableau d'id
            $ids = $saadListModel->getPersonnes($saad['id']);
            $saads[$key]['idsGerants'] = $ids;
            //on récupère les noms des personnes liées à ce saad pour les afficher plus facilement
            $saads[$key]['noms'] = $personneModel->getPersonnesNameFromId($ids);
        }

        $data = [
            'saads' => $saads,
            'user' => $personneModel->getPersonnes($idPersonne),
        ];
        echo view('header');
        echo view('saadLink', $data);
        echo view('footer');
    }


}