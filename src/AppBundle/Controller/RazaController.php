<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Raza;
use AppBundle\Form\RazaType;

/**
 * Raza controller.
 *
 * @Route("/raza")
 */
class RazaController extends Controller
{

    /**
     * Lists all Raza entities.
     *
     * @Route("/", name="raza")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Raza')->findByEstado(1);
        return array(
            'entities' => $entities
        );
    }


    /**
     * razas por especies.
     *
     * @Route("/especie_raza", name="especie_raza")
     * @Method("POST")
     * @Template()
     */
    public function especie_razaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $especie_id = $request->get('especie_id');
        $es = $em->getRepository('AppBundle:Especie')->findById($especie_id);

        $entities = $em->getRepository('AppBundle:Raza')->findBy(array('especie' => $es));

        $rooms= array();
        $i = 0;
        foreach ($entities as $room) {
            $rooms[$i]['id']=$room->getId();
               $rooms[$i]['nombre'] = $room->getNombre();
            $i++;
        }

        return new JsonResponse($rooms);

    }
    /**
     * Creates a new Raza entity.
     *
     * @Route("/", name="raza_create")
     * @Method("POST")
     * @Template("AppBundle:Raza:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Raza();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $iduser = $this->getUser()->getUsername();
            $entity->setFechaCreacion(new \DateTime());
            $entity->setUsuarioCreacion($iduser);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('raza', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Raza entity.
     *
     * @param Raza $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Raza $entity)
    {
        $form = $this->createForm(new RazaType(), $entity, array(
            'action' => $this->generateUrl('raza_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new Raza entity.
     *
     * @Route("/new", name="raza_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Raza();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Raza entity.
     *
     * @Route("/{id}", name="raza_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Raza')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Raza entity.');
        }


        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Raza entity.
     *
     * @Route("/{id}/edit", name="raza_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Raza')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Raza entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Raza entity.
    *
    * @param Raza $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Raza $entity)
    {
        $form = $this->createForm(new RazaType(), $entity, array(
            'action' => $this->generateUrl('raza_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }
    /**
     * Edits an existing Raza entity.
     *
     * @Route("/{id}", name="raza_update")
     * @Method("PUT")
     * @Template("AppBundle:Raza:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Raza')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Raza entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setFechaModificacion(new \DateTime());
            $iduser = $this->getUser()->getUsername();
            $entity->setUsuarioModificacion($iduser);
            $em->flush();

            return $this->redirect($this->generateUrl('raza', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a Raza entity.
     *
     * @Route("/{id}/eliminar", name="raza_delete")
     */
    public function deleteAction( $id)
    {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Raza')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Raza entity.');
            }

            $entity->setEstado(0);
            $em->flush();

        return $this->redirect($this->generateUrl('raza'));
    }

}
