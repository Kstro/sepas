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

    public function getMantenimiento() {
            return $this->nombre;
    }
    
    
    
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
 
   
}
