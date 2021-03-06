<?php

namespace DGPlusbelleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * SeguimientoPaquete
 *
 * @ORM\Table(name="seguimiento_paquete", indexes={@ORM\Index(name="id_venta_paquete", columns={"id_venta_paquete"})})
 * @ORM\Entity
 */
class SeguimientoPaquete {
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
     * @var \VentaPaquete
     *
     * @ORM\ManyToOne(targetEntity="VentaPaquete", inversedBy="seguimiento_paquete")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_venta_paquete", referencedColumnName="id")
     * })
     */
    private $idVentaPaquete;
     
    /**
     * @var \Tratamiento
     *
     * @ORM\ManyToOne(targetEntity="Tratamiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tratamiento", referencedColumnName="id")
     * })
     */
    private $tratamiento;
    
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
     * @return SeguimientoPaquete
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
     * Set idVentaPaquete
     *
     * @param \DGPlusbelleBundle\Entity\VentaPaquete $idVentaPaquete
     *
     * @return SeguimientoPaquete
     */
    public function setVentaPaquete(\DGPlusbelleBundle\Entity\VentaPaquete $idVentaPaquete = null)
    {
        $this->idVentaPaquete = $idVentaPaquete;

        return $this;
    }

    /**
     * Get idVentaPaquete
     *
     * @return \DGPlusbelleBundle\Entity\VentaPaquete
     */
    public function getVentaPaquete()
    {
        return $this->idVentaPaquete;
    }
    
    /**
     * Set tratamiento
     *
     * @param \DGPlusbelleBundle\Entity\Tratamiento $tratamiento
     *
     * @return SeguimientoPaquete
     */
    public function setTratamiento(\DGPlusbelleBundle\Entity\Tratamiento $tratamiento = null)
    {
        $this->tratamiento = $tratamiento;

        return $this;
    }

    /**
     * Get tratamiento
     *
     * @return \DGPlusbelleBundle\Entity\Tratamiento
     */
    public function getTratamiento()
    {
        return $this->tratamiento;
    }
    
}
