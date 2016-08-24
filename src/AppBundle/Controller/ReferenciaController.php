<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Referencia;
use AppBundle\Form\ReferenciaType;

/**
 * Referencia controller.
 *
 * @Route("/referencia")
 */
class ReferenciaController extends Controller
{

    /**
     * Lists all Referencia entities.
     *
     * @Route("/", name="referencia")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Referencia')->findByEstado(1);

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Referencia entity.
     *
     * @Route("/", name="referencia_create")
     * @Method("POST")
     * @Template("AppBundle:Referencia:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Referencia();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $iduser = $this->getUser()->getUsername();
            $entity->setFechaCreacion(new \DateTime());
            $entity->setUsuarioCreacion($iduser);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('referencia', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Referencia entity.
     *
     * @param Referencia $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Referencia $entity)
    {
        $form = $this->createForm(new ReferenciaType(), $entity, array(
            'action' => $this->generateUrl('referencia_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Referencia entity.
     *
     * @Route("/new", name="referencia_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Referencia();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Referencia entity.
     *
     * @Route("/{id}", name="referencia_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Referencia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referencia entity.');
        }


        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Referencia entity.
     *
     * @Route("/{id}/edit", name="referencia_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Referencia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referencia entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Referencia entity.
    *
    * @param Referencia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Referencia $entity)
    {
        $form = $this->createForm(new ReferenciaType(), $entity, array(
            'action' => $this->generateUrl('referencia_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Referencia entity.
     *
     * @Route("/{id}", name="referencia_update")
     * @Method("PUT")
     * @Template("AppBundle:Referencia:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Referencia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referencia entity.');
        }
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setFechaModificacion(new \DateTime());
            $iduser = $this->getUser()->getUsername();
            $entity->setUsuarioModificacion($iduser);
            $em->flush();

            return $this->redirect($this->generateUrl('referencia', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a Referencia entity.
     *
     * @Route("/delete/{id}", name="referencia_delete")
     */
    public function deleteAction($id)
    {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Referencia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Referencia entity.');
            }

            $entity->setEstado(0);
            $entity->setMostrar(0);
            $em->flush();


        return $this->redirect($this->generateUrl('referencia'));
    }

    /**
     * Creates a form to delete a Referencia entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('referencia_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
