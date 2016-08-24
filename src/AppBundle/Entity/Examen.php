<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Examen
 *
 * @ORM\Table(name="examenes")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ExamenRepository")
 */
class Examen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_examen", type="integer")
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
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Mascota", inversedBy="examenes")
     * @ORM\JoinTable(name="mascotas_examenes",
     * joinColumns={@ORM\JoinColumn(name="id_examen", referencedColumnName="id_examen")},
     * inverseJoinColumns={@ORM\JoinColumn(name="id_mascota", referencedColumnName="id_mascota")})
     */
    private $mascotas;

    /**
     *
     * @ORM\OneToMany(targetEntity="ExamenAtributo", mappedBy="examen")
     */
    private $examen_atributos;

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

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mascotas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->examen_atributos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Examen
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Examen
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
     * Add mascotas
     *
     * @param \AppBundle\Entity\Mascota $mascotas
     * @return Examen
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
     * Get mascotas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMascotas()
    {
        return $this->mascotas;
    }

    /**
     * Add examen_atributos
     *
     * @param \AppBundle\Entity\ExamenAtributo $examenAtributos
     * @return Examen
     */
    public function addExamenAtributo(\AppBundle\Entity\ExamenAtributo $examenAtributos)
    {
        $this->examen_atributos[] = $examenAtributos;

        return $this;
    }

    /**
     * Remove examen_atributos
     *
     * @param \AppBundle\Entity\ExamenAtributo $examenAtributos
     */
    public function removeExamenAtributo(\AppBundle\Entity\ExamenAtributo $examenAtributos)
    {
        $this->examen_atributos->removeElement($examenAtributos);
    }

    /**
     * Get examen_atributos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExamenAtributos()
    {
        return $this->examen_atributos;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Examen
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
     * @return Examen
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
     * @return Examen
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
     * @return Examen
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
     * @return Examen
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
}
