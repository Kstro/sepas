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
   
}
