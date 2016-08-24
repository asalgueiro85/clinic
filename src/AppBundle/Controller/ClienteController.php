<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tipo_Contactos;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Cliente;
use AppBundle\Entity\Direccion;
use AppBundle\Entity\Contactos;
use AppBundle\Form\ClienteType;


/**
 * Cliente controller.
 *
 * @Route("/cliente")
 */
class ClienteController extends Controller
{

    /**
     * Lists all Cliente entities.
     *
     * @Route("/", name="cliente")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Cliente')->findByEstado(1);

        return array(
            'entities' => $entities
        );
    }

//    /**
//     * Lists all Cliente entities.
//     *
//     * @Route("/find", name="cliente_find")
//     * @Method("POST")
//     */
//    public function findClienteAction(Request $request)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $m = $request->get('mascota_name');
//        $p = $request->get('propietario_name');
//        $entities = $em->getRepository('AppBundle:Cliente')->findCliente($m,$p);
//
//
//        return $this->render('AppBundle:Cliente:index.html.twig', array(
//            'entities' => $entities,
//            'mascota_name'=>$m,
//            'propietario_name'=>$p
//        ));
//    }

    /**
     * Creates a new Cliente entity.
     *
     * @Route("/", name="cliente_create")
     * @Method("POST")
     * @Template("AppBundle:Cliente:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Cliente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $ids = explode(".", $request->get('select4'));
        $em = $this->getDoctrine()->getManager();
        $ubigeo = $em->getRepository('AppBundle:Ubigeos')->ubigeoByIds($ids[0],$ids[1],$ids[2],$ids[3]);

        if ($form->isValid()) {

            $iduser = $this->getUser()->getUsername();
            $entity->setFechaCreacion(new \DateTime());
            $entity->setFechaAlta(new \DateTime());
           // $entity->setFechaNacimiento(new \DateTime());
           // dump($entity);die;
            $entity->setUsuarioCreacion($iduser);
            if($ubigeo)
                $entity->getDireccion()->setUbigeo($ubigeo);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mascota_new', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Cliente entity.
     *
     * @param Cliente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cliente $entity)
    {
        $form = $this->createForm(new ClienteType(), $entity, array(
            'action' => $this->generateUrl('cliente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Cliente entity.
     *
     * @Route("/new", name="cliente_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Cliente();

        $em = $this->getDoctrine()->getManager();
        $tcontactos = $em->getRepository('AppBundle:TipoContactos')->findAll();

        $dir = new Direccion();
        $entity->setDireccion($dir);
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'tcontactos' => $tcontactos
        );
    }

    /**
     * Finds and displays a Cliente entity.
     *
     * @Route("/{id}", name="cliente_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Cliente entity.
     *
     * @Route("/{id}/edit", name="cliente_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $tcontactos = $em->getRepository('AppBundle:TipoContactos')->findAll();

        $entity = $em->getRepository('AppBundle:Cliente')->find($id);
        $ubigeo = $entity->getDireccion()->getUbigeo();
        $combos['idpais'] = strval($ubigeo->getIdpais());
        $combos['iddep'] = strval($ubigeo->getIddep());
        $combos['idprov'] = strval($ubigeo->getIdprov());
        $combos['iddist'] = strval($ubigeo->getIddist());

        $combos['valpais'] = strval($ubigeo->getPais());
        $combos['valdep'] = strval($ubigeo->getDepartamento());
        $combos['valprov'] = strval($ubigeo->getProvincia());
        $combos['valdist'] = strval($ubigeo->getDistrito());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'contacts' => $entity->getContactos(),
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'combosVal'=> $combos,
            'tcontactos' => $tcontactos

        );
    }

    /**
     * Creates a form to edit a Cliente entity.
     *
     * @param Cliente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Cliente $entity)
    {
        $form = $this->createForm(new ClienteType(), $entity, array(
            'action' => $this->generateUrl('cliente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Cliente entity.
     *
     * @Route("/{id}", name="cliente_update")
     * @Method("PUT")
     * @Template("AppBundle:Cliente:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
//dump($request);die;
        $entity = $em->getRepository('AppBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }
        $contactosOld = array();

        // Crea un arreglo del los objetos  actualmente en la base de datos
        foreach ($entity->getContactos() as $contacto) {
            $contactosOld[] = $contacto;
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
//dump($editForm);die;

        if ($editForm->isValid()) {

            $ids = explode(".", $request->get('select4'));
            $em = $this->getDoctrine()->getManager();
            $ubigeo = $em->getRepository('AppBundle:Ubigeos')->ubigeoByIds($ids[0],$ids[1],$ids[2],$ids[3]);
            if($ubigeo)
                $entity->getDireccion()->setUbigeo($ubigeo);

            // filtra $originalTags para que contenga las etiquetas
            // que ya no están presentes
            foreach ($entity->getContactos() as $contacto) {
                foreach ($contactosOld as $key => $toDel) {
                    if ($toDel->getId() === $contacto->getId()) {
                        unset($contactosOld[$key]);
                    }
                }
            }

            // Elimina la relación entre la etiqueta y la Tarea
            foreach ($contactosOld as $contacto) {
                // Si deseas eliminar la etiqueta completamente, también lo puedes hacer
                $em->remove($contacto);
            }
            $entity->setFechaModificacion(new \DateTime());
            $iduser = $this->getUser()->getUsername();
            $entity->setUsuarioModificacion($iduser);

            $em->flush();

            return $this->redirect($this->generateUrl('cliente'));
        }

        $ubigeo = $entity->getDireccion()->getUbigeo();
        $combos['idpais'] = strval($ubigeo->getIdpais());
        $combos['iddep'] = strval($ubigeo->getIddep());
        $combos['idprov'] = strval($ubigeo->getIdprov());
        $combos['iddist'] = strval($ubigeo->getIddist());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }
        $tcontactos = $em->getRepository('AppBundle:TipoContactos')->findAll();

        return array(
            'entity' => $entity,
            'contacts' => $entity->getContactos(),
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'combosVal'=> $combos,
            'tcontactos' => $tcontactos

        );

    }

    /**
     * Deletes a Cliente entity.
     *
     * @Route("/delete/{id}", name="cliente_delete")
     */
    public function deleteAction(Request $request, $id)
    {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Cliente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cliente entity.');
            }

            $entity->setEstado(0);
            $em->flush();

        return $this->redirect($this->generateUrl('cliente'));
    }

    /**
     * Creates a form to delete a Cliente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cliente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }


    /**
     * ubigeos
     *
     * @Route("/combos_dependientes", name="combos_dependientes")
     * @Method("POST")
     * @Template()
     */
    public function combosDependientesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Ubigeos')->getPaisPadre();
        $rooms = array();
        $i = 0;
        foreach ($entities as $room) {
            $rooms[$room['idpais']]['des'] = $room['pais'];

            $depDep = $em->getRepository('AppBundle:Ubigeos')->elementosDep($room['idpais']);

            foreach ($depDep as $dep) {
                $rooms[$room['idpais']]['values'][$room['idpais'] . '.' . $dep['iddep']]['des'] = $dep['departamento'];
                $depProv = $em->getRepository('AppBundle:Ubigeos')->elementosProv($room['idpais'], $dep['iddep']);

                foreach ($depProv as $prov) {
                    $rooms[$room['idpais']]['values'][$room['idpais'] . '.' . $dep['iddep']]['values'][$room['idpais'] . '.' . $dep['iddep'] . '.' . $prov['idprov']]['des'] = $prov['provincia'];
                    $depDist = $em->getRepository('AppBundle:Ubigeos')->elementosDist($room['idpais'], $dep['iddep'], $prov['idprov']);

                    foreach ($depDist as $dist) {
                        $rooms[$room['idpais']]['values'][$room['idpais'] . '.' . $dep['iddep']]['values'][$room['idpais'] . '.' . $dep['iddep'] . '.' . $prov['idprov']]['values'][$room['idpais'] . '.' . $dep['iddep'] . '.' . $prov['idprov'] . '.' . $dist['iddist']]['des'] = $dist['distrito'];
                    }

                }
            }

            $i++;
        }
        return new JsonResponse($rooms);

    }
}
