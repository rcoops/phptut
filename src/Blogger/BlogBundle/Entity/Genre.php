<?php

namespace Blogger\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Repository\GenreRepository")
 */
class Genre
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var Album
     *
     * @ORM\OneToMany(targetEntity="Album", mappedBy="genre")
     */
    private $albums;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->albums = new ArrayCollection();
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
     * Set username
     *
     * @param string $name
     *
     * @return Genre
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add album
     *
     * @param \Blogger\BlogBundle\Entity\Album $album
     *
     * @return Genre
     */
    public function addAlbum(\Blogger\BlogBundle\Entity\Album $album)
    {
        $this->albums[] = $album;

        return $this;
    }

    /**
     * Remove album
     *
     * @param \Blogger\BlogBundle\Entity\Album $album
     */
    public function removeAlbum(\Blogger\BlogBundle\Entity\Album $album)
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
}
