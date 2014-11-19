<?php

namespace PiotrK\MegalomanBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PiotrK\MegalomanBundle\Entity\Discography;

/**
 * Discography controller.
 *
 */
class DiscographyController extends Controller
{

    /**
     * Lists all Discography entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MegalomanBundle:Discography')->findAll();

        return $this->render('MegalomanBundle:Discography:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Discography entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MegalomanBundle:Discography')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Discography entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MegalomanBundle:Discography:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }
}
