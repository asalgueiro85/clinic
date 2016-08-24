<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Mascota;
use AppBundle\Form\MascotaType;

/**
 * Mascota controller.
 *
 * @Route("/mascota")
 */
class MascotaController extends Controller
{

    /**
     * Lists all Mascota entities.
     *
     * @Route("/", name="mascota")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Mascota')->findByEstado(1);
        /* $paginator  = $this->get('knp_paginator');
         $pagination = $paginator->paginate(
             $entities,
             $this->get('request')->query->get('page', 1),
             10
         );*/
        return array(
            'entities' => $entities
        );
    }

    /**
     * Creates a new Mascota entity.
     *
     * @Route("/{id}/create", defaults = {"id":"1"}, name="mascota_create")
     * @Method("POST")
     * @Template("AppBundle:Mascota:new.html.twig")
     */
    public function createAction(Request $request, $id)
    {
        $entity = new Mascota();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $cliente = $em->getRepository('AppBundle:Cliente')->find($id);

        if ($form->isValid()) {
            $entity->subirFoto();
            $entity->setFechaAlta(new \DateTime());
            $iduser = $this->getUser()->getUsername();
            $entity->setFechaCreacion(new \DateTime());
            $entity->setUsuarioCreacion($iduser);
            $entity->addCliente($cliente);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cliente'/*, array('id' => $entity->getId())*/));
        }
        $especies = $em->getRepository('AppBundle:Especie')->findAll();
        return array(
            'entity' => $entity,
            'cliente' => $id,
            'especies' => $especies,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Mascota entity.
     *
     * @param Mascota $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Mascota $entity)
    {
        $form = $this->createForm(new MascotaType(), $entity, array(
            'action' => $this->generateUrl('mascota_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Mascota entity.
     *
     * @Route("/{id}/new", name="mascota_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id)
    {
        $entity = new Mascota();
        $form   = $this->createCreateForm($entity);
        $em = $this->getDoctrine()->getManager();
        $especies = $em->getRepository('AppBundle:Especie')->findByEstado(1);
        $clientes = $em->getRepository('AppBundle:Cliente')->find($id);
      //  var_dump($especies);die('as');
        return array(
            'entity' => $entity,
            'especies' => $especies,
            'cliente' => $id,
            'clientes' => $clientes,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Mascota entity.
     *
     * @Route("/{id}", name="mascota_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Mascota')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mascota entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Mascota entity.
     *
     * @Route("/{id}/edit", name="mascota_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Mascota')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mascota entity.');
        }
        $especies = $em->getRepository('AppBundle:Especie')->findAll();

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'especies' => $especies,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Mascota entity.
    *
    * @param Mascota $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Mascota $entity)
    {
        $form = $this->createForm(new MascotaType(), $entity, array(
            'action' => $this->generateUrl('mascota_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }
    /**
     * Edits an existing Mascota entity.
     *
     * @Route("/{id}", name="mascota_update")
     * @Method("PUT")
     * @Template("AppBundle:Mascota:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Mascota')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mascota entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->subirFoto();
            $entity->setFechaModificacion(new \DateTime());
            $iduser = $this->getUser()->getUsername();
            $entity->setUsuarioModificacion($iduser);
            $em->flush();

            return $this->redirect($this->generateUrl('cliente'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a Mascota entity.
     *
     * @Route("/delete/{id}", name="mascota_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id)
    {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Mascota')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Mascota entity.');
            }

            $entity->setEstado(0);
            $em->flush();

        return $this->redirect($this->generateUrl('mascota'));
    }

}
