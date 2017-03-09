<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tweet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class TweetController.
 */
class TweetController extends Controller
{
    /**
     * @Route("/", name="app_tweet_list")
     */
    public function listAction()
    {
        $tweets = $this->getDoctrine()->getRepository(Tweet::class)->getLastTweets(
            $this->getParameter('app.tweet.nb_last', 10)
        );

        return $this->render(':tweet:list.html.twig', [
            'tweets' => $tweets,
        ]);
    }

    /**
     * @Route("/tweet/{id}", name="app_tweet_view")
     *
     * @param $id
     */
    public function viewAction($id)
    {
        $tweetView = $this->getDoctrine()->getRepository(Tweet::class)->getTweet($id);

        return $this->render(':tweet:view.html.twig', [
           'tweetView' => $tweetView,
        ]);
    }
}
