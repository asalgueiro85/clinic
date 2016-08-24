<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Vacuna;
use AppBundle\Form\VacunaType;

/**
 * Vacuna controller.
 *
 * @Route("/vacuna")
 */
class VacunaController extends Controller
{

    /**
     * Lists all Vacuna entities.
     *
     * @Route("/", name="vacuna")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Vacuna')->findAll();

        return array(
            'entities' => $entities
        );
    }
    /**
     * Creates a new Vacuna entity.
     *
     * @Route("/", name="vacuna_create")
     * @Method("POST")
     * @Template("AppBundle:Vacuna:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Vacuna();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $iduser = $this->getUser()->getUsername();
            $entity->setFechaCreacion(new \DateTime());
            $entity->setUsuarioCreacion($iduser);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vacuna', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Vacuna entity.
     *
     * @param Vacuna $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Vacuna $entity)
    {
        $form = $this->createForm(new VacunaType(), $entity, array(
            'action' => $this->generateUrl('vacuna_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Vacuna entity.
     *
     * @Route("/new", name="vacuna_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Vacuna();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Vacuna entity.
     *
     * @Route("/{id}", name="vacuna_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Vacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vacuna entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Vacuna entity.
     *
     * @Route("/{id}/edit", name="vacuna_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Vacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vacuna entity.');
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
    * Creates a form to edit a Vacuna entity.
    *
    * @param Vacuna $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Vacuna $entity)
    {
        $form = $this->createForm(new VacunaType(), $entity, array(
            'action' => $this->generateUrl('vacuna_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Vacuna entity.
     *
     * @Route("/{id}", name="vacuna_update")
     * @Method("PUT")
     * @Template("AppBundle:Vacuna:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Vacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vacuna entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $iduser = $this->getUser()->getUsername();
            $entity->setFechaCreacion(new \DateTime());
            $entity->setUsuarioCreacion($iduser);
            $em->flush();

            return $this->redirect($this->generateUrl('vacuna', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Vacuna entity.
     *
     * @Route("/{id}/eliminar", name="vacuna_delete")
     */
    public function deleteAction($id)
    {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Vacuna')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vacuna entity.');
            }

            $em->remove($entity);
            $em->flush();

        return $this->redirect($this->generateUrl('vacuna'));
    }

    /**
     * Creates a form to delete a Vacuna entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vacuna_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
