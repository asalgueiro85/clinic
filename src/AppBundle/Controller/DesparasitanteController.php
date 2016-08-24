<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Desparasitante;
use AppBundle\Form\DesparasitanteType;

/**
 * Desparasitante controller.
 *
 * @Route("/desparasitante")
 */
class DesparasitanteController extends Controller
{

    /**
     * Lists all Desparasitante entities.
     *
     * @Route("/", name="desparasitante")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Desparasitante')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Desparasitante entity.
     *
     * @Route("/", name="desparasitante_create")
     * @Method("POST")
     * @Template("AppBundle:Desparasitante:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Desparasitante();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $iduser = $this->getUser()->getUsername();
            $entity->setFechaCreacion(new \DateTime());
            $entity->setUsuarioCreacion($iduser);
            $em->flush();

            return $this->redirect($this->generateUrl('desparasitante_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Desparasitante entity.
     *
     * @param Desparasitante $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Desparasitante $entity)
    {
        $form = $this->createForm(new DesparasitanteType(), $entity, array(
            'action' => $this->generateUrl('desparasitante_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Desparasitante entity.
     *
     * @Route("/new", name="desparasitante_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Desparasitante();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Desparasitante entity.
     *
     * @Route("/{id}", name="desparasitante_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Desparasitante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Desparasitante entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Desparasitante entity.
     *
     * @Route("/{id}/edit", name="desparasitante_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Desparasitante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Desparasitante entity.');
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
    * Creates a form to edit a Desparasitante entity.
    *
    * @param Desparasitante $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Desparasitante $entity)
    {
        $form = $this->createForm(new DesparasitanteType(), $entity, array(
            'action' => $this->generateUrl('desparasitante_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Desparasitante entity.
     *
     * @Route("/{id}", name="desparasitante_update")
     * @Method("PUT")
     * @Template("AppBundle:Desparasitante:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Desparasitante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Desparasitante entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $iduser = $this->getUser()->getUsername();
            $entity->setFechaCreacion(new \DateTime());
            $entity->setUsuarioCreacion($iduser);
            $em->flush();

            return $this->redirect($this->generateUrl('desparasitante_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Desparasitante entity.
     *
     * @Route("/{id}", name="desparasitante_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Desparasitante')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Desparasitante entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('desparasitante'));
    }

    /**
     * Creates a form to delete a Desparasitante entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('desparasitante_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
