<?php

namespace Blogger\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Repository\AlbumRepository")
 */
class Album
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="releaseDate", type="datetime")
     */
    private $releaseDate;

    /**
     * @var Genre
     *
     * @ORM\ManyToOne(targetEntity="Genre", inversedBy="albums")
     */
    private $genre;

    /**
     * @var Artist
     *
     * @ORM\ManyToOne(targetEntity="Artist", inversedBy="albums")
     */
    private $artist;

    /**
     * @var
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="albums")
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Album
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set releaseDate
     *
     * @param \DateTime $releaseDate
     *
     * @return Album
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate
     *
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set genre
     *
     * @param \Blogger\BlogBundle\Entity\Genre $genre
     *
     * @return Album
     */
    public function setGenre(\Blogger\BlogBundle\Entity\Genre $genre = null)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return \Blogger\BlogBundle\Entity\Genre
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set artist
     *
     * @param \Blogger\BlogBundle\Entity\Artist $artist
     *
     * @return Album
     */
    public function setArtist(\Blogger\BlogBundle\Entity\Artist $artist = null)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return \Blogger\BlogBundle\Entity\Artist
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Add user
     *
     * @param \Blogger\BlogBundle\Entity\User $user
     *
     * @return Album
     */
    public function addUser(\Blogger\BlogBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Blogger\BlogBundle\Entity\User $user
     */
    public function removeUser(\Blogger\BlogBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
