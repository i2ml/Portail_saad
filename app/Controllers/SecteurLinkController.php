<?php

namespace App\Controllers;

use App\Models\AgirModel;
use App\Models\SaadListModel;
use App\Models\SaadModel;
use App\Models\SecteurModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Router\Exceptions\RedirectException;
use ReflectionException;


/**
 * SecteurLinkController
 */
class SecteurLinkController extends Controller
{

    private $agirModel;
    private $saadModel;
    private $secteurModel;
    private $saadListModel;

    public function __construct()
    {
        $this->agirModel = new AgirModel();
        $this->saadModel = new SaadModel();
        $this->secteurModel = new SecteurModel();
        $this->saadListModel = new SaadListModel();
    }

    /**
     * Charge les composants de la page permettant de lier les secteurs
     * @param $idSaad l'id du saad dont on veut lier les secteurs
     */
    public function secteurLink($idSaad) : void
    {
        # avant tout on doit vérifier que le saad est bien lié à l'utilisateur connecté (ou qu'il est super admin)
        if (!$this->saadListModel->isAuthenticatedOnSaad($idSaad, session()->get('id'))) {
            echo view('header');
            echo view('forbidden');
            echo view('footer');
            return;
        }

        // on récupère la liste des secteurs
        $secteurs = $this->secteurModel->getSecteurs();

        foreach ($secteurs as $key => $secteur) {
            // on récupère la liste des secteurs liés à ce saad sous forme de tableau d'id
            $ids = $this->agirModel->getSaadsIdsFromSecteurId($secteur['id']);
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
        # avant tout on doit vérifier que le saad est bien lié à l'utilisateur connecté (ou qu'il est super admin)
        if (!$this->saadListModel->isAuthenticatedOnSaad($idSaad, session()->get('id'))) {
            return redirect()->to('/forbidden');
        }
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
     * @param $idSaad number - L'id de la personne dont on veut supprimer les liens
     */
    public function deleteAllLinks($idSaad): RedirectResponse
    {
        # avant tout on doit vérifier que le saad est bien lié à l'utilisateur connecté (ou qu'il est super admin)
        if (!$this->saadListModel->isAuthenticatedOnSaad($idSaad, session()->get('id'))) {
            return redirect()->to('/forbidden');
        }
        $this->agirModel->deleteAllLinks($idSaad);
        return redirect()->to('secteurLinkController/secteurLink/' . $idSaad);
    }


}