<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 10/03/2017
 * Time: 16:49
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping;


/**
 * Class Favourite
 * @ORM\Table(name="Favourite")
 * @ORM\Entity()
 */
class Favourite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var User $user
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $user;
    /**
     * @varTweet $tweet
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tweet")
     */

    private $tweet;

    /**
     * Get id.
     *
     * @return int
     */

    public function getId()
    {
        return $this->id;
    }

}