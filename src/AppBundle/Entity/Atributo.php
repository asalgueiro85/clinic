<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Atributo
 *
 * @ORM\Table(name="atributos")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AtributoRepository")
 */
class Atributo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_atributo", type="integer")
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
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_valor", type="integer")
     */
    private $tipoValor;

    /**
     * @var string
     *
     * @ORM\Column(name="unidad", type="string", length=10)
     */
    private $unidad;

    /**
     * @var string
     *
     * @ORM\Column(name="unidad_valor", type="string", length=10)
     */
    private $unidadValor;

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
     * @ORM\OneToMany(targetEntity="ExamenAtributo", mappedBy="atributo")
     */
    private $examen_atributos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->examen_atributos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Atributo
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
     * Set tipo
     *
     * @param integer $tipo
     * @return Atributo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set tipoValor
     *
     * @param integer $tipoValor
     * @return Atributo
     */
    public function setTipoValor($tipoValor)
    {
        $this->tipoValor = $tipoValor;

        return $this;
    }

    /**
     * Get tipoValor
     *
     * @return integer 
     */
    public function getTipoValor()
    {
        return $this->tipoValor;
    }

    /**
     * Set unidad
     *
     * @param string $unidad
     * @return Atributo
     */
    public function setUnidad($unidad)
    {
        $this->unidad = $unidad;

        return $this;
    }

    /**
     * Get unidad
     *
     * @return string 
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * Set unidadValor
     *
     * @param string $unidadValor
     * @return Atributo
     */
    public function setUnidadValor($unidadValor)
    {
        $this->unidadValor = $unidadValor;

        return $this;
    }

    /**
     * Get unidadValor
     *
     * @return string 
     */
    public function getUnidadValor()
    {
        return $this->unidadValor;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return Atributo
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
     * @return Atributo
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
     * Add examen_atributos
     *
     * @param \AppBundle\Entity\ExamenAtributo $examenAtributos
     * @return Atributo
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
     * @return Atributo
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
     * @return Atributo
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
     * @return Atributo
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
     * @return Atributo
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
}
