<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Peso;
use AppBundle\Form\PesoType;

/**
 * Peso controller.
 *
 * @Route("/peso")
 */
class PesoController extends Controller
{

    /**
     * Lists all Peso entities.
     *
     * @Route("/", name="peso")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Peso')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Peso entity.
     *
     * @Route("/", name="peso_create")
     * @Method("POST")
     * @Template("AppBundle:Peso:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Peso();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $iduser = $this->getUser()->getUsername();
            $entity->setFechaCreacion(new \DateTime());
            $entity->setUsuarioCreacion($iduser);
            $em->flush();

            return $this->redirect($this->generateUrl('peso_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Peso entity.
     *
     * @param Peso $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Peso $entity)
    {
        $form = $this->createForm(new PesoType(), $entity, array(
            'action' => $this->generateUrl('peso_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Peso entity.
     *
     * @Route("/new", name="peso_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Peso();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Peso entity.
     *
     * @Route("/{id}", name="peso_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Peso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Peso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Peso entity.
     *
     * @Route("/{id}/edit", name="peso_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Peso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Peso entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Peso entity.
    *
    * @param Peso $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Peso $entity)
    {
        $form = $this->createForm(new PesoType(), $entity, array(
            'action' => $this->generateUrl('peso_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Peso entity.
     *
     * @Route("/{id}", name="peso_update")
     * @Method("PUT")
     * @Template("AppBundle:Peso:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Peso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Peso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $iduser = $this->getUser()->getUsername();
            $entity->setFechaCreacion(new \DateTime());
            $entity->setUsuarioCreacion($iduser);
            $em->flush();

            return $this->redirect($this->generateUrl('peso_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Peso entity.
     *
     * @Route("/{id}", name="peso_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Peso')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Peso entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('peso'));
    }

    /**
     * Creates a form to delete a Peso entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('peso_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
