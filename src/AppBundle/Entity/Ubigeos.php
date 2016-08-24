<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ubigeos
 *
 * @ORM\Table(name="ubigeos")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UbigeosRepository")
 */
class Ubigeos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_ubigeo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="iddep", type="integer")
     */
    private $iddep;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpais", type="integer")
     */
    private $idpais;

    /**
     * @var integer
     *
     * @ORM\Column(name="idprov", type="integer")
     */
    private $idprov;

    /**
     * @var integer
     *
     * @ORM\Column(name="iddist", type="integer")
     */
    private $iddist;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=255)
     */
    private $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="departamento", type="string", length=255)
     */
    private $departamento;

    /**
     * @var string
     *
     * @ORM\Column(name="provincia", type="string", length=255)
     */
    private $provincia;

    /**
     * @var string
     *
     * @ORM\Column(name="distrito", type="string", length=255)
     */
    private $distrito;

    /**
     *
     * @ORM\OneToMany(targetEntity="Direccion", mappedBy="ubigeo")
     */
    private $direcciones;


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
     * Set iddep
     *
     * @param integer $iddep
     *
     * @return Ubigeos
     */
    public function setIddep($iddep)
    {
        $this->iddep = $iddep;

        return $this;
    }

    /**
     * Get iddep
     *
     * @return integer
     */
    public function getIddep()
    {
        return $this->iddep;
    }

    /**
     * Set idpais
     *
     * @param integer $idpais
     *
     * @return Ubigeos
     */
    public function setIdpais($idpais)
    {
        $this->idpais = $idpais;

        return $this;
    }

    /**
     * Get idpais
     *
     * @return integer
     */
    public function getIdpais()
    {
        return $this->idpais;
    }

    /**
     * Set idprov
     *
     * @param integer $idprov
     *
     * @return Ubigeos
     */
    public function setIdprov($idprov)
    {
        $this->idprov = $idprov;

        return $this;
    }

    /**
     * Get idprov
     *
     * @return integer
     */
    public function getIdprov()
    {
        return $this->idprov;
    }

    /**
     * Set iddist
     *
     * @param integer $iddist
     *
     * @return Ubigeos
     */
    public function setIddist($iddist)
    {
        $this->iddist = $iddist;

        return $this;
    }

    /**
     * Get iddist
     *
     * @return integer
     */
    public function getIddist()
    {
        return $this->iddist;
    }

    /**
     * Set pais
     *
     * @param string $pais
     *
     * @return Ubigeos
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set departamento
     *
     * @param string $departamento
     *
     * @return Ubigeos
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return string
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     *
     * @return Ubigeos
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set distrito
     *
     * @param string $distrito
     *
     * @return Ubigeos
     */
    public function setDistrito($distrito)
    {
        $this->distrito = $distrito;

        return $this;
    }

    /**
     * Get distrito
     *
     * @return string
     */
    public function getDistrito()
    {
        return $this->distrito;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->direcciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add direccione
     *
     * @param \AppBundle\Entity\Direccion $direccione
     *
     * @return Ubigeos
     */
    public function addDireccione(\AppBundle\Entity\Direccion $direccione)
    {
        $this->direcciones[] = $direccione;

        return $this;
    }

    /**
     * Remove direccione
     *
     * @param \AppBundle\Entity\Direccion $direccione
     */
    public function removeDireccione(\AppBundle\Entity\Direccion $direccione)
    {
        $this->direcciones->removeElement($direccione);
    }

    /**
     * Get direcciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDirecciones()
    {
        return $this->direcciones;
    }
}
