<?php

namespace DGPlusbelleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medicamento
 *
 * @ORM\Table(name="medicamento")
 * @ORM\Entity
 */
class Medicamento
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
     * @var string
     *
     * @ORM\Column(name="estado", type="integer",  nullable=false)
     */
    private $estado;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string",  nullable=false)
     */
    private $nombre;
    
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_venta", type="datetime", nullable=false)
     */
    private $fechaVenta;
      
    
    /**
     * @var \Empleado
     *
     * @ORM\ManyToOne(targetEntity="Empleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vendidopor", referencedColumnName="id")
     * })
     */
    private $empleado;    
    
        
    /**
     * @var \Descuento
     *
     * @ORM\ManyToOne(targetEntity="Descuento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="descuento", referencedColumnName="id")
     * })
     */
    private $descuento;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="cuotas", type="integer",  nullable=false)
     */
    private $cuotas;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string",  nullable=false)
     */
    private $observaciones;
    
    
    /**
     * @var \Paciente
     *
     * @ORM\ManyToOne(targetEntity="Paciente", inversedBy="ventapaquete")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paciente", referencedColumnName="id")
     * })
     */
    private $paciente;
    
    
    
    /**
     * @var float
     *
     * @ORM\Column(name="costo", type="float", nullable=false)
     */
    private $costo; 
        
    
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
     *
     * @return medicamento
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

//    public function getMantenimiento() {
//            return $this->nombre;
//    }
    
    
    
    /**
     * Set cuotas
     *
     * @param string $cuotas
     *
     * @return medicamento
     */
    public function setCuotas($cuotas)
    {
        $this->cuotas= $cuotas;

        return $this;
    }

    /**
     * Get cuotas
     *
     * @return string
     */
    public function getCuotas()
    {
        return $this->cuotas;
    }
    
    
    
    
    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return observaciones
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones= $observaciones;

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
     * Set estado
     *
     * @param string $estado
     *
     * @return estado
     */
    public function setEstado($estado)
    {
        $this->estado= $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    
    /**
     * Set empleado
     *
     * @param \DGPlusbelleBundle\Entity\Empleado $empleado
     *
     * @return VentaVacuna
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
     * Set descuento
     *
     * @param \DGPlusbelleBundle\Entity\Descuento $descuento
     *
     * @return VentaVacuna
     */
    public function setDescuento(\DGPlusbelleBundle\Entity\Descuento $descuento = null)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento
     *
     * @return \DGPlusbelleBundle\Entity\Descuento
     */
    public function getDescuento()
    {
        return $this->descuento;
    }    
    
    
    
    public function setMantenimiento() {
            return $this->getNombre();
    }
    
    
    /**
     * Set fechaVenta
     *
     * @param \DateTime $fechaVenta
     *
     * @return VentaVacuna
     */
    public function setFechaVenta($fechaVenta)
    {
        $this->fechaVenta = $fechaVenta;

        return $this;
    }

    /**
     * Get fechaVenta
     *
     * @return \DateTime
     */
    public function getFechaVenta()
    {
        return $this->fechaVenta;
    }
    
    
    
    /**
     * Set paciente
     *
     * @param \DGPlusbelleBundle\Entity\Persona $paciente
     *
     * @return VentaPaquete
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
     * Set Costo
     *
     * @param float $Costo
     *
     * @return VentaVacuna
     */
    public function setCosto($costo)
    {
        $this->costo= $costo;

        return $this;
    }

    /**
     * Get montoTotal
     *
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }
 
   
}
