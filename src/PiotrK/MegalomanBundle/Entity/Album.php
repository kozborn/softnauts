<?php

namespace PiotrK\MegalomanBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="PiotrK\MegalomanBundle\Entity\AlbumRepository")
 */
class Album {

  public function __construct(){
    $this->artists = new ArrayCollection();
  }
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   *
   *
   * @ORM\Column(type="string", length=255)
   */
  protected $name;
  /**
   * @ORM\ManyToOne(targetEntity="Discography", inversedBy="albums")
   * @ORM\JoinColumn(name="discography_id", referencedColumnName="id")
   */
  protected $discography;

  /**
    * @ORM\ManyToMany(targetEntity="Artist", mappedBy="albums", cascade={"persist"})
  */
  protected $artists;

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
   * @param string  $name
   * @return Album
   */
  public function setName( $name ) {
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
     * Set discography
     *
     * @param \PiotrK\MegalomanBundle\Entity\Discography $discography
     * @return Album
     */
    public function setDiscography(\PiotrK\MegalomanBundle\Entity\Discography $discography = null)
    {
        $this->discography = $discography;

        return $this;
    }

    /**
     * Get discography
     *
     * @return \PiotrK\MegalomanBundle\Entity\Discography 
     */
    public function getDiscography()
    {
        return $this->discography;
    }

    /**
     * Add artists
     *
     * @param \PiotrK\MegalomanBundle\Entity\Artist $artists
     * @return Album
     */
    public function addArtist(\PiotrK\MegalomanBundle\Entity\Artist $artists)
    {
        $this->artists[] = $artists;

        return $this;
    }

    /**
     * Remove artists
     *
     * @param \PiotrK\MegalomanBundle\Entity\Artist $artists
     */
    public function removeArtist(\PiotrK\MegalomanBundle\Entity\Artist $artists)
    {
        $this->artists->removeElement($artists);
    }

    /**
     * Get artists
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArtists()
    {
        return $this->artists;
    }
}
