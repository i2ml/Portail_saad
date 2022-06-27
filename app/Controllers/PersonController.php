<?php

namespace App\Controllers;

use App\Models\PersonneModel;
use Faker\Provider\Person;

/**
 * Cette classe est le controller des utilisateurs
 */
class PersonController extends \CodeIgniter\Controller
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

        echo view('header');
        echo view('userList', $data);
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
     * Permet de modifier le mot de passe de l'utilisateur dont le mail est passé en parametre
     * @param $mailUser
     * @return \CodeIgniter\HTTP\RedirectResponse|void
     * @throws \ReflectionException
     */
    public function resetPassword($mailUser){
        $email = \Config\Services::email();

        $email->setFrom('contact@dometlien.fr', 'Ne pas répondre');
        $email->setTo($mailUser);

        $email->setSubject('Réinitialisation du mot de passe');
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
        $password = substr( str_shuffle( $chars ), 0, 8 );
        $message = 'Votre mot de passe a été réinitialisé, voici le nouveau : '.$password;
        $email->setMessage($message);
        $password = password_hash($password, PASSWORD_BCRYPT);

        $model = new PersonneModel();
        $model->changePassword($mailUser, $password);

        if($email->send()){
            echo "ça a fonctionné";
            return redirect()->to('userList');
        } else {
            echo $email->printDebugger();
            echo "nop";
            return redirect()->to('userList');
        }
    }

    /**
     * Charge les composants de la page changer de mot de passe si rien n'est passé en param
     * @param $user c'est l'id de l'utilisateur dont on modifie le mot de passe
     * @throws \ReflectionException
     */
    public function changePassword($user = false)
    {
        if(!$user) {
            $id = session()->get('id');

            $data = [
                'idUser' => $id,
            ];

            echo view('header');
            echo view('changePassword', $data);
            echo view('footer');
        }
        else {
            helper(['form']);
            $rules = [
                'password' => 'required|min_length[4]|max_length[50]',
                'confirmpassword' => 'matches[password]'
            ];

            if ($this->validate($rules)) {
                $userModel = new PersonneModel();

                $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);


                $userModel->changePasswordWithId($user, $password);

                return redirect()->to('/connexionReussie');
            }

            $session = session();
            $data['idUser'] = $session->get('id');
            $data['validation'] = $this->validator;
            $data['title'] = 'Admin';
            echo view('header');
            echo view('changePassword', $data);
            echo view('footer');

        }
    }

}