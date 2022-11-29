<?php

namespace App\Controllers;

use App\Models\PersonneModel;

/**
 * Classe NouvelleConnexionController
 * @package App\Controllers
 */
class NouvelleConnexionController extends \CodeIgniter\Controller
{
    /**
     * Chargeuse de la page de connexion
     */
    public function index()
    {
        // si la personne est déjà connectée, on la redirige vers connexionReussie avec une notification
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/connexionReussie')
                ->with('notificationTitle', 'Vous avez été reconnecté')
                ->with('notificationMessage', 'Nous avons récupéré votre connexion');
        }
        $data['title'] = "Connexion";
        helper(['form']);
        echo view('header', $data);
        echo view('connexion');
        echo view('footer');
    }

    /*
     * chargeuse de la page de connexion réussie
     */
    public function success()
    {
        $data['notificationTitle'] = session()->get('notificationTitle');
        $data['notificationMessage'] = session()->get('notificationMessage');
        echo view('header', $data);
        echo view('connexionReussie');
        echo view('footer');
    }

    /**
     * affiche la page 403
     */
    public function forbidden()
    {
        $data['title'] = "Accès interdit";
        echo view('header', $data);
        echo view('forbidden');
        echo view('footer');
    }

    /*
     * Vérifie si le mail et le mot de passe sont corrects
     */
    public function loginAuth()
    {
        $session = session();

        $personneModel = new PersonneModel();

        $mail = $this->request->getVar('mail');
        $motdepasse = $this->request->getVar('motdepasse');

        $messageErrorConnexion = 'Compte introuvable, la combinaison mot de passe/adresse email n\'est pas reconnue';

            if ($personneModel->checkPass($mail, $motdepasse)) {
                $data= $personneModel->getPersonnebymail($mail);
                $ses_data = [
                    'id' => $data['id'],
                    'nom' => $data['nom'],
                    'mail' => $data['mail'],
                    'isLoggedIn' => TRUE,
                    'accountType' => $data['accountType']
                ];
                $session->set($ses_data);
                return redirect()->to('/connexionReussie');
            }
            $session->setFlashdata('msg', $messageErrorConnexion);
            return redirect()->to('/connexion');

    }
}