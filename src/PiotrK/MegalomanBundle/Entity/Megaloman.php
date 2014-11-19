<?php

namespace PiotrK\MegalomanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="megaloman")
* @ORM\Entity(repositoryClass="PiotrK\MegalomanBundle\Entity\MegalomanRepository")
 */

class Megaloman {

  public function __construct(){
    $this->discography = new Discography();
  }
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
     * @ORM\OneToOne(targetEntity="Discography")
  */
  protected $discography;

  /**
   *
   *
   * @ORM\Column(type="string", length=255)
   */
  protected $name;

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
   * @return Megaloman
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
     * @return Megaloman
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
}
