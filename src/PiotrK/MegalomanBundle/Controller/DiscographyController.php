<?php

namespace PiotrK\MegalomanBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PiotrK\MegalomanBundle\Entity\Discography;
use PiotrK\MegalomanBundle\Form\DiscographyType;

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

    /**
     * Displays a form to edit an existing Discography entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MegalomanBundle:Discography')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Discography entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MegalomanBundle:Discography:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Discography entity.
    *
    * @param Discography $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Discography $entity)
    {
        $form = $this->createForm(new DiscographyType(), $entity, array(
            'action' => $this->generateUrl('discography_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Discography entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MegalomanBundle:Discography')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Discography entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('discography_edit', array('id' => $id)));
        }

        return $this->render('MegalomanBundle:Discography:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Discography entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MegalomanBundle:Discography')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Discography entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('discography'));
    }

    /**
     * Creates a form to delete a Discography entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('discography_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
