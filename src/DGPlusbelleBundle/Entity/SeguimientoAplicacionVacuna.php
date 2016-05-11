<?php

namespace DGPlusbelleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * SeguimientoAplicacionVacuna
 *
 * @ORM\Table(name="seguimiento_aplicacion_vacuna", indexes={@ORM\Index(name="venta_vacuna", columns={"venta_vacuna"})})
 * @ORM\Entity
 */
class SeguimientoAplicacionVacuna {
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
     * @ORM\Column(name="num_aplicacion", type="integer", nullable=false)
     */
    private $numAplicacion;
    
    
    /**
     * @var \VentaVacuna
     *
     * @ORM\ManyToOne(targetEntity="VentaVacuna")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="venta_vacuna", referencedColumnName="id")
     * })
     */
    private $ventaVacuna;
     
    /**
     * @var \Vacuna
     *
     * @ORM\ManyToOne(targetEntity="Vacuna")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vacuna", referencedColumnName="id")
     * })
     */
    private $vacuna;
    
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
     * Set numAplicacion
     *
     * @param integer $numAplicacion
     *
     * @return SeguimientoAplicacionVacuna
     */
    public function setNumAplicacion($numAplicacion)
    {
        $this->numAplicacion = $numAplicacion;

        return $this;
    }

    /**
     * Get numAplicacion
     *
     * @return integer
     */
    public function getNumAplicacion()
    {
        return $this->numAplicacion;
    }
    
    
    /**
     * Set ventaVacuna
     *
     * @param \DGPlusbelleBundle\Entity\VentaVacuna $ventaVacuna
     *
     * @return SeguimientoAplicacionVacuna
     */
    public function setVentaVacuna(\DGPlusbelleBundle\Entity\VentaVacuna $ventaVacuna = null)
    {
        $this->ventaVacuna = $ventaVacuna;

        return $this;
    }

    /**
     * Get ventaVacuna
     *
     * @return \DGPlusbelleBundle\Entity\VentaVacuna
     */
    public function getVentaVacuna()
    {
        return $this->ventaVacuna;
    }
    
    /**
     * Set vacuna
     *
     * @param \DGPlusbelleBundle\Entity\Vacuna $vacuna
     *
     * @return SeguimientoAplicacionVacuna
     */
    public function setVacuna(\DGPlusbelleBundle\Entity\Vacuna $vacuna = null)
    {
        $this->vacuna = $vacuna;

        return $this;
    }

    /**
     * Get vacuna
     *
     * @return \DGPlusbelleBundle\Entity\Vacuna
     */
    public function getVacuna()
    {
        return $this->vacuna;
    }
    
}
