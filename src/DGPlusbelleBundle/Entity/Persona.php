<?php

namespace DGPlusbelleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="persona")
 * @ORM\Entity(repositoryClass="DGPlusbelleBundle\Repository\UsuarioRepository")
 */
class Persona
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
     * @ORM\Column(name="nombres", type="string", length=50, nullable=false)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="segundo_nombre", type="string", length=75, nullable=true)
     */
    //private $segundoNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=50, nullable=false)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="segundo_apellido", type="string", length=50, nullable=true)
     */
    //private $segundoApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_casada", type="string", length=50, nullable=true)
     */
    //private $apellidoCasada;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=200, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=12, nullable=false)
     */
    private $telefono;
    
     /**
     * @var string
     *
     * @ORM\Column(name="telefono2", type="string", length=12, nullable=false)
     */
    private $telefono2;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150, nullable=false)
     */
    private $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=true)
     */
    /*private $estado;*/

     /**
     * @ORM\OneToMany(targetEntity="Paciente", mappedBy="persona", cascade={"persist", "remove"})
     */
    private $paciente;

    /**
     * @ORM\OneToMany(targetEntity="Empleado", mappedBy="persona", cascade={"persist", "remove"})
     */
    private $empleado;
    
    /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="persona", cascade={"persist", "remove"})
     */
    private $usuario;
    
    /**
     * @ORM\OneToMany(targetEntity="VentaPaquete", mappedBy="paciente", cascade={"persist", "remove"})
     */
    private $ventapaquete;

    function getPaciente() {
        return $this->paciente;
    }

    function setPaciente($paciente) {
        $this->paciente = $paciente;
    }
    
    function getEmpleado() {
        return $this->empleado;
    }

    function setEmpleado($empleado) {
        $this->empleado = $empleado;
    }
    
    function getUsuario() {
        return $this->usuario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    
 /*   function getVentaPaquete() {
        return $this->ventapaciente;
    }

    function setVentaPaquete($ventapaquete) {
        $this->ventapaciente = $ventapaquete;
    }  */

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
     * Set primerNombre
     *
     * @param string $nombres
     *
     * @return Persona
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get primerNombre
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set segundoNombre
     *
     * @param string $segundoNombre
     *
     * @return Persona
     */
    /*public function setSegundoNombre($segundoNombre)
    {
        $this->segundoNombre = $segundoNombre;

        return $this;
    }
*/
    /**
     * Get segundoNombre
     *
     * @return string
     */
    /*public function getSegundoNombre()
    {
        return $this->segundoNombre;
    }
*/
    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Persona
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set segundoApellido
     *
     * @param string $segundoApellido
     *
     * @return Persona
     */
   /* public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }*/

    /**
     * Get segundoApellido
     *
     * @return string
     */
    /*public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }*/

    /**
     * Set apellidoCasada
     *
     * @param string $apellidoCasada
     *
     * @return Persona
     */
   /* public function setApellidoCasada($apellidoCasada)
    {
        $this->apellidoCasada = $apellidoCasada;

        return $this;
    }*/

    /**
     * Get apellidoCasada
     *
     * @return string
     */
    /*public function getApellidoCasada()
    {
        return $this->apellidoCasada;
    }*/

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Persona
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Persona
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }
    
     /**
     * Set telefono2
     *
     * @param string $telefono2
     *
     * @return Persona
     */
    public function setTelefono2($telefono2)
    {
        $this->telefono2 = $telefono2;

        return $this;
    }

    /**
     * Get telefono2
     *
     * @return string
     */
    public function getTelefono2()
    {
        return $this->telefono2;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Persona
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Persona
     */
    /*public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }*/

    /**
     * Get estado
     *
     * @return boolean
     */
    /*public function getEstado()
    {
        return $this->estado;
    }*/
    
    public function __toString() {
    return $this->nombres.' '.$this->apellidos;
    }
}
