<?php

namespace DGPlusbelleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abono
 *
 * @ORM\Table(name="abono", indexes={@ORM\Index(name="fk_abono_paciente2_idx", columns={"paciente"}), @ORM\Index(name="fk_abono_empleado2_idx", columns={"empleado"}), @ORM\Index(name="fk_abono_ventapaquete2_idx", columns={"venta_paquete"}), @ORM\Index(name="fk_abono_persona_tratamiento2_idx", columns={"persona_tratamiento"})})
 * @ORM\Entity
 */
class Abono
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
     * @ORM\Column(name="monto", type="float", precision=10, scale=0, nullable=false)
     */
    private $monto;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=200, nullable=false)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_abono", type="datetime", nullable=false)
     */
    private $fechaAbono;

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
     * @var \Paciente
     *
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paciente", referencedColumnName="id")
     * })
     */
    private $paciente;
    
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
     * @var \ventaPaquete
     *
     * @ORM\ManyToOne(targetEntity="VentaPaquete")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="venta_paquete", referencedColumnName="id")
     * })
     */
    private $ventaPaquete;
    
     /**
     * @var \PersonaTratamiento
     *
     * @ORM\ManyToOne(targetEntity="PersonaTratamiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="persona_tratamiento", referencedColumnName="id")
     * })
     */
    private $personaTratamiento;
    
    private $flagAbono;

    
    /**
     * @var \Sucursal
     *
     * @ORM\ManyToOne(targetEntity="Sucursal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sucursal", referencedColumnName="id")
     * })
     */
    private $sucursal;


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
     * Set monto
     *
     * @param float $monto
     *
     * @return Abono
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get monto
     *
     * @return float
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Abono
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
     * Set fechaAbono
     *
     * @param \DateTime $fechaAbono
     *
     * @return Abono
     */
    public function setFechaAbono($fechaAbono)
    {
        $this->fechaAbono = $fechaAbono;

        return $this;
    }

    /**
     * Get fechaAbono
     *
     * @return \DateTime
     */
    public function getFechaAbono()
    {
        return $this->fechaAbono;
    }

    /**
     * Set empleado
     *
     * @param \DGPlusbelleBundle\Entity\Empleado $empleado
     *
     * @return Devolucion
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
     * Set paciente
     *
     * @param \DGPlusbelleBundle\Entity\Paciente $paciente
     *
     * @return Devolucion
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
     * Set ventaPaquete
     *
     * @param \DGPlusbelleBundle\Entity\VentaPaquete $ventaPaquete
     *
     * @return Abono
     */
    public function setVentaPaquete(\DGPlusbelleBundle\Entity\VentaPaquete $ventaPaquete = null)
    {
        $this->ventaPaquete = $ventaPaquete;

        return $this;
    }

    /**
     * Get ventaPaquete
     *
     * @return \DGPlusbelleBundle\Entity\VentaPaquete
     */
    public function getVentaPaquete()
    {
        return $this->ventaPaquete;
    }
    
     /**
     * Set ventaVacuna
     *
     * @param \DGPlusbelleBundle\Entity\VentaVacuna $ventaVacuna
     *
     * @return Abono
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
     * Set personaTratamiento
     *
     * @param \DGPlusbelleBundle\Entity\PersonaTratamiento $personaTratamiento
     *
     * @return Abono
     */
    public function setPersonaTratamiento(\DGPlusbelleBundle\Entity\PersonaTratamiento $personaTratamiento = null)
    {
        $this->personaTratamiento = $personaTratamiento;

        return $this;
    }

    /**
     * Get personaTratamiento
     *
     * @return \DGPlusbelleBundle\Entity\PersonaTratamiento
     */
    public function getPersonaTratamiento()
    {
        return $this->personaTratamiento;
    }
    
     public function setFlagAbono($flagAbono)
    {
        $this->flagAbono = $flagAbono;

        return $this;
    }

    
    public function getFlagAbono()
    {
        return $this->flagAbono;
    }
    
    /**
     * Set sucursal
     *
     * @param \DGPlusbelleBundle\Entity\Sucursal $sucursal
     *
     * @return abono
     */
    public function setSucursal(\DGPlusbelleBundle\Entity\Sucursal $sucursal = null)
    {
        $this->sucursal = $sucursal;

        return $this;
    }

    /**
     * Get sucursal
     *
     * @return \DGPlusbelleBundle\Entity\Sucursal
     */
    public function getSucursal()
    {
        return $this->sucursal;
    }
}
