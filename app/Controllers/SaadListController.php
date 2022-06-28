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
        $saadModel = new SaadModel();
        $saadListModel = new SaadListModel();
        $personneModel = new PersonneModel();

        // on récupère la liste des saads
        $saads = $saadModel->getSaads();

        foreach ($saads as $key => $saad) {
            // on récupère la liste des personnes liées à ce saad sous forme de tableau d'id
            $ids = $saadListModel->getPersonIdsFromSaadId($saad['id']);
            $saads[$key]['idsGerants'] = $ids;
            //on récupère les noms des personnes liées à ce saad pour les afficher plus facilement
            $saads[$key]['noms'] = $personneModel->getPersonnesNameFromId($ids);
        }

        //on récupère les saads de l'utilisateur sélectionné
        $userSaads = $saadModel->getSaadsByIds($saadListModel->getPersonIdsFromSaadId($idPersonne));

        $data = [
            'saads' => $saads,
            'user' => $personneModel->getPersonnes($idPersonne),
            'currentSaadList' => $userSaads,
        ];
        echo view('header');
        echo view('saadLink', $data);
        echo view('footer');
    }


}