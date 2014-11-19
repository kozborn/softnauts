<?php

namespace PiotrK\MegalomanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="artist")
 * @ORM\Entity(repositoryClass="PiotrK\MegalomanBundle\Entity\ArtistRepository")
 */
class Artist {

  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\Column(type="string", length=255)
   * @Assert\NotBlank()
   */
  protected $name;

  /**
   * @ORM\Column(type="string", length=255)
   * @Assert\NotBlank()
   */
  protected $lastName;

  /**
   * @ORM\ManyToMany(targetEntity="Album", mappedBy="artists")
   */
  protected $albums;

  public function __construct() {
    $this->albums = new ArrayCollection();
  }

  /**
   * Get id
   *
   * @return integer
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set name
   *
   * @param string $name
   * @return Artist
   */
  public function setName($name) {
    $this->name = $name;

    return $this;
  }

  /**
   * Get name
   *
   * @return string 
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Set lastName
   *
   * @param string $lastName
   * @return Artist
   */
  public function setLastName($lastName) {
    $this->lastName = $lastName;

    return $this;
  }

  /**
   * Get lastName
   *
   * @return string 
   */
  public function getLastName() {
    return $this->lastName;
  }

  /**
   * Add albums
   *
   * @param \PiotrK\MegalomanBundle\Entity\Album $albums
   * @return Artist
   */
  public function addAlbum(\PiotrK\MegalomanBundle\Entity\Album $albums) {
    $this->albums[] = $albums;

    return $this;
  }

  /**
   * Remove albums
   *
   * @param \PiotrK\MegalomanBundle\Entity\Album $albums
   */
  public function removeAlbum(\PiotrK\MegalomanBundle\Entity\Album $albums) {
    $this->albums->removeElement($albums);
  }

  /**
   * Get albums
   *
   * @return \Doctrine\Common\Collections\Collection 
   */
  public function getAlbums() {
    return $this->albums;
  }

  public function __toString() {
    return $this->name . " " . $this->lastName;
  }

}
