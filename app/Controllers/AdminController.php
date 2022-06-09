<?php

namespace App\Controllers;

use App\Models\PersonneModel;
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
     * Test la connexion
     * @return \CodeIgniter\HTTP\RedirectResponse|void
     * @throws \ReflectionException
     */
    public function store()
    {
        helper(['form']);
        $rules = [
            'nom'          => 'required|min_length[2]|max_length[50]',
            'prenom'          => 'required|min_length[2]|max_length[50]',
            'mail'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[personne.mail]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $userModel = new PersonneModel();

            $data = [
                'nom'     => $this->request->getVar('nom'),
                'prenom'     => $this->request->getVar('prenom'),
                'mail'    => $this->request->getVar('mail'),
                'motdepasse' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $userModel->save($data);

            return redirect()->to('/connexionReussie');
        } else {
            $session = session();
            $data['profil'] = $session->get('nom');
            $data['validation'] = $this->validator;
            $data['title'] = 'Admin';
            echo view('header');
            echo view('createUser', $data);
            echo view('footer');
        }
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
     * Cette fonction permet de supprimer un utilisateur dont l'identifiant est passé en parametre
     * @param $id l'id de l'utilisateur a supprimer
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function userDelete($id)
    {

        $model = new PersonneModel();

        $model->delete_line($id);
        unset($data);
        return redirect()->to('userList');
    }

    /**
     * Cette fonction permet de transformer l'utilisateut dont l'identifiant est passé en parametre en admin
     * @param $id l'id de l'utilisateur a transformer
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
     * Cette fonction permet de transformer l'utilisateut dont l'identifiant est passé en parametre en gerant de saad
     * @param $id l'id de l'utilisateur a transformer
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function userDowngrade($id)
    {

        $model = new PersonneModel();
        $model->downgrade($id);
        unset($data);
        return redirect()->to('userList');
    }
}