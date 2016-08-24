<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Desparasitante
 *
 * @ORM\Table(name="desparasitantes")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DesparasitanteRepository")
 */
class Desparasitante
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_desparasitante", type="integer")
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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Mascota", inversedBy="desparasitantes")
     * @ORM\JoinTable(name="mascotas_desparasitantes",
     * joinColumns={@ORM\JoinColumn(name="id_desparasitante", referencedColumnName="id_desparasitante")},
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
     * @return Desparasitante
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
     * @return Desparasitante
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
     * @return Desparasitante
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
     * @return Desparasitante
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
     * Add mascota
     *
     * @param \AppBundle\Entity\Mascota $mascota
     *
     * @return Desparasitante
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

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Desparasitante
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
     * @return Desparasitante
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
     * @return Desparasitante
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
     * @return Desparasitante
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
