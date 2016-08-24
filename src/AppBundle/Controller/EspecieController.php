<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Especie;
use AppBundle\Form\EspecieType;

/**
 * Especie controller.
 *
 * @Route("/especie")
 */
class EspecieController extends Controller
{

    /**
     * Lists all Especie entities.
     *
     * @Route("/", name="especie")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Especie')->findByEstado(1);

        return array(
            'entities' => $entities
        );
    }

    /**
     * Creates a new Especie entity.
     *
     * @Route("/", name="especie_create")
     * @Method("POST")
     * @Template("AppBundle:Especie:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Especie();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $iduser = $this->getUser()->getUsername();
            $entity->setFechaCreacion(new \DateTime());
            $entity->setUsuarioCreacion($iduser);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('especie', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Especie entity.
     *
     * @param Especie $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Especie $entity)
    {
        $form = $this->createForm(new EspecieType(), $entity, array(
            'action' => $this->generateUrl('especie_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Especie entity.
     *
     * @Route("/new", name="especie_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Especie();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Especie entity.
     *
     * @Route("/{id}", name="especie_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Especie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especie entity.');
        }


        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Especie entity.
     *
     * @Route("/{id}/edit", name="especie_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Especie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especie entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Especie entity.
    *
    * @param Especie $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Especie $entity)
    {
        $form = $this->createForm(new EspecieType(), $entity, array(
            'action' => $this->generateUrl('especie_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }
    /**
     * Edits an existing Especie entity.
     *
     * @Route("/{id}", name="especie_update")
     * @Method("PUT")
     * @Template("AppBundle:Especie:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Especie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especie entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setFechaModificacion(new \DateTime());
            $iduser = $this->getUser()->getUsername();
            $entity->setUsuarioModificacion($iduser);
            $em->flush();

            return $this->redirect($this->generateUrl('especie', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a Especie entity.
     *
     * @Route("/{id}/eliminar", name="especie_delete")
     */
    public function deleteAction($id)
    {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Especie')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Especie entity.');
            }

            $entity->setEstado(0);
            $em->flush();

        return $this->redirect($this->generateUrl('especie'));
    }

}
