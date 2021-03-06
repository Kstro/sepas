<?php

namespace DGPlusbelleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Consulta
 *
 * @ORM\Table(name="consulta", indexes={@ORM\Index(name="fk_consulta_cita1_idx", columns={"cita"}), @ORM\Index(name="fk_consulta_tipo_consulta1_idx", columns={"tipo_consulta"}), @ORM\Index(name="fk_consulta_paciente1_idx", columns={"paciente"}), @ORM\Index(name="fk_consulta_tratamiento1_idx", columns={"tratamiento_id"})})
 * @ORM\Entity
 */
class Consulta
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
     * @ORM\Column(name="fecha_consulta", type="datetime", nullable=false)
     */
    private $fechaConsulta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio", type="time", nullable=false)
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_fin", type="time", nullable=false)
     */
    private $horaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=200, nullable=true)
     */
    private $observacion;

    /**
     * @var string
     *
     * @ORM\Column(name="motivo", type="string", length=200, nullable=true)
     */
    private $motivo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="aparatos", type="string", length=200, nullable=true)
     */
    private $aparatos;
    
    /**
     * @var string
     *
     * @ORM\Column(name="sintomas", type="string", length=200, nullable=true)
     */
    private $sintomas;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="incapacidad", type="boolean", nullable=false)
     */
//    private $incapacidad;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="reporte_plantilla", type="boolean", nullable=false)
     */
    private $reportePlantilla;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="receta_medica", type="boolean", nullable=false)
     */
    private $registraReceta;

   /**
     * @var float
     *
     * @ORM\Column(name="costo_consulta", type="float", nullable=false)
     */
    private $costoConsulta; 
    
    /**
     * @var \Cita
     *
     * @ORM\ManyToOne(targetEntity="Cita")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cita", referencedColumnName="id")
     * })
     */
    private $cita;

    /**
     * @var \Paciente
     *
     * @ORM\ManyToOne(targetEntity="Paciente", inversedBy="consulta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paciente", referencedColumnName="id")
     * })
     */
    private $paciente;

    /**
     * @var \TipoConsulta
     *
     * @ORM\ManyToOne(targetEntity="TipoConsulta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_consulta", referencedColumnName="id")
     * })
     */
    private $tipoConsulta;

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
     * @var \Tratamiento
     *
     * @ORM\ManyToOne(targetEntity="Tratamiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tratamiento_id", referencedColumnName="id")
     * })
     */
    private $tratamiento;

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
     * @ORM\OneToMany(targetEntity="HistorialConsulta", mappedBy="consultareceta", cascade={"persist", "remove"})
     */
    private $ventapaq;

    
    /**
     * @var \Paciente
     *
     * @ORM\ManyToOne(targetEntity="Codigo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codigo_consulta", referencedColumnName="id")
     * })
     */
    private $codigoConsulta;
    
    
    
    /**
     * @var float
     *
     * @ORM\Column(name="peso", type="float", nullable=false)
     */
    //private $peso; 
    
    /**
     * @var float
     *
     * @ORM\Column(name="talla", type="float", nullable=false)
     */
    //private $talla; 
    
    /**
     * @var int
     *
     * @ORM\Column(name="frec_respiratoria", type="integer", nullable=false)
     */
    //private $frecRespiratoria; 
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="presion_arterial_sistolica", type="integer", nullable=false)
     */
    //private $presionArterialSistolica; 
    
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="presion_arterial_diastolica", type="integer", nullable=false)
     */
    //private $presionArterialDiastolica; 
    
    
    
    /**
     * @var float
     *
     * @ORM\Column(name="temperatura", type="float", nullable=false)
     */
    //private $temperatura; 
    
    
    /**
     * @var float
     *
     * @ORM\Column(name="frec_cardiaca", type="float", nullable=false)
     */
    //private $frecCardiaca; 
    
    
    
    
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=200, nullable=true)
     */
    private $codigo;
    
    
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
     * Set fechaConsulta
     *
     * @param \DateTime $fechaConsulta
     *
     * @return Consulta
     */
    public function setFechaConsulta($fechaConsulta)
    {
        $this->fechaConsulta = $fechaConsulta;

        return $this;
    }

    
    
    /**
     * Set sintomas
     *
     * @param string $sintomas
     *
     * @return Consulta
     */
    public function setSintomas($sintomas)
    {
        $this->sintomas= $sintomas;

        return $this;
    }

    /**
     * Get sintomas
     *
     * @return string
     */
    public function getSintomas()
    {
        return $this->sintomas;
    }
    
    /**
     * Set aparatos
     *
     * @param string $aparatos
     *
     * @return Consulta
     */
    public function setAparatos($aparatos)
    {
        $this->aparatos= $aparatos;

        return $this;
    }

    /**
     * Get aparatos
     *
     * @return string
     */
    public function getAparatos()
    {
        return $this->aparatos;
    }
    
    /**
     * Set motivo
     *
     * @param string $motivo
     *
     * @return Consulta
     */
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;

        return $this;
    }

    /**
     * Get motivo
     *
     * @return string
     */
    public function getMotivo()
    {
        return $this->motivo;
    }
    
    
    
    /**
     * Get fechaConsulta
     *
     * @return \DateTime
     */
    public function getFechaConsulta()
    {
        return $this->fechaConsulta;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     *
     * @return Consulta
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return \DateTime
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFin
     *
     * @param \DateTime $horaFin
     *
     * @return Consulta
     */
    public function setHoraFin($horaFin)
    {
        $this->horaFin = $horaFin;

        return $this;
    }

    /**
     * Get horaFin
     *
     * @return \DateTime
     */
    public function getHoraFin()
    {
        return $this->horaFin;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return Consulta
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set costoConsulta
     *
     * @param float $costoConsulta
     *
     * @return Consulta
     */
    public function setCostoConsulta($costoConsulta)
    {
        $this->costoConsulta = $costoConsulta;

        return $this;
    }

    /**
     * Get costoConsulta
     *
     * @return float
     */
    public function getCostoConsulta()
    {
        return $this->costoConsulta;
    }
    
    /**
     * Set incapacidad
     *
     * @param boolean $incapacidad
     *
     * @return Consulta
     */
//    public function setIncapacidad($incapacidad)
//    {
//        $this->incapacidad = $incapacidad;
//
//        return $this;
//    }

    /**
     * Get incapacidad
     *
     * @return boolean
     */
//    public function getIncapacidad()
//    {
//        return $this->incapacidad;
//    }
    
    /**
     * Set reportePlantilla
     *
     * @param boolean $reportePlantilla
     *
     * @return Consulta
     */
    public function setReportePlantilla($reportePlantilla)
    {
        $this->reportePlantilla = $reportePlantilla;

        return $this;
    }

    /**
     * Get reportePlantilla
     *
     * @return boolean
     */
    public function getReportePlantilla()
    {
        return $this->reportePlantilla;
    }

    /**
     * Set cita
     *
     * @param \DGPlusbelleBundle\Entity\Cita $cita
     *
     * @return Consulta
     */
    public function setCita(\DGPlusbelleBundle\Entity\Cita $cita = null)
    {
        $this->cita = $cita;

        return $this;
    }

    /**
     * Get cita
     *
     * @return \DGPlusbelleBundle\Entity\Cita
     */
    public function getCita()
    {
        return $this->cita;
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
     * Set tipoConsulta
     *
     * @param \DGPlusbelleBundle\Entity\TipoConsulta $tipoConsulta
     *
     * @return Consulta
     */
    public function setTipoConsulta(\DGPlusbelleBundle\Entity\TipoConsulta $tipoConsulta = null)
    {
        $this->tipoConsulta = $tipoConsulta;

        return $this;
    }

    /**
     * Get tipoConsulta
     *
     * @return \DGPlusbelleBundle\Entity\TipoConsulta
     */
    public function getTipoConsulta()
    {
        return $this->tipoConsulta;
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

    /**
     * Set tratamiento
     *
     * @param \DGPlusbelleBundle\Entity\Tratamiento $tratamiento
     *
     * @return Consulta
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
    
    
     /**
     * @ORM\OneToMany(targetEntity="ConsultaProducto", mappedBy="consulta", cascade={"persist", "remove"})
     */
    protected $placas;
    
    /**
     * @ORM\OneToMany(targetEntity="ImagenConsulta", mappedBy="consulta", cascade={"persist", "remove"})
     */
    protected $placas2;
    /**
     * @ORM\OneToMany(targetEntity="HistorialConsulta", mappedBy="consulta", cascade={"persist", "remove"})
     */
    protected $historialconsulta;
    
    public function __construct()
    {
        //$this->placas = array(new EstudioRadTamPlaca(), new EstudioRadTamPlaca());
        $this->placas = new ArrayCollection();
        $this->placas2 = new ArrayCollection();
    }           
    public function getPlacas()
    {
        return $this->placas;
    }
    public function setPlacas(\Doctrine\Common\Collections\Collection $placas)
    {
        $this->placas = $placas;
        foreach ($placas as $placa) {
            $placa->setConsulta($this);
        }
    }
    
    public function getPlacas2()
    {
        return $this->placas2;
    }
    public function setPlacas2(\Doctrine\Common\Collections\Collection $placas2)
    {
        $this->placas2 = $placas2;
        foreach ($placas2 as $placa2) {
            $placa2->setConsulta($this);
        }
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
    
    
    
    /**
     * Set registraReceta
     *
     * @param boolean $registraReceta
     *
     * @return Consulta
     */
    public function setRegistraReceta($registraReceta)
    {
        $this->registraReceta = $registraReceta;

        return $this;
    }

    /**
     * Get reportePlantilla
     *
     * @return boolean
     */
    public function getRegistraReceta()
    {
        return $this->registraReceta;
    }
    
    
    
    /**
     * Set ventapaq
     *
     * @param \DGPlusbelleBundle\Entity\VentaPaquete $ventapaq
     *
     * @return PaqueteTratamiento
     */
    public function setVentaPaq(\DGPlusbelleBundle\Entity\HistorialConsulta $ventapaq = null)
    {
        $this->ventapaq = $ventapaq;

        return $this;
    }

    /**
     * Get tratamiento
     *
     * @return \DGPlusbelleBundle\Entity\Tratamiento
     */
    public function getVentaPaq()
    {
        return $this->ventapaq;
    }
    
    
    
    
    
    
    
    
    /**
     * Set codigo
     *
     * @param string $codigoConsulta
     *
     * @return Consulta
     */
    public function setCodigoConsulta($codigoConsulta)
    {
        $this->codigoConsulta= $codigoConsulta;

        return $this;
    }

    /**
     * Get codigoConsulta
     *
     * @return string
     */
    public function getCodigoConsulta()
    {
        return $this->codigoConsulta;
    }
    
    
    
    /**
     * Set costoConsulta
     *
     * @param float $peso
     *
     * @return peso
     */
    public function setPeso($peso)
    {
        $this->peso= $peso;

        return $this;
    }

    /**
     * Get peso
     *
     * @return float
     */
    public function getPeso()
    {
        return $this->peso;
    }
    
    
    
    
    /**
     * Set talla
     *
     * @param float $talla
     *
     * @return talla
     */
    public function setTalla($talla)
    {
        $this->talla= $talla;

        return $this;
    }

    /**
     * Get talla
     *
     * @return float
     */
    public function getTalla()
    {
        return $this->talla;
    }
    
    
    
    
    /**
     * Set costoConsulta
     *
     * @param float $frecRespiratoria
     *
     * 
     */
    public function setFrecRespiratoria($frecRespiratoria)
    {
        $this->frecRespiratoria = $frecRespiratoria;

        return $this;
    }

    /**
     * Get peso
     *
     * @return float
     */
    public function getFrecRespiratoria()
    {
        return $this->frecRespiratoria;
    }
    
    
    
    /**
     * Set presionArterialSistolica
     *
     * @param int $presionArterialSistolica
     *
     * 
     */
    public function setPresionArterialSistolica($presionArterialSistolica)
    {
        $this->presionArterialSistolica = $presionArterialSistolica;

        return $this;
    }

    /**
     * Get presionArterialSistolica
     *
     * @return int
     */
    public function getPresionArterialSistolica()
    {
        return $this->presionArterialSistolica;
    }
    
    
    
    
    /**
     * Set presionArterialDiastolica
     *
     * @param int $presionArterialDiastolica
     *
     * 
     */
    public function setPresionArterialDiastolica($presionArterialDiastolica)
    {
        $this->presionArterialSistolica = $presionArterialDiastolica;

        return $this;
    }

    /**
     * Get presionArterialDiastolica
     *
     * @return int
     */
    public function getPresionArterialDiastolica()
    {
        return $this->presionArterialDiastolica;
    }
    
    
    
    
    /**
     * Set temperatura
     *
     * @param float $temperatura
     *
     * 
     */
    public function setTemperatura($temperatura)
    {
        $this->temperatura= $temperatura;

        return $this;
    }

    /**
     * Get temperatura
     *
     * @return float
     */
    public function getTemperatura()
    {
        return $this->temperatura;
    }
    
    /**
     * Set frecCardiaca
     *
     * @param float $frecCardiaca
     *
     * 
     */
    public function setFrecCardiaca($frecCardiaca)
    {
        $this->frecCardiaca= $frecCardiaca;

        return $this;
    }

    /**
     * Get frecCardiaca
     *
     * @return float
     */
    public function getFrecCardiaca()
    {
        return $this->frecCardiaca;
    }
    
    
    
    
    /**
     * Set codigo
     *
     * @param \DGPlusbelleBundle\Entity\Codigo $codigo
     *
     * @return Codigo
     */
    public function setCodigo(\DGPlusbelleBundle\Entity\Codigo $codigo = null)
    {
        $this->codigo= $codigo;

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

}
