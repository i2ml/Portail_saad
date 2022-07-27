<?php
namespace App\Controllers;

use App\Models\CiblerModel;
use App\Models\PathologieModel;
use App\Models\PublicModel;
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

        $data = [
            'saads' => $model->getSaads(),
            'title' => 'Liste des Saads',
        ];

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

        $data = [
            'saads' => $model->getSaads(),
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
        $data['saad'] = $id;

        if ($id) {
            $data['saad'] = $model->getSaads($id);
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
            'tel' => 'max_length[100]',
            'mail' => 'max_length[100]|valid_email',
            'site' => 'max_length[150]',
            'adresse' => 'max_length[300]',
            'idCategorie' => 'required',
            'image' => [
                'rules' => 'uploaded[image]'
                    . '|is_image[image]'
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
            } else {
                $id = $model->saveSaad($data);
                $specialiserModel->saveAll($pathologie, $id);
                $ciblerModel->saveAll($public, $id);
            }

            return redirect()->to('/connexionReussie');
        }

        $session = session();
        $data['profil'] = $session->get('nom');
        $data['validation'] = $this->validator;
        $data['title'] = 'Admin';
        $publicModel = new PublicModel();
        $data['publics'] = $publicModel->getPublics();
        $pathologieModel = new PathologieModel();
        $data['pathologies'] = $pathologieModel->getPathologies();
        if ($id) {
            $data['saad'] = $model->getSaads($id);
        } else {
            $data['saad'] = $id;
        }
        echo view('header');
        echo view('createSaad', $data);
        echo view('footer');
    }

}