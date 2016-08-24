<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Direccion
 *
 * @ORM\Table(name="clientes_direcciones")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DireccionRepository")
 */
class Direccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cliente_dirección", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="text")
     */
    private $direccion;


    /**
     * @var string
     *
     * @ORM\Column(name="referencia", type="text")
     */
    private $referencia;

    /**
     *
     * @ORM\OneToOne(targetEntity="Cliente", mappedBy="direccion")
     * @ORM\JoinColumn(name="id_cliente", referencedColumnName="id_cliente")
     */
    private $cliente;

    /**
 * @ORM\ManyToOne(targetEntity="Ubigeos", inversedBy="direcciones")
 * @ORM\JoinColumn(name="id_ubigeo", referencedColumnName="id_ubigeo")
 */
    private $ubigeo;

    /**
     * Set user
     *
     * @param \AppBundle\Entity\Cliente $cliente
     * @return Direccion
     */
    public function setCliente(\AppBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }
    /**
     * Get user
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     * @return Direccion
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }

    /**
     * Get referencia
     *
     * @return string
     */
    public function getReferencia()
    {
        return $this->referencia;
    }


    /**
     * Set ubigeo
     *
     * @param \AppBundle\Entity\Ubigeos $ubigeo
     *
     * @return Direccion
     */
    public function setUbigeo(\AppBundle\Entity\Ubigeos $ubigeo = null)
    {
        $this->ubigeo = $ubigeo;

        return $this;
    }

    /**
     * Get ubigeo
     *
     * @return \AppBundle\Entity\Ubigeos
     */
    public function getUbigeo()
    {
        return $this->ubigeo;
    }
}
