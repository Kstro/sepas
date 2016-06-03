<?php

namespace DGPlusbelleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Incapacidad
 *
 * @ORM\Table(name="incapacidad")
 * @ORM\Entity
 */
class Incapacidad 
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicial", type="date", nullable=false)
     */
    private $fechaInicial;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="date", nullable=false)
     */
    private $fechaFinal;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=false)
     */
    private $fechaRegistro;
    
    /**
     * @var string
     *
     * @ORM\Column(name="notas", type="string", length=255, nullable=true)
     */
    private $notas;
    
    
    
    /**
     * @var \Paciente
     *
     * @ORM\ManyToOne(targetEntity="Paciente", inversedBy="incapacidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_paciente", referencedColumnName="id")
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
     * @return Rol
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

    
    
    public function __toString() {
        return "";
    }
    
    
    
    /**
     * Set fechaInicial
     *
     * @param \DateTime $fechaInicial
     *
     * @return Cita
     */
    public function setFechaInicial($fechaInicial)
    {
        $this->fechaInicial= $fechaInicial;

        return $this;
    }

    /**
     * Get fechaInicial
     *
     * @return \DateTime
     */
    public function getFechaInicial()
    {
        return $this->fechaInicial;
    }
    
    
    
    
    /**
     * Set fechaFinal
     *
     * @param \DateTime $fechaFinal
     *
     * @return Cita
     */
    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }

    /**
     * Get fechaFinal
     *
     * @return \DateTime
     */
    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }
    
    
    
    
    /**
     * Set fechaFinal
     *
     * @param \DateTime $fechaFinal
     *
     * @return Cita
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro= $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaFinal
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }
    
    
    
    
    /**
     * Set nombre
     *
     * @param string $notas
     *
     * @return Notas
     */
    public function setNotas($notas)
    {
        $this->notas = $notas;

        return $this;
    }

    /**
     * Get notas
     *
     * @return string
     */
    public function getNotas()
    {
        return $this->notas;
    }
     
   
    
    
    /**
     * Set paciente
     *
     * @param \DGPlusbelleBundle\Entity\Paciente $paciente
     *
     * @return Consulta
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
     * @return Consulta
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
    
}
