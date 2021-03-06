<?php

namespace DGPlusbelleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SeguimientoTratamiento
 *
 * @ORM\Table(name="seguimiento_tratamiento", indexes={@ORM\Index(name="id_persona_tratamiento", columns={"id_persona_tratamiento"})})
 * @ORM\Entity
 */
class SeguimientoTratamiento {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_sesion", type="integer", nullable=false)
     */
    private $numSesion;
    
     /**
     * @var string
     *
     * @ORM\Column(name="foto_antes", type="string", length=255, nullable=true)
     */
    private $fotoAntes;
    
     /**
     * @var string
     *
     * @ORM\Column(name="foto_despues", type="string", length=255, nullable=true)
     */
    private $fotoDespues;
    
    /**
     * @var \PersonaTratamiento
     *
     * @ORM\ManyToOne(targetEntity="PersonaTratamiento", inversedBy="seguimiento_tratamiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona_tratamiento", referencedColumnName="id")
     * })
     */
    private $idPersonaTratamiento;
    
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
     * Set numSesion
     *
     * @param integer $numSesion
     *
     * @return SeguimientoTratamiento
     */
    public function setNumSesion($numSesion)
    {
        $this->numSesion = $numSesion;

        return $this;
    }

    /**
     * Get numSesion
     *
     * @return integer
     */
    public function getNumSesion()
    {
        return $this->numSesion;
    }
    
     /**
     * Set fotoAntes
     *
     * @param string $fotoAntes
     *
     * @return SeguimientoPaquete
     */
    public function setFotoAntes($fotoAntes)
    {
        $this->fotoAntes = $fotoAntes;

        return $this;
    }

    /**
     * Get fotoAntes
     *
     * @return string
     */
    public function getFotoAntes()
    {
        return $this->fotoAntes;
    }
    
     /**
     * Set fotoDespues
     *
     * @param string $fotoDespues
     *
     * @return SeguimientoPaquete
     */
    public function setFotoDespues($fotoDespues)
    {
        $this->fotoDespues = $fotoDespues;

        return $this;
    }

    /**
     * Get fotoDespues
     *
     * @return string
     */
    public function getFotoDespues()
    {
        return $this->fotoDespues;
    }
    
    /**
     * Set idPersonaTratamiento
     *
     * @param \DGPlusbelleBundle\Entity\PersonaTratamiento $idPersonaTratamiento
     *
     * @return SeguimientoTratamiento
     */
    public function setPersonaTratamiento(\DGPlusbelleBundle\Entity\PersonaTratamiento $idPersonaTratamiento = null)
    {
        $this->idPersonaTratamiento = $idPersonaTratamiento;

        return $this;
    }

    /**
     * Get idPersonaTratamiento
     *
     * @return \DGPlusbelleBundle\Entity\PersonaTratamiento
     */
    public function getPersonaTratamiento()
    {
        return $this->idPersonaTratamiento;
    }
}
