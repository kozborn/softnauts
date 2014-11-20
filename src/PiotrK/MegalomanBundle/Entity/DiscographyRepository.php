<?php

namespace PiotrK\MegalomanBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * DiscographyRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DiscographyRepository extends EntityRepository {

  public function findAlbums($id, $filters){

    $discography = $this->find($id);

    $albumNeedle = isset($filters['album']) ? $filters['album'] : null;
    $artistNeedle = isset($filters['artist']) ? $filters['artist'] : null;
    if($albumNeedle){
      $albums = new ArrayCollection();
      $albums = $discography->getAlbums()->filter(function($album) use ($albumNeedle){
        return stripos($album->getName(), $albumNeedle) !== false;
      });
      $discography->setAlbums($albums);
    }

    if($artistNeedle){
      $currentAlbums = $discography->getAlbums()->toArray();
      $albums = $this->getEntityManager()->getRepository("MegalomanBundle:Album")->findAlbumsByArtist($artistNeedle);
      $intersect = new ArrayCollection(array_intersect($currentAlbums, $albums));
      $discography->setAlbums($intersect);
    }

    return $discography;

  }

}
