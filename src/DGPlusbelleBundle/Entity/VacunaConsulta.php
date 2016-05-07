<?php

namespace DGPlusbelleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Rol
 *
 * @ORM\Table(name="vacuna_consulta")
 * @ORM\Entity
 */
class VacunaConsulta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="costo", type="float", length=30, nullable=false)
     */
    private $costo;
    
    /**
     * @var int
     *
     * @ORM\Column(name="aplicaciones", type="integer", length=30, nullable=false)
     */
    private $aplicaciones;  
   
    
    
    /**
     * @var \Consulta
     *
     * @ORM\ManyToOne(targetEntity="Consulta", inversedBy="consulta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_consulta", referencedColumnName="id")
     * })
     */
    private $consulta;
    
    
    /**
     * @var \Vacuna
     *
     * @ORM\ManyToOne(targetEntity="Vacuna", inversedBy="consulta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_vacuna", referencedColumnName="id")
     * })
     */
    private $vacuna;
    
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set costo
     *
     * @param float $costo
     *
     * @return float
     */
    public function setCosto($costo)
    {
        $this->costo= $costo;

        return $this;
    }

    /**
     * Get costo
     *
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }
    /**
     * Set aplicaciones
     *
     * @param float $aplicaciones
     *
     * @return float
     */
    public function setAplicaciones($aplicaciones)
    {
        $this->aplicaciones= $aplicaciones;

        return $this;
    }

    /**
     * Get costo
     *
     * @return float
     */
    public function getAplicaciones()
    {
        return $this->aplicaciones;
    }
    
    
    /**
     * Set vacuna
     *
     * @param \DGPlusbelleBundle\Entity\Vacuna $vacuna
     *
     * @return Consulta
     */
    public function setVacuna(\DGPlusbelleBundle\Entity\Vacuna $vacuna= null)
    {
        $this->vacuna= $vacuna;

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
    
    
    
    /**
     * Set consulta
     *
     * @param \DGPlusbelleBundle\Entity\Paciente $consulta
     *
     * @return Consulta
     */
    public function setConsulta(\DGPlusbelleBundle\Entity\Consulta $consulta= null)
    {
        $this->consulta= $consulta;

        return $this;
    }

    /**
     * Get consulta
     *
     * @return \DGPlusbelleBundle\Entity\Consulta
     */
    public function getConsulta()
    {
        return $this->consulta;
    }
    
    /**
     * Set ventaVacuna
     *
     * @param \DGPlusbelleBundle\Entity\VentaVacuna $ventaVacuna
     *
     * @return VacunaConsulta
     */
    public function setVentaVacuna(\DGPlusbelleBundle\Entity\VentaVacuna $ventaVacuna= null)
    {
        $this->ventaVacuna= $ventaVacuna;

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
   
}
