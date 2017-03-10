<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 10/03/2017
 * Time: 10:44
 */

namespace AppBundle\Manager;


use AppBundle\Entity\Tweet;
use Doctrine\ORM\EntityManagerInterface;

class TweetManager
{

    private $entityManager;
    private $nbLast;

    public function __construct(EntityManagerInterface $entityManager, $nbLast)
    {
        $this->entityManager = $entityManager;
        $this->nbLast = $nbLast;
    }


    public function create()
    {
        return new Tweet();
    }

    public function save($tweet)
    {
        if(null === $tweet->getId())
        {
            $this->entityManager->persist($tweet);
        }
        $this->entityManager->flush();
    }

    public function getLast()
    {
        //$this->getDoctrine()->getRepository(Tweet::class)->getLastTweets($this->getParameter('app.tweet.nb_last', 10));

        return $this->entityManager->getRepository(Tweet::class)->getLastTweets($this->nbLast);


    }
}