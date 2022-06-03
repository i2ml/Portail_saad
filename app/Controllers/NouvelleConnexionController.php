<?php

namespace App\Controllers;

use App\Models\PersonneModel;

class NouvelleConnexionController extends \CodeIgniter\Controller
{
    public function index()
    {
        $data['title'] = "Connexion";
        helper(['form']);
        echo view('header', $data);
        echo view('connexion');
        echo view('footer');
    }

    public function succes()
    {
        $data['title'] = "Succes";
        echo view('header', $data);
        echo view('connexionReussie');
        echo view('footer');
    }

    public function loginAuth()
    {
        $session = session();

        $personneModel = new PersonneModel();

        $mail = $this->request->getVar('mail');
        $motdepasse = $this->request->getVar('motdepasse');

        $data = $personneModel->where('mail', $mail)->first();

        $messageErrorConnexion = 'Compte introuvable, la combinaison mot de passe/adresse email n\'est pas reconnue';

        if ($data) {
            $pass = $data['motdepasse'];
            $authenticatePassword = password_verify($motdepasse, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $data['id'],
                    'nom' => $data['nom'],
                    'mail' => $data['mail'],
                    'idSaad'=> $data['idSaad'],
                    'isLoggedIn' => TRUE
                ];

                $session->set($ses_data);
                return redirect()->to('/connexionReussie');
            }
            $session->setFlashdata('msg', $messageErrorConnexion);
            return redirect()->to('/connexion');
        }
        $session->setFlashdata('msg', $messageErrorConnexion);
        return redirect()->to('/connexion');

    }
}