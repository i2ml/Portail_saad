<?php

namespace App\Controllers;

use App\Models\PersonneModel;

class AdminController extends \CodeIgniter\Controller
{
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
}