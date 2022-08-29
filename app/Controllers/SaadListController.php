<?php

namespace App\Controllers;

use App\Models\PersonneModel;
use App\Models\SaadListModel;
use App\Models\SaadModel;
use CodeIgniter\Controller;
use ReflectionException;

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
            $saads[$key]['noms'] = $personneModel->getPersonnesNameFromIds($ids);
        }


        //on récupère les saads de l'utilisateur sélectionné
        $saadUser = $saadListModel->getSaadIdsFromPersonId($idPersonne);
        $userSaads = [];
        if ($saadUser) {
            $userSaads = $saadModel->getSaadsByIds($saadUser);
        }


        $data = [
            'saads' => $saads,
            'user' => $personneModel->getPersonnebyid($idPersonne),
            'currentSaadList' => $userSaads,
        ];

        $sendMail = new MailController();
        $sendMail->sendMail($personneModel->getPersonnebyid($idPersonne)['mail'],'Affectation de SAAD','Des changements ont eu lieu sur les SAAD que vous gérez, n\'hésitez pas à aller voir les modifications.');

        echo view('header');
        echo view('saadLink', $data);
        echo view('footer');
    }

    /**
     * Permet de lier un ou plusieurs saads à une personne
     * @throws ReflectionException
     */
    public function editSaadLink($idPersonne)
    {

        $saadArray = $this->request->getVar('saad');
        $saadListModel = new SaadListModel();
        $saadListModel->deleteAllLinks($idPersonne);
        if (!empty($saadArray)) {
            foreach ($saadArray as $saad) {
                $saadListModel->save(['idPersonne' => $idPersonne, 'idSaad' => $saad]);
            }
        }
        return redirect()->to('saadListController/saadLink/' . $idPersonne);
    }

    /** Supprime les liens entre une personne et les saads
     * @param $idPersonne number - L'id de la personne dont on veut supprimer les liens
     */
    public function deleteAllLinks($idPersonne)
    {
        $saadListModel = new SaadListModel();
        $saadListModel->deleteAllLinks($idPersonne);
        return redirect()->to('saadListController/saadLink/' . $idPersonne);
    }
}