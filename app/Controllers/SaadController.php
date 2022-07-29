<?php
namespace App\Controllers;

use App\Models\CiblerModel;
use App\Models\PathologieModel;
use App\Models\PublicModel;
use App\Models\PersonneModel;
use App\Models\SaadListModel;
use App\Models\SaadModel;
use App\Models\SpecialiserModel;
use CodeIgniter\Controller;

/**
 * SaadController
 */
class SaadController extends Controller
{

    /**
     * Chargeuse de la page de recherche
     */
    public function index()
    {
        $model = new SaadModel();
        $modelPublic = new PublicModel();
        $modelPathologie = new PathologieModel();

        $data = [
            'saads' => $model->getSaads(),
            'publics' => $modelPublic->getPublics(),
            'pathologies' => $modelPathologie->getPathologies(),
            'title' => 'Liste des Saads',
            'idFiltrer' => $model->getAllSaadsId(),
        ];

        echo view('header', $data);
        echo view('saads', $data);
        echo view('footer', $data);
    }

    public function filter()
    {
        $model = new SaadModel();
        $modelPublic = new PublicModel();
        $modelPathologie = new PathologieModel();
        $modelCibler = new CiblerModel();
        $modelSpecialiser = new SpecialiserModel();

        $data = [
            'saads' => $model->getSaads(),
            'publics' => $modelPublic->getPublics(),
            'pathologies' => $modelPathologie->getPathologies(),
            'title' => 'Liste des Saads',
        ];

        $publicFilter = $this->request->getPost('public[]');
        $pathologieFilter = $this->request->getPost('pathologie[]');

        //Union tab : +
        //Intersec tab :  array_intersect(array $array, array ...$arrays): array
        $idSaadFiltrePathologie = $model->getAllSaadsId();
        $idSaadFiltrePublic = $model->getAllSaadsId();

        if(is_array($publicFilter)) {
            $idSaadFiltrePublic = $modelCibler->getSaadsIdByIdPublic($publicFilter);
        }
        if(is_array($pathologieFilter)) {
            $idSaadFiltrePathologie = $modelSpecialiser->getSaadsIdByIdPathologie($pathologieFilter);
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
        $model = new SaadModel();
        $saadListModel = new SaadListModel();
        $personneModel = new PersonneModel();

        $saads = $model->getSaads();
        foreach ($saads as $key => $saad) {
            // on récupère la liste des personnes liées à ce saad sous forme de tableau d'id

            $ids = $saadListModel->getPersonIdsFromSaadId($saad['id']);
            $saads[$key]['idsGerants'] = $ids;
            //on récupère les noms des personnes liées à ce saad pour les afficher plus facilement
            $saads[$key]['noms'] = $personneModel->getPersonnesNameFromId($ids);
        }
        $data = [
            'saads' => $saads,
        ];

        echo view('header');
        echo view('saadsList', $data);
        echo view('footer');
    }

    /**
     * Cette fonction permet de supprimer un utilisateur dont l'identifiant est passé en paramètre
     * @param $id l'id de l'utilisateur à supprimer
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function saadDelete($id)
    {

        $model = new SaadModel();

        $model->deleteImage($id);
        $model->deleteLine($id);


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
        $publicModel = new PublicModel();
        $data['publics'] = $publicModel->getPublics();
        $pathologieModel = new PathologieModel();
        $data['pathologies'] = $pathologieModel->getPathologies();
        $data['title'] = 'Admin';
        $model = new SaadModel();
        $data['success'] = null;
        $data['saad'] = $id;

        if ($id) {
            $ciblerModel = New CiblerModel();
            $specialiserModel = New SpecialiserModel();
            $data['saad'] = $model->getSaadbyid($id);
            $data['publicsCible'] = $ciblerModel->getPublicsIdByIdSaad($id);
            $data['pathologiesSpecialise'] = $specialiserModel->getPathologiesIdByIdSaad($id);
        }

        echo view('header');
        echo view('createSaad', $data);
        echo view('footer');
    }

    /**
     * Méthode appelée lorsque l'utilisateur a rentré les informations pour la creation d'un utilisateur
     * @return \CodeIgniter\HTTP\RedirectResponse|void
     * @throws \ReflectionException
     */
    public function storeSaad($id = false)
    {
        helper(['form']);
        $rules = [
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

        $model = new SaadModel();
        $ciblerModel = new CiblerModel();
        $specialiserModel = new SpecialiserModel();
        if ($this->validate($rules)) {

            $data = [
                'nom' => $this->request->getVar('nom'),
                'tel' => $this->request->getVar('tel'),
                'mail' => $this->request->getVar('mail'),
                'site' => $this->request->getVar('site'),
                'siret_siren' => $this->request->getVar('siret_siren'),
                'adresse' => $this->request->getVar('adresse'),
                'idCategorie' => $this->request->getVar('idCategorie'),
            ];

            $public = $this->request->getPost('public[]');
            $pathologie = $this->request->getPost('pathologie[]');


            if ($this->request->getFile('image')->getName() != "") {
                $data = $data + ['image' => $this->request->getFile('image')->getName()];
                $file = $this->request->getFile('image');
                $file->store('../../public/images/logosaads', $file->getName());
            }

            if ($id) {
                $model->modifSaads($id, $data);
                $specialiserModel->modifSpecialiser($pathologie, $id);
                $ciblerModel->modifCibler($public, $id);
                $data['success'] = true;
            } else {
                $id = $model->saveSaad($data);
                $specialiserModel->saveAll($pathologie, $id);
                $ciblerModel->saveAll($public, $id);
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
        $publicModel = new PublicModel();
        $data['publics'] = $publicModel->getPublics();
        $pathologieModel = new PathologieModel();
        $data['pathologies'] = $pathologieModel->getPathologies();
        if ($id) {
            $ciblerModel = New CiblerModel();
            $specialiserModel = New SpecialiserModel();
            $data['saad'] = $model->getSaadbyid($id);
            $data['publicsCible'] = $ciblerModel->getPublicsIdByIdSaad($id);
            $data['pathologiesSpecialise'] = $specialiserModel->getPathologiesIdByIdSaad($id);
        } else {
            $data['saad'] = $id;
        }
        echo view('header');
        echo view('createSaad', $data);
        echo view('footer');
    }

}