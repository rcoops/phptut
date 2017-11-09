<?php

namespace Blogger\BlogBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class User
 *
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Repository\UserRepository")
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

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Blogger\BlogBundle\Entity\Entry", mappedBy="author")
     */
    protected $entries;

    public function __construct()
    {
        parent::__construct();
        $this->albums = new ArrayCollection();
    }


    /**
     * Add album
     *
     * @param \Blogger\BlogBundle\Entity\Album $album
     *
     * @return User
     */
    public function addAlbum(Album $album)
    {
        $this->albums[] = $album;

        return $this;
    }

    /**
     * Remove album
     *
     * @param \Blogger\BlogBundle\Entity\Album $album
     */
    public function removeAlbum(Album $album)
    {
        $this->albums->removeElement($album);
    }

    /**
     * Get albums
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlbums()
    {
        return $this->albums;
    }

    /**
     * Add entry
     *
     * @param \Blogger\BlogBundle\Entity\Entry $entry
     *
     * @return User
     */
    public function addEntry(Entry $entry)
    {
        $this->entries[] = $entry;

        return $this;
    }

    /**
     * Remove entry
     *
     * @param \Blogger\BlogBundle\Entity\Entry $entry
     */
    public function removeEntry(Entry $entry)
    {
        $this->entries->removeElement($entry);
    }

    /**
     * Get entries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntries()
    {
        return $this->entries;
    }
}
