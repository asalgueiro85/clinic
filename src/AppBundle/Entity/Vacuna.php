<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vacuna
 *
 * @ORM\Table(name="vacunas")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\VacunaRepository")
 */
class Vacuna
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_vacuna", type="integer")
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
     * @var integer
     *
     * @ORM\Column(name="caduca", type="integer")
     */
    private $caduca;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

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
     *
     * @ORM\ManyToMany(targetEntity="Mascota", inversedBy="vacunas")
     * @ORM\JoinTable(name="mascotas_vacunas",
     * joinColumns={@ORM\JoinColumn(name="id_vacuna", referencedColumnName="id_vacuna")},
     * inverseJoinColumns={@ORM\JoinColumn(name="id_mascota", referencedColumnName="id_mascota")})
     */
    private $mascotas;


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
     * @return Vacuna
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
     * Set caduca
     *
     * @param integer $caduca
     * @return Vacuna
     */
    public function setCaduca($caduca)
    {
        $this->caduca = $caduca;

        return $this;
    }

    /**
     * Get caduca
     *
     * @return integer 
     */
    public function getCaduca()
    {
        return $this->caduca;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return Vacuna
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Vacuna
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mascotas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Vacuna
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     *
     * @return Vacuna
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

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
     * Set usuarioCreacion
     *
     * @param string $usuarioCreacion
     *
     * @return Vacuna
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
     * @return Vacuna
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
     * Add mascota
     *
     * @param \AppBundle\Entity\Mascota $mascota
     *
     * @return Vacuna
     */
    public function addMascota(\AppBundle\Entity\Mascota $mascota)
    {
        $this->mascotas[] = $mascota;

        return $this;
    }

    /**
     * Remove mascota
     *
     * @param \AppBundle\Entity\Mascota $mascota
     */
    public function removeMascota(\AppBundle\Entity\Mascota $mascota)
    {
        $this->mascotas->removeElement($mascota);
    }

    /**
     * Get mascotas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMascotas()
    {
        return $this->mascotas;
    }
}
