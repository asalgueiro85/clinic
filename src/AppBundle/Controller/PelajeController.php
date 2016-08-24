<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Pelaje;
use AppBundle\Form\PelajeType;

/**
 * Pelaje controller.
 *
 * @Route("/pelaje")
 */
class PelajeController extends Controller
{

    /**
     * Lists all Pelaje entities.
     *
     * @Route("/", name="pelaje")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Pelaje')->findByEstado(1);
        return array(
            'entities' => $entities
        );
    }
    /**
     * Creates a new Pelaje entity.
     *
     * @Route("/", name="pelaje_create")
     * @Method("POST")
     * @Template("AppBundle:Pelaje:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Pelaje();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $iduser = $this->getUser()->getUsername();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setFechaCreacion(new \DateTime());
            $entity->setUsuarioCreacion($iduser);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pelaje'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Pelaje entity.
     *
     * @param Pelaje $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pelaje $entity)
    {
        $form = $this->createForm(new PelajeType(), $entity, array(
            'action' => $this->generateUrl('pelaje_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new Pelaje entity.
     *
     * @Route("/new", name="pelaje_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Pelaje();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pelaje entity.
     *
     * @Route("/{id}", name="pelaje_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Pelaje')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pelaje entity.');
        }


        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Pelaje entity.
     *
     * @Route("/{id}/edit", name="pelaje_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Pelaje')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pelaje entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Pelaje entity.
    *
    * @param Pelaje $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pelaje $entity)
    {
        $form = $this->createForm(new PelajeType(), $entity, array(
            'action' => $this->generateUrl('pelaje_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }
    /**
     * Edits an existing Pelaje entity.
     *
     * @Route("/{id}", name="pelaje_update")
     * @Method("PUT")
     * @Template("AppBundle:Pelaje:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Pelaje')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pelaje entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setFechaModificacion(new \DateTime());
            $iduser = $this->getUser()->getUsername();
            $entity->setUsuarioModificacion($iduser);
            $em->flush();

            return $this->redirect($this->generateUrl('pelaje', array('id' => $id)));
        }

        return $this->render('AppBundle:Pelaje:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    /**
     * Deletes a Pelaje entity.
     * @Route("/{id}/eliminar", name="pelaje_delete")
     */
    public function deleteAction( $id)
    {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Pelaje')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pelaje entity.');
            }

            $entity->setEstado(0);
            $em->flush();


        return $this->redirect($this->generateUrl('pelaje'));
    }

}
