<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 10/03/2017
 * Time: 11:59
 */

namespace AppBundle\Messenger;

use AppBundle\Entity\Tweet;

class EmailMessenger
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendTweetCreated(Tweet $tweet)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Création de tweet')
            ->setFrom('send.from@mail.net')
            ->setTo('send.to@mail.net')
            ->setBody('Le Tweet a bien été crée gzkngzonb');
        $this->send($message);

    }

    private function send($message)
    {
        $this->mailer->send($message);
    }

}