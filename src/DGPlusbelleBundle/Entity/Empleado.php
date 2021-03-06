<?php

namespace DGPlusbelleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Empleado
 *
 * @ORM\Table(name="empleado", indexes={@ORM\Index(name="fk_empleado_persona1_idx", columns={"persona"}), @ORM\Index(name="fk_empleado_sucursal1_idx", columns={"sucursal"})})
 * @ORM\Entity(repositoryClass="DGPlusbelleBundle\Repository\CatalogoEmpleadoRepository")
 */
class Empleado
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
     * @ORM\Column(name="cargo", type="string", length=75, nullable=false)
     */
    private $cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;
    
     /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;
    
     /**
     * @var float
     *
     * @ORM\Column(name="porcentaje", type="float", nullable=false)
     */
    private $porcentaje;
    
     /**
     * @var float
     *
     * @ORM\Column(name="meta", type="float", nullable=false)
     */
    private $meta;
    
    /**
     * @var float
     *
     * @ORM\Column(name="bono", type="float", nullable=false)
     */
    private $bono;
    
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="comision_completa", type="boolean", nullable=false)
     */
    private $comisionCompleta;
    

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="empleado", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="persona", referencedColumnName="id")
     * })
     */
    private $persona;

   

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Horario", inversedBy="empleado")
     * @ORM\JoinTable(name="horario_medico",
     *   joinColumns={
     *     @ORM\JoinColumn(name="empleado", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="horario", referencedColumnName="id")
     *   }
     * )
     */
    private $horario;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tratamiento", inversedBy="empleado")
     * @ORM\JoinTable(name="medico_tratamiento",
     *   joinColumns={
     *     @ORM\JoinColumn(name="empleado", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="tratamiento", referencedColumnName="id")
     *   }
     * )
     */
    private $tratamiento;
    
    /**
     * @ORM\OneToMany(targetEntity="Comision", mappedBy="empleado", cascade={"persist", "remove"})
     */
    private $comision;
    
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    
    
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=40, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;
    
    
    
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
     * Constructor
     */
    public function __construct()
    {
        $this->horario = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tratamiento = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set cargo
     *
     * @param string $cargo
     *
     * @return Empleado
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
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
    
    
    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return empleado
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
     * Set porcentaje
     *
     * @param float $porcentaje
     *
     * @return empleado
     */
    public function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;

        return $this;
    }

    /**
     * Get porcentaje
     *
     * @return float
     */
    public function getPorcentaje()
    {
        return $this->porcentaje;
    }
    
    
    
    /**
     * Set meta
     *
     * @param float $meta
     *
     * @return empleado
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Get meta
     *
     * @return float
     */
    public function getMeta()
    {
        return $this->meta;
    }
    
    
    
    /**
     * Set bono
     *
     * @param float $bono
     *
     * @return empleado
     */
    public function setBono($bono)
    {
        $this->bono = $bono;

        return $this;
    }

    /**
     * Get bono
     *
     * @return float
     */
    public function getBono()
    {
        return $this->bono;
    }
    
    /**
     * Set persona
     *
     * @param \DGPlusbelleBundle\Entity\Persona $persona
     *
     * @return Empleado
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
     * Add horario
     *
     * @param \DGPlusbelleBundle\Entity\Horario $horario
     *
     * @return Empleado
     */
    public function addHorario(\DGPlusbelleBundle\Entity\Horario $horario)
    {
        $this->horario[] = $horario;

        return $this;
    }

    /**
     * Remove horario
     *
     * @param \DGPlusbelleBundle\Entity\Horario $horario
     */
    public function removeHorario(\DGPlusbelleBundle\Entity\Horario $horario)
    {
        $this->horario->removeElement($horario);
    }

    /**
     * Get horario
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Add tratamiento
     *
     * @param \DGPlusbelleBundle\Entity\Tratamiento $tratamiento
     *
     * @return Empleado
     */
    public function addTratamiento(\DGPlusbelleBundle\Entity\Tratamiento $tratamiento)
    {
        $this->tratamiento[] = $tratamiento;

        return $this;
    }

    /**
     * Remove tratamiento
     *
     * @param \DGPlusbelleBundle\Entity\Tratamiento $tratamiento
     */
    public function removeTratamiento(\DGPlusbelleBundle\Entity\Tratamiento $tratamiento)
    {
        $this->tratamiento->removeElement($tratamiento);
    }

    /**
     * Get tratamiento
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTratamiento()
    {
        return $this->tratamiento;
    }
    
    /**
     * Set comisionCompleta
     *
     * @param string $comisionCompleta
     *
     * @return Empleado
     */
    public function setComisionCompleta($comisionCompleta)
    {
        $this->comisionCompleta = $comisionCompleta;
    }

    /**
     * Get comisionCompleta
     *
     * @return string
     */
    public function getComisionCompleta()
    {
        return $this->comisionCompleta;
    }
    
    public function __toString() {
    //return $this->cargo ? $this->cargo : '';
    return $this->persona->getNombres().' '.$this->persona->getApellidos();
    }
    
    /**
     * Set username
     *
     * @param string $username
     *
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
}
