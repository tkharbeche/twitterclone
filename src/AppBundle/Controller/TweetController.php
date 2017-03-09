<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tweet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TweetType;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @Route("/tweet/new", name="app_tweet_new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tweet = new Tweet();
        $form = $this->createForm(TweetType::class, $tweet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tweet);
            $em->flush();

            return $this->redirectToRoute('app_tweet_list');
//            return $this->redirectToRoute('app_tweet_view', array('id' => $tweet->getId()));

        }
        return $this->render(':tweet:new.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/tweet/{id}", name="app_tweet_view")
     */
    public function viewAction($id)
    {

            $tweetView = $this->getDoctrine()->getRepository(Tweet::class)->getTweet($id);
            if($tweetView == null)
            {
                throw new NotFoundHttpException("Le tweet recherché n'existe pas   ");
            }else{

                return $this->render(':tweet:view.html.twig', [
                    'tweetView' => $tweetView,
                ]);

            }
    }


}
