<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Mascota
 *
 * @ORM\Table(name="mascotas")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MascotaRepository")
 */
class Mascota
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_mascota", type="integer")
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
     * @var boolean
     *
     * @ORM\Column(name="sexo", type="boolean")
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="esterilizacion", type="string", length=100, nullable=true)
     */
    private $esterilizacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date")
     */
    private $fechaNacimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_alta", type="date")
     */
    private $fechaAlta;

    /**
     * @var string
     *
     * @ORM\Column(name="estadoMascota", type="string", length=100)
     */
    private $estadoMascota;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pedigri", type="boolean", nullable=true)
     */
    private $pedigri;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_pedigri", type="integer", nullable=true)
     */
    private $numPedigri;

    /**
     * @var string
     *
     * @ORM\Column(name="chip", type="string", length=50, nullable=true)
     */
    private $chip;

    /**
     * @var string
     *
     * @ORM\Column(name="caracter", type="string", length=100, nullable=true)
     */
    private $caracter;

    /**
     * @var string
     *
     * @ORM\Column(name="dieta", type="string", length=255, nullable=true)
     */
    private $dieta;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

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
     *
     * @ORM\ManyToMany(targetEntity="Cliente", mappedBy="mascotas", cascade={"persist"})
     */
    private $clientes;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Patologia", mappedBy="mascotas")
     */
    private $patologias;

    /**
     *
     * @ORM\OneToMany(targetEntity="MascotaConsulta", mappedBy="mascota")
     */
    private $mascota_consultas;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Vacuna", mappedBy="mascotas")
     */
    private $vacunas;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Desparasitante", mappedBy="mascotas")
     */
    private $desparasitantes;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Examen", mappedBy="mascotas")
     */
    private $examenes;

    /**
     *
     * @ORM\OneToMany(targetEntity="Peso", mappedBy="mascota")
     */
    private $pesos;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Pelaje", inversedBy="mascotas")
     * @ORM\JoinColumn(name="id_pelaje", referencedColumnName="id_pelaje")
     */
    private $pelaje;


    /**
 *
 * @ORM\ManyToOne(targetEntity="Raza", inversedBy="mascotas")
 * @ORM\JoinColumn(name="id_raza", referencedColumnName="id_raza")
 */
    private $raza;


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
     * @return Mascota
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
     * @return Mascota
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
     * Set esterilizacion
     *
     * @param string $esterilizacion
     * @return Mascota
     */
    public function setEsterilizacion($esterilizacion)
    {
        $this->esterilizacion = $esterilizacion;

        return $this;
    }

    /**
     * Get esterilizacion
     *
     * @return string
     */
    public function getEsterilizacion()
    {
        return $this->esterilizacion;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Mascota
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
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return Mascota
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
     * Set pedigri
     *
     * @param boolean $pedigri
     * @return Mascota
     */
    public function setPedigri($pedigri)
    {
        $this->pedigri = $pedigri;

        return $this;
    }

    /**
     * Get pedigri
     *
     * @return boolean
     */
    public function getPedigri()
    {
        return $this->pedigri;
    }

    /**
     * Set numPedigri
     *
     * @param integer $numPedigri
     * @return Mascota
     */
    public function setNumPedigri($numPedigri)
    {
        $this->numPedigri = $numPedigri;

        return $this;
    }

    /**
     * Get numPedigri
     *
     * @return integer
     */
    public function getNumPedigri()
    {
        return $this->numPedigri;
    }

    /**
     * Set chip
     *
     * @param string $chip
     * @return Mascota
     */
    public function setChip($chip)
    {
        $this->chip = $chip;

        return $this;
    }

    /**
     * Get chip
     *
     * @return string
     */
    public function getChip()
    {
        return $this->chip;
    }

    /**
     * Set caracter
     *
     * @param string $caracter
     * @return Mascota
     */
    public function setCaracter($caracter)
    {
        $this->caracter = $caracter;

        return $this;
    }

    /**
     * Get caracter
     *
     * @return string
     */
    public function getCaracter()
    {
        return $this->caracter;
    }

    /**
     * Set dieta
     *
     * @param string $dieta
     * @return Mascota
     */
    public function setDieta($dieta)
    {
        $this->dieta = $dieta;

        return $this;
    }

    /**
     * Get dieta
     *
     * @return string
     */
    public function getDieta()
    {
        return $this->dieta;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Mascota
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
     * @var string
     *
     * @ORM\Column(name="ruta_foto", type="string", length=255, nullable=true)
     */
    private $ruta_foto;

    /**
     * @Assert\Image(maxSize = "1000k")
     */
    private $foto;

    /**
     * @param UploadedFile $foto
     */
    public function setFoto(UploadedFile $foto = null)
    {
        $this->foto = $foto;
    }


    /**
     * @return UploadedFile
     */
    public function getFoto()
    {
        return $this->foto;
    }


    /**
     * Set ruta_foto
     *
     * @param string $rutaFoto
     * @return Mascota
     */
    public function setRutaFoto($rutaFoto)
    {
        $this->ruta_foto = $rutaFoto;

        return $this;
    }

    /**
     * Get ruta_foto
     *
     * @return string
     */
    public function getRutaFoto()
    {
        return $this->ruta_foto;
    }

    public function subirFoto()
{
    if (null === $this->foto) {
        return;
    }
    $directorioDestino = __DIR__.'/../../../web/uploads/images/mascotas/';
    $nombreArchivoFoto = uniqid('mascota-').'.jpg';
    $this->foto->move($directorioDestino, $nombreArchivoFoto);
    $this->ruta_foto = $nombreArchivoFoto;
}

    /**
     * Set pelaje
     *
     * @param \AppBundle\Entity\Pelaje $pelaje
     * @return Mascota
     */
    public function setPelaje(\AppBundle\Entity\Pelaje $pelaje = null)
    {
        $this->pelaje = $pelaje;

        return $this;
    }

    /**
     * Get pelaje
     *
     * @return \AppBundle\Entity\Pelaje 
     */
    public function getPelaje()
    {
        return $this->pelaje;
    }

    /**
     * Set raza
     *
     * @param \AppBundle\Entity\Raza $raza
     * @return Mascota
     */
    public function setRaza(\AppBundle\Entity\Raza $raza = null)
    {
        $this->raza = $raza;

        return $this;
    }

    /**
     * Get raza
     *
     * @return \AppBundle\Entity\Raza 
     */
    public function getRaza()
    {
        return $this->raza;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clientes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estado = 1;
    }

    /**
     * Add clientes
     *
     * @param \AppBundle\Entity\Cliente $clientes
     * @return Mascota
     */
    public function addCliente(\AppBundle\Entity\Cliente $clientes)
    {
        $clientes->addMascota($this);
        $this->clientes[] = $clientes;

        return $this;
    }

    /**
     * Remove clientes
     *
     * @param \AppBundle\Entity\Cliente $clientes
     */
    public function removeCliente(\AppBundle\Entity\Cliente $clientes)
    {
        $this->clientes->removeElement($clientes);
    }

    /**
     * Get clientes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClientes()
    {
        return $this->clientes;
    }

    /**
     * Add patologias
     *
     * @param \AppBundle\Entity\Patologia $patologias
     * @return Mascota
     */
    public function addPatologia(\AppBundle\Entity\Patologia $patologias)
    {
        $this->patologias[] = $patologias;

        return $this;
    }

    /**
     * Remove patologias
     *
     * @param \AppBundle\Entity\Patologia $patologias
     */
    public function removePatologia(\AppBundle\Entity\Patologia $patologias)
    {
        $this->patologias->removeElement($patologias);
    }

    /**
     * Get patologias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPatologias()
    {
        return $this->patologias;
    }


    /**
     * Add vacunas
     *
     * @param \AppBundle\Entity\Vacuna $vacunas
     * @return Mascota
     */
    public function addVacuna(\AppBundle\Entity\Vacuna $vacunas)
    {
        $this->vacunas[] = $vacunas;

        return $this;
    }

    /**
     * Remove vacunas
     *
     * @param \AppBundle\Entity\Vacuna $vacunas
     */
    public function removeVacuna(\AppBundle\Entity\Vacuna $vacunas)
    {
        $this->vacunas->removeElement($vacunas);
    }

    /**
     * Get vacunas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVacunas()
    {
        return $this->vacunas;
    }

    /**
     * Add desparasitantes
     *
     * @param \AppBundle\Entity\Desparasitante $desparasitantes
     * @return Mascota
     */
    public function addDesparasitante(\AppBundle\Entity\Desparasitante $desparasitantes)
    {
        $this->desparasitantes[] = $desparasitantes;

        return $this;
    }

    /**
     * Remove desparasitantes
     *
     * @param \AppBundle\Entity\Desparasitante $desparasitantes
     */
    public function removeDesparasitante(\AppBundle\Entity\Desparasitante $desparasitantes)
    {
        $this->desparasitantes->removeElement($desparasitantes);
    }

    /**
     * Get desparasitantes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDesparasitantes()
    {
        return $this->desparasitantes;
    }

    /**
     * Add examenes
     *
     * @param \AppBundle\Entity\Examen $examenes
     * @return Mascota
     */
    public function addExamene(\AppBundle\Entity\Examen $examenes)
    {
        $this->examenes[] = $examenes;

        return $this;
    }

    /**
     * Remove examenes
     *
     * @param \AppBundle\Entity\Examen $examenes
     */
    public function removeExamene(\AppBundle\Entity\Examen $examenes)
    {
        $this->examenes->removeElement($examenes);
    }

    /**
     * Get examenes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExamenes()
    {
        return $this->examenes;
    }

    /**
     * Add pesos
     *
     * @param \AppBundle\Entity\Peso $pesos
     * @return Mascota
     */
    public function addPeso(\AppBundle\Entity\Peso $pesos)
    {
        $this->pesos[] = $pesos;

        return $this;
    }

    /**
     * Remove pesos
     *
     * @param \AppBundle\Entity\Peso $pesos
     */
    public function removePeso(\AppBundle\Entity\Peso $pesos)
    {
        $this->pesos->removeElement($pesos);
    }

    /**
     * Get pesos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPesos()
    {
        return $this->pesos;
    }

    /**
     * Add mascota_consultas
     *
     * @param \AppBundle\Entity\MascotaConsulta $mascotaConsultas
     * @return Mascota
     */
    public function addMascotaConsulta(\AppBundle\Entity\MascotaConsulta $mascotaConsultas)
    {
        $this->mascota_consultas[] = $mascotaConsultas;

        return $this;
    }

    /**
     * Remove mascota_consultas
     *
     * @param \AppBundle\Entity\MascotaConsulta $mascotaConsultas
     */
    public function removeMascotaConsulta(\AppBundle\Entity\MascotaConsulta $mascotaConsultas)
    {
        $this->mascota_consultas->removeElement($mascotaConsultas);
    }

    /**
     * Get mascota_consultas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMascotaConsultas()
    {
        return $this->mascota_consultas;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Mascota
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
     * @return Mascota
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
     * @return Mascota
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
     * @return Mascota
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
     * Set estadoMascota
     *
     * @param string $estadoMascota
     *
     * @return Mascota
     */
    public function setEstadoMascota($estadoMascota)
    {
        $this->estadoMascota = $estadoMascota;

        return $this;
    }

    /**
     * Get estadoMascota
     *
     * @return string
     */
    public function getEstadoMascota()
    {
        return $this->estadoMascota;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Mascota
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
