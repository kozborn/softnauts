<?php

namespace PiotrK\MegalomanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="discography")
  * @ORM\Entity(repositoryClass="PiotrK\MegalomanBundle\Entity\DiscographyRepository")
 */

class Discography {
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
    * @ORM\OneToOne(targetEntity="Megaloman", mappedBy="discography")
  */
  protected $owner;

  /**
   * @ORM\OneToMany(targetEntity="Album", mappedBy="discography")
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
     * Set owner
     *
     * @param \PiotrK\MegalomanBundle\Entity\Megaloman $owner
     * @return Discography
     */
    public function setOwner(\PiotrK\MegalomanBundle\Entity\Megaloman $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \PiotrK\MegalomanBundle\Entity\Megaloman 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Add albums
     *
     * @param \PiotrK\MegalomanBundle\Entity\Album $albums
     * @return Discography
     */
    public function addAlbum(\PiotrK\MegalomanBundle\Entity\Album $albums)
    {
        $this->albums[] = $albums;

        return $this;
    }

    /**
     * Remove albums
     *
     * @param \PiotrK\MegalomanBundle\Entity\Album $albums
     */
    public function removeAlbum(\PiotrK\MegalomanBundle\Entity\Album $albums)
    {
        $this->albums->removeElement($albums);
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
