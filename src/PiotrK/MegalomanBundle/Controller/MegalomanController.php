<?php

namespace PiotrK\MegalomanBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PiotrK\MegalomanBundle\Entity\Megaloman;
use PiotrK\MegalomanBundle\Entity\Discography;
use PiotrK\MegalomanBundle\Form\MegalomanType;

/**
 * Megaloman controller.
 *
 */
class MegalomanController extends Controller {

  /**
   * Lists all Megaloman entities.
   *
   */
  public function indexAction() {
    $em = $this->getDoctrine()->getManager();

    $entities = $em->getRepository('MegalomanBundle:Megaloman')->findAll();

    return $this->render('MegalomanBundle:Megaloman:index.html.twig', array(
                'entities' => $entities,
    ));
  }

  /**
   * Creates a new Megaloman entity.
   *
   */
  public function createAction(Request $request) {
    $entity = new Megaloman();
    $form = $this->createCreateForm($entity);
    $form->handleRequest($request);

    if ($form->isValid()) {
      $discography = new Discography();
      $discography->setOwner($entity);
      $entity->setDiscography($discography);
      $em = $this->getDoctrine()->getManager();
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('megaloman_show', array('id' => $entity->getId())));
    }

    return $this->render('MegalomanBundle:Megaloman:new.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView(),
    ));
  }

  /**
   * Creates a form to create a Megaloman entity.
   *
   * @param Megaloman $entity The entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createCreateForm(Megaloman $entity) {
    $form = $this->createForm(new MegalomanType(), $entity, array(
        'action' => $this->generateUrl('megaloman_create'),
        'method' => 'POST',
    ));

    $form->add('submit', 'submit', array('label' => 'Utwórz'));

    return $form;
  }

  /**
   * Displays a form to create a new Megaloman entity.
   *
   */
  public function newAction() {
    $entity = new Megaloman();
    $form = $this->createCreateForm($entity);

    return $this->render('MegalomanBundle:Megaloman:new.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView(),
    ));
  }

  /**
   * Finds and displays a Megaloman entity.
   *
   */
  public function showAction($id) {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('MegalomanBundle:Megaloman')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Megaloman entity.');
    }

    $deleteForm = $this->createDeleteForm($id);

    return $this->render('MegalomanBundle:Megaloman:show.html.twig', array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
   * Displays a form to edit an existing Megaloman entity.
   *
   */
  public function editAction($id) {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('MegalomanBundle:Megaloman')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Megaloman entity.');
    }

    $editForm = $this->createEditForm($entity);
    $deleteForm = $this->createDeleteForm($id);

    return $this->render('MegalomanBundle:Megaloman:edit.html.twig', array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
   * Creates a form to edit a Megaloman entity.
   *
   * @param Megaloman $entity The entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createEditForm(Megaloman $entity) {
    $form = $this->createForm(new MegalomanType(), $entity, array(
        'action' => $this->generateUrl('megaloman_update', array('id' => $entity->getId())),
        'method' => 'PUT',
    ));

    $form->add('submit', 'submit', array('label' => 'Zapisz'));

    return $form;
  }

  /**
   * Edits an existing Megaloman entity.
   *
   */
  public function updateAction(Request $request, $id) {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('MegalomanBundle:Megaloman')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Megaloman entity.');
    }

    $deleteForm = $this->createDeleteForm($id);
    $editForm = $this->createEditForm($entity);
    $editForm->handleRequest($request);

    if ($editForm->isValid()) {
      $em->flush();

      return $this->redirect($this->generateUrl('megaloman_edit', array('id' => $id)));
    }

    return $this->render('MegalomanBundle:Megaloman:edit.html.twig', array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
   * Deletes a Megaloman entity.
   *
   */
  public function deleteAction(Request $request, $id) {
    $form = $this->createDeleteForm($id);
    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('MegalomanBundle:Megaloman')->find($id);

      if (!$entity) {
        throw $this->createNotFoundException('Unable to find Megaloman entity.');
      }

      $em->remove($entity);
      $em->flush();
    }

    return $this->redirect($this->generateUrl('megaloman'));
  }

  /**
   * Creates a form to delete a Megaloman entity by id.
   *
   * @param mixed $id The entity id
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm($id) {
    return $this->createFormBuilder()
                    ->setAction($this->generateUrl('megaloman_delete', array('id' => $id)))
                    ->setMethod('DELETE')
                    ->add('submit', 'submit', array('label' => 'Usuń'))
                    ->getForm()
    ;
  }

}
