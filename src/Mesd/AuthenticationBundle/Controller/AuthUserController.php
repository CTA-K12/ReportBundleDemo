<?php

namespace Mesd\AuthenticationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Mesd\AuthenticationBundle\Entity\AuthUser;
use Mesd\AuthenticationBundle\Form\AuthUserType;

/**
 * AuthUser controller.
 *
 */
class AuthUserController extends Controller
{

    /**
     * Lists all AuthUser entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MesdAuthenticationBundle:AuthUser')->findAll();

        return $this->render('MesdAuthenticationBundle:AuthUser:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new AuthUser entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new AuthUser();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('authuser_show', array('id' => $entity->getId())));
        }

        return $this->render('MesdAuthenticationBundle:AuthUser:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a AuthUser entity.
    *
    * @param AuthUser $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(AuthUser $entity)
    {
        $form = $this->createForm(new AuthUserType(), $entity, array(
            'action' => $this->generateUrl('authuser_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AuthUser entity.
     *
     */
    public function newAction()
    {
        $entity = new AuthUser();
        $form   = $this->createCreateForm($entity);

        return $this->render('MesdAuthenticationBundle:AuthUser:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a AuthUser entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdAuthenticationBundle:AuthUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AuthUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MesdAuthenticationBundle:AuthUser:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing AuthUser entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdAuthenticationBundle:AuthUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AuthUser entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MesdAuthenticationBundle:AuthUser:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a AuthUser entity.
    *
    * @param AuthUser $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AuthUser $entity)
    {
        $form = $this->createForm(new AuthUserType(), $entity, array(
            'action' => $this->generateUrl('authuser_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AuthUser entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdAuthenticationBundle:AuthUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AuthUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('authuser_edit', array('id' => $id)));
        }

        return $this->render('MesdAuthenticationBundle:AuthUser:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a AuthUser entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MesdAuthenticationBundle:AuthUser')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AuthUser entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('authuser'));
    }

    /**
     * Creates a form to delete a AuthUser entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('authuser_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
