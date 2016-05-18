<?php

namespace DGPlusbelleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Codigo
 *
 * @ORM\Table(name="codigo")
 * @ORM\Entity
 */
class Codigo
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
     * @ORM\Column(name="codigo", type="string", length=100, nullable=false)
     */
    private $codigo;
    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=100, nullable=false)
     */
    private $estado;
    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="string", length=100, nullable=false)
     */
    private $precio;
    

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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo= $codigo;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
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
     * Set precio
     *
     * @param string $precio
     *
     * @return precio
     */
    public function setPrecio($precio)
    {
        $this->precio= $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }
        
    public function __toString() {
        return $this->codigo? $this->codigo: '';
    }
}
