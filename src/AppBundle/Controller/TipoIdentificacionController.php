<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\TipoIdentificacion;
use AppBundle\Form\TipoIdentificacionType;

/**
 * TipoIdentificacion controller.
 *
 * @Route("/tipoidentificacion")
 */
class TipoIdentificacionController extends Controller
{

    /**
     * Lists all TipoIdentificacion entities.
     *
     * @Route("/", name="tipoidentificacion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:TipoIdentificacion')->findByEstado(1);

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TipoIdentificacion entity.
     *
     * @Route("/", name="tipoidentificacion_create")
     * @Method("POST")
     * @Template("AppBundle:TipoIdentificacion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TipoIdentificacion();
        $form = $this->createCreateForm($entity);
        $iduser = $this->getUser()->getUsername();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setFechaCreacion(new \DateTime());
            $entity->setUsuarioCreacion($iduser);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipoidentificacion', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TipoIdentificacion entity.
     *
     * @param TipoIdentificacion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoIdentificacion $entity)
    {
        $form = $this->createForm(new TipoIdentificacionType(), $entity, array(
            'action' => $this->generateUrl('tipoidentificacion_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoIdentificacion entity.
     *
     * @Route("/new", name="tipoidentificacion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TipoIdentificacion();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TipoIdentificacion entity.
     *
     * @Route("/{id}", name="tipoidentificacion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TipoIdentificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoIdentificacion entity.');
        }


        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing TipoIdentificacion entity.
     *
     * @Route("/{id}/edit", name="tipoidentificacion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TipoIdentificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoIdentificacion entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a TipoIdentificacion entity.
    *
    * @param TipoIdentificacion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoIdentificacion $entity)
    {
        $form = $this->createForm(new TipoIdentificacionType(), $entity, array(
            'action' => $this->generateUrl('tipoidentificacion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }
    /**
     * Edits an existing TipoIdentificacion entity.
     *
     * @Route("/{id}", name="tipoidentificacion_update")
     * @Method("PUT")
     * @Template("AppBundle:TipoIdentificacion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TipoIdentificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoIdentificacion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setFechaModificacion(new \DateTime());
            $iduser = $this->getUser()->getUsername();
            $entity->setUsuarioModificacion($iduser);
            $em->flush();

            return $this->redirect($this->generateUrl('tipoidentificacion'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a TipoIdentificacion entity.
     *
     * @Route("/delete/{id}", name="tipoidentificacion_delete")
     */
    public function deleteAction(Request $request, $id)
    {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:TipoIdentificacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoIdentificacion entity.');
            }

        $entity->setEstado(0);
            $em->flush();

        return $this->redirect($this->generateUrl('tipoidentificacion'));
    }

    /**
     * Creates a form to delete a TipoIdentificacion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipoidentificacion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
