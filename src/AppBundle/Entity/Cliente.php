<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;
use  Doctrine\Common\Collections\ArrayCollection;

/**
 * Cliente
 *
 * @ORM\Table(name="clientes")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ClienteRepository")
 */
class Cliente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cliente", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=250)
     */
    private $apellidos;


    /**
     * @var boolean
     *
     * @ORM\Column(name="sexo", type="boolean")
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="nacionalidad", type="string", length=100)
     */
    private $nacionalidad;


    /**
     * @var string
     *
     * @ORM\Column(name="nro_identficacion", type="string", length=20)
     */
    private $identficacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_cliente", type="integer")
     */
    private $tipoCliente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date")
     */
    private $fechaNacimiento;


    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text")
     */
    private $observaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_alta", type="date")
     */
    private $fechaAlta;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Mascota", inversedBy="clientes", cascade={"persist"})
     * @ORM\JoinTable(name="mascotas_clientes",
     * joinColumns={@ORM\JoinColumn(name="id_cliente", referencedColumnName="id_cliente")},
     * inverseJoinColumns={@ORM\JoinColumn(name="id_mascota", referencedColumnName="id_mascota")})
    */
    private $mascotas;

    /**
     *
     * @ORM\OneToMany(targetEntity="Contactos", mappedBy="cliente", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $contactos;


    /**
     *
     * @ORM\OneToOne(targetEntity="Direccion", mappedBy="cliente", cascade={"persist","remove"})
     *  @Assert\Valid
     */
    private $direccion;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Referencia", inversedBy="clientes")
     * @ORM\JoinColumn(name="id_referencia", referencedColumnName="id_referencia")
     */
    private $referencia;

    /**
     *
     * @ORM\ManyToOne(targetEntity="TipoIdentificacion", inversedBy="clientes")
     * @ORM\JoinColumn(name="id_tipoIdentificacion", referencedColumnName="id_tipoIdentificacion")
     */
    private $tipoIdentificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date")
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="date", nullable=true)
     */
    private $fechaModificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_creacion", type="string", length=100)
     */
    private $usuarioCreacion;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_modificacion", type="string", length=100, nullable=true)
     */
    private $usuarioModificacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", options={"default":1}, nullable=true)
     */
    private $estado;

    function __construct()
    {
        $this->contactos =  new ArrayCollection();
        $this->estado = 1;
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
     * Set nombre
     *
     * @param string $nombre
     * @return Cliente
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }



    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }


    /**
     * Set sexo
     *
     * @param boolean $sexo
     * @return Cliente
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return boolean 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set nacionalidad
     *
     * @param string $nacionalidad
     * @return Cliente
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * Get nacionalidad
     *
     * @return string 
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set identficacion
     *
     * @param string $identficacion
     * @return Cliente
     */
    public function setIdentficacion($identficacion)
    {
        $this->identficacion = $identficacion;

        return $this;
    }

    /**
     * Get identficacion
     *
     * @return string 
     */
    public function getIdentficacion()
    {
        return $this->identficacion;
    }

    /**
     * Set tipoCliente
     *
     * @param integer $tipoCliente
     * @return Cliente
     */
    public function setTipoCliente($tipoCliente)
    {
        $this->tipoCliente = $tipoCliente;

        return $this;
    }

    /**
     * Get tipoCliente
     *
     * @return integer 
     */
    public function getTipoCliente()
    {
        return $this->tipoCliente;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Cliente
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Cliente
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return Cliente
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime 
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Cliente
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = new \DateTime();

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * @return mixed
     */
    public function getContactos()
    {
        return $this->contactos;
    }

    /**
     * @param  ArrayCollection $contactos
     */
    public function setContactos( ArrayCollection $contactos)
    {
        $this->contactos = $contactos;
        foreach ($contactos as $contacto) {
            $contacto->setCliente($this);
        }
    }

    /**
     * @return \AppBundle\Entity\Direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }


    /**
     * Set profile
     *
     * @param \AppBundle\Entity\Direccion $direccion
     * @return Cliente
     */
    public function setDireccion(\AppBundle\Entity\Direccion $direccion = null)
    {
        $this->direccion = $direccion;
        $direccion->setCliente($this);

        return $this;

    }

    /**
     * @return mixed
     */
    public function getMascotas()
    {
        return $this->mascotas;
    }

    /**
     * @param mixed $mascotas
     */
    public function setMascotas($mascotas)
    {
        $this->mascotas = $mascotas;
    }



    /**
     * toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->nombre." ".$this->apellido1." ".$this->apellido2;
    }

    /**
     * Get nuevo
     *
     * @return string
     */
    public function getNuevo()
    {
        return "Hay mamam";
    }



    /**
     * Add mascotas
     *
     * @param \AppBundle\Entity\Mascota $mascotas
     * @return Cliente
     */
    public function addMascota(\AppBundle\Entity\Mascota $mascotas)
    {
        $this->mascotas[] = $mascotas;

        return $this;
    }

    /**
     * Remove mascotas
     *
     * @param \AppBundle\Entity\Mascota $mascotas
     */
    public function removeMascota(\AppBundle\Entity\Mascota $mascotas)
    {
        $this->mascotas->removeElement($mascotas);
    }

    /**
     * Add contactos
     *
     * @param \AppBundle\Entity\Contactos $contactos
     * @return Cliente
     */
    public function addContacto(\AppBundle\Entity\Contactos $contactos)
    {
        $contactos->setCliente($this);
        $this->contactos[] = $contactos;

        return $this;
    }

    /**
     * Remove contactos
     *
     * @param \AppBundle\Entity\Contactos $contactos
     */
    public function removeContacto(\AppBundle\Entity\Contactos $contactos)
    {
        $this->contactos->removeElement($contactos);
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Cliente
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set usuarioCreacion
     *
     * @param string $usuarioCreacion
     *
     * @return Cliente
     */
    public function setUsuarioCreacion($usuarioCreacion)
    {
        $this->usuarioCreacion = $usuarioCreacion;

        return $this;
    }

    /**
     * Get usuarioCreacion
     *
     * @return string
     */
    public function getUsuarioCreacion()
    {
        return $this->usuarioCreacion;
    }

    /**
     * Set usuarioModificacion
     *
     * @param string $usuarioModificacion
     *
     * @return Cliente
     */
    public function setUsuarioModificacion($usuarioModificacion)
    {
        $this->usuarioModificacion = $usuarioModificacion;

        return $this;
    }

    /**
     * Get usuarioModificacion
     *
     * @return string
     */
    public function getUsuarioModificacion()
    {
        return $this->usuarioModificacion;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Cliente
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Cliente
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }


    /**
     * Set referencia
     *
     * @param \AppBundle\Entity\Referencia $referencia
     *
     * @return Cliente
     */
    public function setReferencia(\AppBundle\Entity\Referencia $referencia = null)
    {
        $this->referencia = $referencia;

        return $this;
    }

    /**
     * Get referencia
     *
     * @return \AppBundle\Entity\Referencia
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Set tipoIdentificacion
     *
     * @param \AppBundle\Entity\TipoIdentificacion $tipoIdentificacion
     *
     * @return Cliente
     */
    public function setTipoIdentificacion(\AppBundle\Entity\TipoIdentificacion $tipoIdentificacion = null)
    {
        $this->tipoIdentificacion = $tipoIdentificacion;

        return $this;
    }

    /**
     * Get tipoIdentificacion
     *
     * @return \AppBundle\Entity\TipoIdentificacion
     */
    public function getTipoIdentificacion()
    {
        return $this->tipoIdentificacion;
    }
}
