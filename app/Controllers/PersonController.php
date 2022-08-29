<?php

namespace App\Controllers;

use App\Models\PersonneModel;
use CodeIgniter\HTTP\RedirectResponse;
use Faker\Provider\Person;
use ReflectionException;

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
        $data['success'] = null;
        echo view('header');
        echo view('createUser', $data);
        echo view('footer');
    }

    /**
     * Méthode appelée lorsque l'utilisateur a rentré les informations pour la creation d'un utilisateur
     * @return RedirectResponse|void
     * @throws ReflectionException
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
            $data['success'] = true;

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
     * @param $id number - l'id de l'utilisateur à supprimer
     * @return RedirectResponse
     */
    public function userDelete($id): RedirectResponse
    {

        $model = new PersonneModel();

        $model->deleteLine($id);
        return redirect()->to('userList');
    }

    /**
     * Cette fonction permet de se déconnecter
     * @return RedirectResponse
     */
    public function disconnect(): RedirectResponse
    {
        $session = session();
        $session->destroy();
        return redirect()->to('connexionReussie');
    }


    /**
     * Cette fonction permet de transformer l'utilisateur dont l'identifiant est passé en paramètre en admin
     * @param $id number - l'id de l'utilisateur à transformer
     * @return RedirectResponse
     * @throws ReflectionException
     */
    public function userUpgrade($id): RedirectResponse
    {

        $model = new PersonneModel();

        $model->upgrade($id);
        unset($data);
        $sendMail = new MailController();
        $sendMail->sendMail($model->getPersonnebyid($id)['mail'],'Promotion','Vous avez été promu en superadmin');
        return redirect()->to('userList');
    }

    /**
     * Cette fonction permet de transformer l'utilisateur dont l'identifiant est passé en paramètre en gerant de saad
     * @param $id number - l'id de l'utilisateur à transformer
     * @return RedirectResponse
     * @throws ReflectionException
     */
    public function userDowngrade($id): RedirectResponse
    {

        $model = new PersonneModel();
        $model->downgrade($id);
        unset($data);
        $sendMail = new MailController();
        $sendMail->sendMail($model->getPersonnebyid($id)['mail'],'Rétrogradation','Vous avez été rétrogradé en gérant de SAAD');
        return redirect()->to('userList');
    }

    /**
     * Permet de modifier le mot de passe de l'utilisateur dont le mail est passé en paramètre
     * @param $mailUser
     * @return RedirectResponse
     * @throws ReflectionException
     */
    public function resetPassword($mailUser): RedirectResponse
    {
        $subject = 'Réinitialisation du mot de passe';
        $password = substr(password_hash(uniqid(), PASSWORD_BCRYPT), 0, 8);
        $message = 'Votre mot de passe a été réinitialisé, voici le nouveau : ' . $password;
        $password = password_hash($password, PASSWORD_BCRYPT);

        $model = new PersonneModel();
        $model->changePassword($mailUser, $password);
        $sendMail = new MailController();
        $sendMail->sendMail($mailUser,$subject,$message);

        return redirect()->to('userList');
    }

    /**
     * Charge les composants de la page changer de mot de passe si rien n'est passé en param
     * @param $user number - c'est l'id de l'utilisateur dont on modifie le mot de passe
     * @return RedirectResponse|void
     * @throws ReflectionException
     */
    public function changePassword($user = null)
    {
        if (!$user) {
            $id = session()->get('id');

            $data = [
                'idUser' => $id,
            ];
        } else {
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

        }
        echo view('header');
        echo view('changePassword', $data);
        echo view('footer');
    }
}