<?php

namespace DGPlusbelleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Rol
 *
 * @ORM\Table(name="vacuna")
 * @ORM\Entity
 */
class Vacuna
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
     * @ORM\Column(name="nombre", type="string", length=30, nullable=false)
     */
    private $nombre;
    
    /**
     * @var int
     *
     * @ORM\Column(name="estado", type="integer", length=30, nullable=false)
     */
    private $estado;  
    /**
     * @var int
     *
     * @ORM\Column(name="costo", type="float", length=30, nullable=false)
     */
    private $costo;  
    /**
     * @var int
     *
     * @ORM\Column(name="codigo_vacuna", type="string", length=30, nullable=false)
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return string
     */
    public function setNombre($nombre)
    {
        $this->nombre= $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return String
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    
    
    /**
     * Set estado
     *
     * @param int $estado
     *
     * @return int
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return int
     */
    public function getEstado()
    {
        return $this->estado;
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
        $this->costo = $costo;

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
     * Set codigo
     *
     * @param float $codigo
     *
     * @return float
     */
    public function setCodigo($codigo)
    {
        $this->codigo= $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return float
     */
    public function getCodigo()
    {
        return $this->codigo;
    }
   
}
