<?php

namespace App\Controllers;

use App\Models\AgirModel;
use App\Models\SaadModel;
use App\Models\SecteurModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;


/**
 * SecteurLinkController
 */
class SecteurLinkController extends Controller
{

    private $agirModel;
    private $saadModel;
    private $secteurModel;

    public function _construct()
    {
        $this->agirModel = new AgirModel();
        $this->saadModel = new SaadModel();
        $this->secteurModel = new SecteurModel();
    }

    /**
     * Charge les composants de la page permettant de lier les secteurs
     * @param $idSaad l'id du saad dont on veut lier les secteurs
     */
    public function linkSecteur($idSaad)
    {
        // on récupère la liste des secteurs
        $secteur = $this->secteurModel->getSecteur();

        foreach ($secteur as $key => $saad) {
            // on récupère la liste des secteurs liés à ce saad sous forme de tableau d'id
            $ids = $this->agirModel->getSaadsIdsFromSecteurId($saad['id']);
            $secteur[$key]['idsSaads'] = $ids;
        }

        //on récupère les secteurs de la saad sélectionné
        $saadSecteurs[] = $this->secteurModel->getSecteurFromIds($secteur[$idSaad]['idsSaads']);

        $data = [
            'secteur' => $secteur,
            'saad' => $this->saadModel->getSaadById($idSaad),
            'currentSecteurList' => $saadSecteurs,
        ];

        echo view('header');
        echo view('secteurLink', $data);
        echo view('footer');
    }

    /**
     * Permet de lier un ou plusieurs secteurs à une personne
     * @param $idSaad L'id du saad dont on veut éditer les liens vers les secteurs
     */
    public function editSecteurLink($idSaad): RedirectResponse
    {
        $secteurArray = $this->request->getVar('secteur');
        $this->agirModel->deleteAllLinks($idSaad);
        if (!empty($secteurArray)) {
            foreach ($secteurArray as $secteur) {
                $this->agirModel->save(['idSaad' => $idSaad, 'idSecteur' => $secteur]);
            }
        }
        return redirect()->to('saadListController/saadLink/' . $idSaad);
    }

    /** Supprime les liens entre une personne et les saads
     * @param $idPersonne number - L'id de la personne dont on veut supprimer les liens
     */
    public function deleteAllLinks($idPersonne): RedirectResponse
    {
        $this->agirModel->deleteAllLinks($idPersonne);
        return redirect()->to('saadListController/saadLink/' . $idPersonne);
    }


}