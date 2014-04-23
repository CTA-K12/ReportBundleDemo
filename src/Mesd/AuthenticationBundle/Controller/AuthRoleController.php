<?php

namespace Mesd\AuthenticationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Mesd\AuthenticationBundle\Entity\AuthRole;
use Mesd\AuthenticationBundle\Form\AuthRoleType;

/**
 * AuthRole controller.
 *
 */
class AuthRoleController extends Controller
{

    /**
     * Lists all AuthRole entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MesdAuthenticationBundle:AuthRole')->findAll();

        return $this->render('MesdAuthenticationBundle:AuthRole:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new AuthRole entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new AuthRole();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('authrole_show', array('id' => $entity->getId())));
        }

        return $this->render('MesdAuthenticationBundle:AuthRole:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a AuthRole entity.
    *
    * @param AuthRole $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(AuthRole $entity)
    {
        $form = $this->createForm(new AuthRoleType(), $entity, array(
            'action' => $this->generateUrl('authrole_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AuthRole entity.
     *
     */
    public function newAction()
    {
        $entity = new AuthRole();
        $form   = $this->createCreateForm($entity);

        return $this->render('MesdAuthenticationBundle:AuthRole:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a AuthRole entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdAuthenticationBundle:AuthRole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AuthRole entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MesdAuthenticationBundle:AuthRole:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing AuthRole entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdAuthenticationBundle:AuthRole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AuthRole entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MesdAuthenticationBundle:AuthRole:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a AuthRole entity.
    *
    * @param AuthRole $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AuthRole $entity)
    {
        $form = $this->createForm(new AuthRoleType(), $entity, array(
            'action' => $this->generateUrl('authrole_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AuthRole entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdAuthenticationBundle:AuthRole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AuthRole entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('authrole_edit', array('id' => $id)));
        }

        return $this->render('MesdAuthenticationBundle:AuthRole:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a AuthRole entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MesdAuthenticationBundle:AuthRole')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AuthRole entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('authrole'));
    }

    /**
     * Creates a form to delete a AuthRole entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('authrole_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
