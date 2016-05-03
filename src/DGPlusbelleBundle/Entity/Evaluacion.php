<?php

namespace DGPlusbelleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Rol
 *
 * @ORM\Table(name="evaluacion")
 * @ORM\Entity
 */
class Evaluacion
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
     * @ORM\Column(name="estudios_laboratorios", type="string", length=30, nullable=false)
     */
    private $estLaboratorio;
    
    /**
     * @var int
     *
     * @ORM\Column(name="diagnostico", type="string", length=30, nullable=false)
     */
    private $diagnostico;
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="medicamentos", type="integer", length=30, nullable=false)
     */
    private $medicamentos;
    
    
    /**
     * @var \Paciente
     *
     * @ORM\ManyToOne(targetEntity="Consulta", inversedBy="consulta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_consulta", referencedColumnName="id")
     * })
     */
    private $consulta;
   
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
     * Set estLaboratorio
     *
     * @param float $estLaboratorio
     *
     * @return float
     */
    public function setEstLaboratorio($estLaboratorio)
    {
        $this->estLaboratorio= $estLaboratorio;

        return $this;
    }

    /**
     * Get estLaboratorio
     *
     * @return int
     */
    public function getEstLaboratorio()
    {
        return $this->estLaboratorio;
    }
    
    
    /**
     * Set diagnostico
     *
     * @param int $diagnostico
     *
     * @return int
     */
    public function setDiagnostico($diagnostico)
    {
        $this->diagnostico= $diagnostico;

        return $this;
    }

    /**
     * Get diagnostico
     *
     * @return int
     */
    public function getDiagnostico()
    {
        return $this->diagnostico;
    }
    
    
    /**
     * Set medicamentos
     *
     * @param int $medicamentos
     *
     * @return int
     */
    public function setMedicamentos($medicamentos)
    {
        $this->medicamentos= $medicamentos;

        return $this;
    }
    
    
    
    /**
     * Get medicamentos
     *
     * @return int
     */
    public function getMedicamentos()
    {
        return $this->medicamentos;
    }
    
    
    
    /**
     * Set consulta
     *
     * @param \DGPlusbelleBundle\Entity\Paciente $paciente
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

   
}
