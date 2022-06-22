<?php

namespace App\Controllers;

use App\Models\PersonneModel;
use App\Models\SaadModel;
use Faker\Provider\Person;

/**
 * Cette classe est le controller de la partie admin
 */
class AdminController extends \CodeIgniter\Controller
{
    /**
     * Charge les composants de la page création de gérant de saad
     */
    public function createUser()
    {
        helper(['form']);
        $data = [];
        $session = session();
        $data['profil'] = $session->get('nom');
        $data['title'] = 'Admin';
        echo view('header');
        echo view('createUser', $data);
        echo view('footer');
    }

    /**
     * Méthode appelée lorsque l'utilisateur a rentré les informations pour la creation d'un utilisateur
     * @return \CodeIgniter\HTTP\RedirectResponse|void
     * @throws \ReflectionException
     */
    public function store()
    {
        helper(['form']);
        $rules = [
            'nom' => 'required|min_length[2]|max_length[50]',
            'prenom' => 'required|min_length[2]|max_length[50]',
            'mail' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[personne.mail]',
            'password' => 'required|min_length[4]|max_length[50]',
            'confirmpassword' => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $userModel = new PersonneModel();

            $data = [
                'nom' => $this->request->getVar('nom'),
                'prenom' => $this->request->getVar('prenom'),
                'mail' => $this->request->getVar('mail'),
                'motdepasse' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $userModel->save($data);

            return redirect()->to('/connexionReussie');
        }

        $session = session();
        $data['profil'] = $session->get('nom');
        $data['validation'] = $this->validator;
        $data['title'] = 'Admin';
        echo view('header');
        echo view('createUser', $data);
        echo view('footer');

    }

    /**
     * Charge les composants de la page lister les personnes
     */
    public function userList()
    {
        $model = new PersonneModel();

        $data = [
            'users' => $model->getPersonnes(),
        ];

        $session = session();

        echo view('header');
        echo view('userList', $data);
        echo view('footer');
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
    public function userDelete($id)
    {

        $model = new PersonneModel();

        $model->deleteLine($id);
        unset($data);
        return redirect()->to('userList');
    }

    /**
     * Cette fonction permet de se déconnecter
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function disconnect()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('connexionReussie');
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
     * Cette fonction permet de transformer l'utilisateur dont l'identifiant est passé en paramètre en admin
     * @param $id l'id de l'utilisateur à transformer
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function userUpgrade($id)
    {

        $model = new PersonneModel();

        $model->upgrade($id);
        unset($data);
        return redirect()->to('userList');
    }

    /**
     * Cette fonction permet de transformer l'utilisateur dont l'identifiant est passé en paramètre en gerant de saad
     * @param $id l'id de l'utilisateur à transformer
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function userDowngrade($id)
    {

        $model = new PersonneModel();
        $model->downgrade($id);
        unset($data);
        return redirect()->to('userList');
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
            ]
        ];

        $model = new SaadModel();
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

            if ($this->request->getFile('image')->getName() != "") {
                $data = $data + ['image' => $this->request->getFile('image')->getName()];
                $file = $this->request->getFile('image');
                $file->store('images/logosaads', $file->getName());
            }

            if ($id) {
                $model->modifSaads($id, $data);
            } else {
                $model->save($data);
            }

            return redirect()->to('/connexionReussie');
        }

        $session = session();
        $data['profil'] = $session->get('nom');
        $data['validation'] = $this->validator;
        $data['title'] = 'Admin';
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