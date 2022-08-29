<?php

namespace App\Controllers;

use App\Models\AgirModel;
use App\Models\SaadModel;
use App\Models\SecteurModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;
use ReflectionException;


/**
 * SecteurLinkController
 */
class SecteurLinkController extends Controller
{

    private $agirModel;
    private $saadModel;
    private $secteurModel;

    public function __construct()
    {
        $this->agirModel = new AgirModel();
        $this->saadModel = new SaadModel();
        $this->secteurModel = new SecteurModel();
    }

    /**
     * Charge les composants de la page permettant de lier les secteurs
     * @param $idSaad l'id du saad dont on veut lier les secteurs
     */
    public function secteurLink($idSaad)
    {
        // on récupère la liste des secteurs
        $secteurs = $this->secteurModel->getSecteurs();

        foreach ($secteurs as $key => $saad) {
            // on récupère la liste des secteurs liés à ce saad sous forme de tableau d'id
            $ids = $this->agirModel->getSaadsIdsFromSecteurId($saad['id']);
            $secteurs[$key]['idsSaads'] = $ids;
        }

        //on récupère les secteurs du saad sélectionné
        $saadSecteur = $this->agirModel->getSecteursIdsFromSaadId($idSaad);
        $saadSecteurs = [];
        if ($saadSecteur) {
            $saadSecteurs =$this->secteurModel->getSecteursByIds($saadSecteur);
        }


        $data = [
            'secteurs' => $secteurs,
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
     * @throws ReflectionException
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
        return redirect()->to('secteurLinkController/secteurLink/' . $idSaad);
    }

    /** Supprime les liens entre une personne et les saads
     * @param $idPersonne number - L'id de la personne dont on veut supprimer les liens
     */
    public function deleteAllLinks($idPersonne): RedirectResponse
    {
        $this->agirModel->deleteAllLinks($idPersonne);
        return redirect()->to('secteurLinkController/secteurLink/' . $idPersonne);
    }


}