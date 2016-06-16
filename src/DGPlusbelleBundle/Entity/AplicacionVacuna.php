<?php

namespace DGPlusbelleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AplicacionVacuna
 *
 * @ORM\Table(name="aplicacion_vacuna", indexes={@ORM\Index(name="empleado", columns={"empleado"}), @ORM\Index(name="paciente", columns={"paciente"}), @ORM\Index(name="venta_vacuna", columns={"venta_vacuna"})})
 * @ORM\Entity
 */
class AplicacionVacuna {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_aplicacion", type="datetime", nullable=false)
     */
    private $fechaAplicacion;

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
     * @var \Paciente
     *
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paciente", referencedColumnName="id")
     * })
     */
    private $paciente;
    
    /**
     * @var \Empleado
     *
     * @ORM\ManyToOne(targetEntity="Empleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="empleado", referencedColumnName="id")
     * })
     */
    private $empleado;
    
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
     * Set fechaAplicacion
     *
     * @param \DateTime $fechaAplicacion
     *
     * @return AplicacionVacuna
     */
    public function setFechaAplicacion($fechaAplicacion)
    {
        $this->fechaAplicacion = $fechaAplicacion;

        return $this;
    }

    /**
     * Get fechaAplicacion
     *
     * @return \DateTime
     */
    public function getFechaAplicacion()
    {
        return $this->fechaAplicacion;
    }

    /**
     * Set ventaVacuna
     *
     * @param \DGPlusbelleBundle\Entity\VentaVacuna $ventaVacuna
     *
     * @return AplicacionVacuna
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
     * Set paciente
     *
     * @param \DGPlusbelleBundle\Entity\Paciente $paciente
     *
     * @return AplicacionVacuna
     */
    public function setPaciente(\DGPlusbelleBundle\Entity\Paciente $paciente = null)
    {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * Get paciente
     *
     * @return \DGPlusbelleBundle\Entity\Paciente
     */
    public function getPaciente()
    {
        return $this->paciente;
    }
    
     /**
     * Set empleado
     *
     * @param \DGPlusbelleBundle\Entity\Empleado $empleado
     *
     * @return AplicacionVacuna
     */
    public function setEmpleado(\DGPlusbelleBundle\Entity\Empleado $empleado = null)
    {
        $this->empleado = $empleado;

        return $this;
    }

    /**
     * Get empleado
     *
     * @return \DGPlusbelleBundle\Entity\Empleado
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }

    /**
     * Set vacuna
     *
     * @param \DGPlusbelleBundle\Entity\Vacuna $vacuna
     *
     * @return AplicacionVacuna
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
