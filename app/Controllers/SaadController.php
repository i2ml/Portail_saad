<?php

namespace App\Controllers;

use App\Models\CiblerModel;
use App\Models\PathologieModel;
use App\Models\PersonneModel;
use App\Models\PublicModel;
use App\Models\SaadListModel;
use App\Models\SaadModel;
use App\Models\SpecialiserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * SaadController
 */
class SaadController extends Controller
{
    private $saadModel;
    private $saadListModel;
    private $personneModel;
    private $publicModel;
    private $pathologieModel;
    private $ciblerModel;
    private $specialiserModel;

    public function __construct()
    {
        $this->saadModel = new SaadModel();
        $this->saadListModel = new SaadListModel();
        $this->personneModel = new PersonneModel();
        $this->publicModel = new PublicModel();
        $this->pathologieModel = new PathologieModel();
        $this->ciblerModel = new CiblerModel();
        $this->specialiserModel = new SpecialiserModel();
    }

    /**
     * Chargeuse de la page de recherche
     */
    public function index()
    {

        $data = [
            'saads' =>  $this->saadModel->getSaads(),
            'publics' =>  $this->publicModel->getPublics(),
            'pathologies' =>  $this->pathologieModel->getPathologies(),
            'title' => 'Liste des Saads',
            'idFiltrer' =>  $this->saadModel->getAllSaadsId(),
        ];

        echo view('header', $data);
        echo view('saads', $data);
        echo view('footer', $data);
    }

    /**
     * Fonction permettant de filtrer les saads
     */
    public function filter()
    {

        $data = [
            'saads' => $this->saadModel->getSaads(),
            'publics' => $this->publicModel->getPublics(),
            'pathologies' => $this->pathologieModel->getPathologies(),
            'title' => 'Liste des Saads',
        ];

        $publicFilter = $this->request->getPost('public[]');
        $pathologieFilter = $this->request->getPost('pathologie[]');
        $idSaadFiltrePathologie = $this->saadModel->getAllSaadsId();
        $idSaadFiltrePublic = $this->saadModel->getAllSaadsId();

        if (is_array($publicFilter)) {
            $idSaadFiltrePublic = $this->ciblerModel->getSaadsIdByIdPublic($publicFilter);
        }
        if (is_array($pathologieFilter)) {
            $idSaadFiltrePathologie = $this->specialiserModel->getSaadsIdByIdPathologie($pathologieFilter);
        }

        $data['pathologieSelectionnee'] = $pathologieFilter;
        $data['publicSelectionne'] = $publicFilter;

        $data['idFiltrer'] = array_intersect($idSaadFiltrePublic, $idSaadFiltrePathologie);

        echo view('header', $data);
        echo view('saads', $data);
        echo view('footer', $data);
    }


    /**
     * Charge les composants de la page lister les saads
     */
    public function saadsList()
    {

        $saads = $this->saadModel->getSaads();
        $saads = $this->loadManagersInSaadListData($saads);
        $this->displaySaadList($saads, false);
    }

    /**
     * Charge les composants de la page lister les saads d'un utilisateur
     * @param number $id L'id de l'utilisateur dont on veut récupérer les saads
     * @return void
     */
    public function mySaadsList($id)
    {
        $saadsIds = $this->saadListModel->getSaadIdsFromPersonId($id);
        $saads = $this->saadModel->getSaadsByIds($saadsIds);
        $saads = $this->loadManagersInSaadListData($saads);
        $this->displaySaadList($saads, true);
    }

    /**
     * Cette fonction permet de supprimer un utilisateur dont l'identifiant est passé en paramètre
     * @param $id L'id de l'utilisateur à supprimer
     * @return RedirectResponse
     */
    public function saadDelete($id): RedirectResponse
    {
        $this->saadModel->deleteImage($id);
        $this->saadModel->deleteLine($id);

        unset($data);
        return redirect()->to('saadsList');
    }

    /**
     * Charge les composants de la page création de gérant de saad
     */
    public function createSaad($id = false)
    {
        helper(['form']);
        $data = [];
        $session = session();
        $data['profil'] = $session->get('nom');
        $data['publics'] = $this->publicModel->getPublics();
        $data['pathologies'] = $this->pathologieModel->getPathologies();
        $data['title'] = 'Admin';
        $data['success'] = null;
        $data['saad'] = $id;
        $data['publicsCible'] = [];
        $data['pathologiesSpecialise'] = [];

        if ($id) {

            $data['saad'] = $this->saadModel->getSaadbyid($id);
            $data['publicsCible'] = $this->ciblerModel->getPublicsIdByIdSaad($id);
            $data['pathologiesSpecialise'] = $this->specialiserModel->getPathologiesIdByIdSaad($id);
        }

        echo view('header');
        echo view('createSaad', $data);
        echo view('footer');
    }

    /**
     * Méthode appelée lorsque l'utilisateur a rentré les informations pour la creation d'un SAAD
     * @return RedirectResponse|void
     * @throws \ReflectionException
     */
    public function storeSaad($id = false)
    {
        helper(['form']);
        $rules = $this->getSaadFormRules();
        //check if the rule are valid
        if ($this->validate($rules)) {

            $data = $this->createSaadFromFormInfo();
            $public = $this->request->getPost('public[]');
            $pathologie = $this->request->getPost('pathologie[]');

            if ($this->request->getFile('image')->getName() != "") {
                $data = $this->saveImageFromFormFile($data);
            }

            if ($id) { //check if the form is an update of an existing SAAD
                $this->updateSaad($id, $data, $pathologie, $public);
                $data['success'] = true;
            } else {
                $id = $this->saadModel->saveSaad($data);
                $this->specialiserModel->saveAll($pathologie, $id);
                $this->ciblerModel->saveAll($public, $id);
            }

            return redirect()->to('/connexionReussie');
        }

        $session = session();
        $data['success'] = false;
        if ($this->request->getMethod() !== 'post') {
            $data['success'] = null;
        }
        $data['profil'] = $session->get('nom');
        $data['validation'] = $this->validator;
        $data['title'] = 'Admin';
        $data['publics'] = $this->publicModel->getPublics();
        $data['pathologies'] = $this->pathologieModel->getPathologies();
        if ($id) {
            $data['saad'] = $this->saadModel->getSaadbyid($id);
            $data['publicsCible'] = $this->ciblerModel->getPublicsIdByIdSaad($id);
            $data['pathologiesSpecialise'] = $this->specialiserModel->getPathologiesIdByIdSaad($id);
        } else {
            $data['saad'] = $id;
            $data['publicsCible'] = [];
            $data['pathologiesSpecialise'] = [];
        }
        echo view('header');
        echo view('createSaad', $data);
        echo view('footer');
    }

    /**
     * @param array $saads : liste des saads à afficher
     * @param bool $mySaadList : true si on affiche la liste de saads de l'utilisateur
     */
    private function displaySaadList(array $saads, bool $mySaadList): void
    {
        $data = [
            'saads' => $saads,
            'isAdmin' => session()->get('accountType') === SUPER_ADMIN,
            'mySaadList' => $mySaadList,
        ];

        echo view('header');
        echo view('saadsList', $data);
        echo view('footer');
    }

    /**
     * @param array $saads The list of saads that we need to search the manager
     * @return array the saads with all information about their managers
     */
    private function loadManagersInSaadListData(array $saads): array
    {
        foreach ($saads as $key => $saad) {
            // on récupère la liste des personnes liées à ce saad sous forme de tableau d'id
            $ids = $this->saadListModel->getPersonIdsFromSaadId($saad['id']);
            $saads[$key]['idsGerants'] = $ids;
            //on récupère les noms des personnes liées à ce saad pour les afficher plus facilement
            $saads[$key]['noms'] = $this->personneModel->getPersonnesNameFromId($ids);
        }
        return $saads;
    }

    /**
     * @return array
     */
    private function getSaadFormRules(): array
    {
        return [
            'nom' => 'required|max_length[100]',
            'tel' => 'max_length[100]|regex_match[/^((\+|00)33\s?|0)[1-9](\s?\d{2}){4}$/]',
            'mail' => 'max_length[100]|valid_email',
            'site' => 'max_length[150]',
            'adresse' => "max_length[300]|regex_match[/^[a-zA-Z0-9\s,'-]*$/]",
            'idCategorie' => 'required',
            'image' => [
                'rules' => 'is_image[image]'
                    . '|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[image,100]'
                    . '|max_dims[image,1024,768]',
            ],
            'pathologie' => 'required',
            'public' => 'required'
        ];
    }

    /**
     * @return array
     */
    private function createSaadFromFormInfo(): array
    {
        return [
            'nom' => $this->request->getVar('nom'),
            'tel' => $this->request->getVar('tel'),
            'mail' => $this->request->getVar('mail'),
            'site' => $this->request->getVar('site'),
            'siret_siren' => $this->request->getVar('siret_siren'),
            'adresse' => $this->request->getVar('adresse'),
            'idCategorie' => $this->request->getVar('idCategorie'),
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    private function saveImageFromFormFile(array $data): array
    {
        $data = $data + ['image' => $this->request->getFile('image')->getName()];
        $file = $this->request->getFile('image');
        $file->store('../../public/images/logosaads', $file->getName());
        return $data;
    }

    /**
     * @param $id
     * @param array $data
     * @param $pathologie
     * @param $public
     * @throws \ReflectionException
     */
    private function updateSaad($id, array $data, $pathologie, $public): void
    {
        $this->saadModel->modifSaads($id, $data);
        $this->specialiserModel->modifSpecialiser($pathologie, $id);
        $this->ciblerModel->modifCibler($public, $id);
    }

}