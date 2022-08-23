<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class MailController extends \CodeIgniter\Controller
{
    /**
     * Cette méthode permet d'envoyer un mail
     * @param $mailto String l'adresse mail du destinataire
     * @param $subject String le sujet du mail
     * @param $body String le corps du mail
     */
    public function sendMail($mailto, $subject, $body) {
        $email = \Config\Services::email();

        $email->setFrom('contact@dometlien.fr', 'Ne pas répondre');
        // ou $email->setFrom('nepasrepondre@portailsaad.fr', 'Ne pas répondre'); Mais cette ligne leve une erreur à la reception du mail
        $email->setTo($mailto);

        $email->setSubject($subject);
        $message = $body;
        $email->setMessage($message);
        $email->send();

    }

}