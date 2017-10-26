<?php

namespace Blogger\BlogBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class User
 *
 * @ORM\Entity
 * @ORM\Table(name="users")
 *
 * @package Blogger\BlogBundle\Entity
 */
class User extends BaseUser
{

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Album", inversedBy="users")
     * @ORM\JoinTable(name="users_albums")
     */
    private $albums;

    public function __construct()
    {
        parent::__construct();
        $this->albums = new ArrayCollection();
    }

}