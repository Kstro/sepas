<?php

namespace DGPlusbelleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Paciente
 *
 * @ORM\Table(name="paciente", uniqueConstraints={@ORM\UniqueConstraint(name="dui_paciente_UNIQUE", columns={"dui"})}, indexes={@ORM\Index(name="fk_paciente_persona1_idx", columns={"persona"})})
 * @ORM\Entity
 */
class Paciente
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
     * @ORM\Column(name="dui", type="string", length=10, nullable=false)
     */
    private $dui;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_civil", type="string", length=30, nullable=false)
     */
    private $estadoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=1, nullable=false)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion", type="string", length=75, nullable=false)
     */
    private $ocupacion;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_trabajo", type="string", length=200, nullable=true)
     */
    private $lugarTrabajo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="referido_por", type="string", length=100, nullable=false)
     */
    private $referidoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="persona_emergencia", type="string", length=100, nullable=true)
     */
    private $personaEmergencia;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_emergencia", type="string", length=12, nullable=false)
     */
    private $telefonoEmergencia;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="paciente", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="persona", referencedColumnName="id")
     * })
     */
    private $persona;

        
   /**
     * @ORM\OneToMany(targetEntity="Consulta", mappedBy="paciente", cascade={"persist", "remove"})
     */
    private $consulta;
    
    /**
     * @ORM\OneToMany(targetEntity="Expediente", mappedBy="paciente", cascade={"persist", "remove"})
     */
    private $expediente;
    
    
    
    /**
     * @ORM\OneToMany(targetEntity="Incapacidad", mappedBy="paciente", cascade={"persist", "remove"})
     */
    private $incapacidad;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="enterado_por", type="string", length=25, nullable=false)
     */
//    private $enteradoPor;


    /**
     * @var string
     *
     * @ORM\Column(name="fecha_registro", type="datetime", length=200, nullable=true)
     */
    private $fechaRegistro;
    
    
    
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="tipo_sangre", type="string", length=3, nullable=false)
     */
    private $tipoSangre;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="tabaquismo", type="string", length=10, nullable=false)
     */
    private $tabaquismo;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="alcoholismo", type="string", length=10, nullable=false)
     */
    private $alcoholismo;
    
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="hereditarios", type="string", length=500, nullable=false)
     */
    private $hereditarios;
    
    /**
     * @var string
     *
     * @ORM\Column(name="patologicos", type="string", length=3, nullable=false)
     */
    private $patologicos;
    
    /**
     * @var string
     *
     * @ORM\Column(name="no_patologicos", type="string", length=3, nullable=false)
     */
    private $noPatologicos;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="medicamentos_alergias", type="string", length=3, nullable=false)
     */
    private $medicamentosAlergias;
    
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;
    
    
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
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * Set dui
     *
     * @param string $dui
     *
     * @return Paciente
     */
    public function setDui($dui)
    {
        $this->dui = $dui;

        return $this;
    }

    /**
     * Get dui
     *
     * @return string
     */
    public function getDui()
    {
        return $this->dui;
    }

    /**
     * Set estadoCivil
     *
     * @param string $estadoCivil
     *
     * @return Paciente
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    /**
     * Get estadoCivil
     *
     * @return string
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     *
     * @return Paciente
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set ocupacion
     *
     * @param string $ocupacion
     *
     * @return Paciente
     */
    public function setOcupacion($ocupacion)
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }

    /**
     * Get ocupacion
     *
     * @return string
     */
    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    /**
     * Set lugarTrabajo
     *
     * @param string $lugarTrabajo
     *
     * @return Paciente
     */
    public function setLugarTrabajo($lugarTrabajo)
    {
        $this->lugarTrabajo = $lugarTrabajo;

        return $this;
    }

    /**
     * Get lugarTrabajo
     *
     * @return string
     */
    public function getLugarTrabajo()
    {
        return $this->lugarTrabajo;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Paciente
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set referidoPor
     *
     * @param string $referidoPor
     *
     * @return Paciente
     */
    public function setReferidoPor($referidoPor)
    {
        $this->referidoPor = $referidoPor;

        return $this;
    }

    /**
     * Get referidoPor
     *
     * @return string
     */
    public function getReferidoPor()
    {
        return $this->referidoPor;
    }

    /**
     * Set personaEmergencia
     *
     * @param string $personaEmergencia
     *
     * @return Paciente
     */
    public function setPersonaEmergencia($personaEmergencia)
    {
        $this->personaEmergencia = $personaEmergencia;

        return $this;
    }

    /**
     * Get personaEmergencia
     *
     * @return string
     */
    public function getPersonaEmergencia()
    {
        return $this->personaEmergencia;
    }

    /**
     * Set telefonoEmergencia
     *
     * @param string $telefonoEmergencia
     *
     * @return Paciente
     */
    public function setTelefonoEmergencia($telefonoEmergencia)
    {
        $this->telefonoEmergencia = $telefonoEmergencia;

        return $this;
    }

    /**
     * Get telefonoEmergencia
     *
     * @return string
     */
    public function getTelefonoEmergencia()
    {
        return $this->telefonoEmergencia;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Paciente
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set persona
     *
     * @param \DGPlusbelleBundle\Entity\Persona $persona
     *
     * @return Paciente
     */
    public function setPersona(\DGPlusbelleBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \DGPlusbelleBundle\Entity\Persona
     */
    public function getPersona()
    {
        return $this->persona;
    }
    
    /**
     * Set consulta
     *
     * @param \DGPlusbelleBundle\Entity\Consulta $consulta
     *
     * @return Consulta
     */
    public function setConsulta(\DGPlusbelleBundle\Entity\Consulta $consulta = null)
    {
        $this->consulta = $consulta;

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
     * Set consulta
     *
     * @param \DGPlusbelleBundle\Entity\Incapacidad $incapacidad
     *
     * @return Incapacidad
     */
    public function setIncapacidad(\DGPlusbelleBundle\Entity\Incapacidad $incapacidad = null)
    {
        $this->$incapacidad = $incapacidad;

        return $this;
    }

    /**
     * Get consulta
     *
     * @return \DGPlusbelleBundle\Entity\Consulta
     */
    public function getIncapacidad()
    {
        return $this->incapacidad;
    }
    
    
    
    
    
    
    /**
     * Get persona
     *
     * @return \DGPlusbelleBundle\Entity\Persona
     */
    public function __toString() {
        return $this->persona->getNombres().' '.$this->persona->getApellidos();
    }
    
    /**
     * Get expediente
     *
     * @return \DGPlusbelleBundle\Entity\Expediente
     */
    public function getExpediente()
    {
        return $this->expediente;
    }
    
    
    /**
     * Set consulta
     *
     * @param \DGPlusbelleBundle\Entity\Expediente $expediente
     *
     * @return Consulta
     */
    public function setExpediente(\DGPlusbelleBundle\Entity\Expediente $expediente = null)
    {
        $this->expediente = $expediente;

        return $this;
    }
    
    
    /**
     * Set referidoPor
     *
     * @param string $enteradoPor
     *
     * @return Paciente
     */
//    public function setEnteradoPor($enteradoPor)
//    {
//        $this->enteradoPor = $enteradoPor;
//
//        return $this;
//    }

    /**
     * Get enteradoPor
     *
     * @return string
     */
//    public function getEnteradoPor()
//    {
//        return $this->enteradoPor;
//    }
    
    
    /**
     * Set referidoPor
     *
     * @param string $fechaRegistro
     *
     * @return Paciente
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get enteradoPor
     *
     * @return string
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }
    
    
    
    
    
    /**
     * Set tipoSangre
     *
     * @param string $tipoSangre
     *
     * @return Paciente
     */
    public function setTipoSangre($tipoSangre)
    {
        $this->tipoSangre= $tipoSangre;

        return $this;
    }

    /**
     * Get tipoSangre
     *
     * @return string
     */
    public function getTipoSangre()
    {
        return $this->tipoSangre;
    }
    
    
    
    /**
     * Set tabaquismo
     *
     * @param string $tabaquismo
     *
     * @return Paciente
     */
    public function setTabaquismo($tabaquismo)
    {
        $this->tabaquismo = $tabaquismo;

        return $this;
    }

    /**
     * Get dui
     *
     * @return string
     */
    public function getTabaquismo()
    {
        return $this->tabaquismo;
    }
    
    
    
    
    
    
    /**
     * Set alcoholismo
     *
     * @param string $alcoholismo
     *
     * @return Paciente
     */
    public function setAlcoholismo($alcoholismo)
    {
        $this->alcoholismo = $alcoholismo;

        return $this;
    }

    /**
     * Get alcoholismo
     *
     * @return string
     */
    public function getAlcoholismo()
    {
        return $this->alcoholismo;
    }
    
    
    
    
    
    
    /**
     * Set hereditarios
     *
     * @param string $hereditarios
     *
     * @return Paciente
     */
    public function setHereditarios($hereditarios)
    {
        $this->hereditarios= $hereditarios;

        return $this;
    }

    /**
     * Get hereditarios
     *
     * @return string
     */
    public function getHereditarios()
    {
        return $this->hereditarios;
    }
    
    
    
    
    /**
     * Set patologicos
     *
     * @param string $patologicos
     *
     * @return Paciente
     */
    public function setPatologicos($patologicos)
    {
        $this->patologicos= $patologicos;

        return $this;
    }

    /**
     * Get patologicos
     *
     * @return string
     */
    public function getPatologicos()
    {
        return $this->patologicos;
    }
    
    
    
    
    
    
    /**
     * Set nopatologicos
     *
     * @param string $noPatologicos
     *
     * @return Paciente
     */
    public function setNoPatologicos($noPatologicos)
    {
        $this->noPatologicos= $noPatologicos;

        return $this;
    }

    /**
     * Get nopatologicos
     *
     * @return string
     */
    public function getNoPatologicos()
    {
        return $this->noPatologicos;
    }
    
    
    
    
    
    /**
     * Set medicamentosAlergias
     *
     * @param string $medicamentosAlergias
     *
     * @return Paciente
     */
    public function setMedicamentosAlergias($medicamentosAlergias)
    {
        $this->medicamentosAlergias= $medicamentosAlergias;

        return $this;
    }

    /**
     * Get hereditarios
     *
     * @return string
     */
    public function getMedicamentosAlergias()
    {
        return $this->medicamentosAlergias;
    }
    
    
    
    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return Empleado
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }
    
    
}
