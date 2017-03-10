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
        $tweetManager = $this->container->get('app.tweet_manager');
        $tweets = $tweetManager->getLast();

        return $this->render(':tweet:list.html.twig', [
            'tweets' => $tweets,
        ]);
    }

    /**
     * @Route("/tweet/new", name="app_tweet_new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tweetManager = $this->container->get('app.tweet_manager');
        $tweet = $tweetManager->create();

        $form = $this->createForm(TweetType::class, $tweet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $tweetManager->save($tweet);

            $messageManager = $this->container->get('app.email_messenger');
            $mes = $messageManager->sendTweetCreated($tweet);


            $this->addFlash("success", "Le tweet à bien été crée");
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
