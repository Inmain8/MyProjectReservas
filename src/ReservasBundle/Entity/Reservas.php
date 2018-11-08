<?php

namespace ReservasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reservas
 *
 * @ORM\Table(name="reservas")
 * @ORM\Entity(repositoryClass="ReservasBundle\Repository\ReservasRepository")
 */
class Reservas
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="llegada", type="date")
     */
    private $llegada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="salida", type="date")
     */
    private $salida;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=100)
     */
    private $estado = 'RESERVA';

    /**
     * @var string
     *
     * @ORM\Column(name="tipoHabitacion", type="string", length=10)
     */
    private $tipoHabitacion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipoPension", type="string", length=10)
     */
    private $tipoPension;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="voucher", type="string", length=255)
     */
    private $voucher;

    /**
     * @var int
     *
     * @ORM\Column(name="precio", type="integer")
     */
    private $precio;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\IsNull()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255)
     * @Assert\IsNull()
     */
    private $telefono;

    /**
     * @var int
     *
     * @ORM\Column(name="numAdultos", type="integer")
     */
    private $numAdultos;

    /**
     * @var int
     *
     * @ORM\Column(name="numNinos", type="integer")
     */
    private $numNinos = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="numBebes", type="integer")
     */
    private $numBebes = 0;

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Reservas
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set llegada
     *
     * @param \DateTime $llegada
     *
     * @return Reservas
     */
    public function setLlegada($llegada)
    {
        $this->llegada = $llegada;

        return $this;
    }

    /**
     * Get llegada
     *
     * @return \DateTime
     */
    public function getLlegada()
    {
        return $this->llegada;
    }

    /**
     * Set salida
     *
     * @param \DateTime $salida
     *
     * @return Reservas
     */
    public function setSalida($salida)
    {
        $this->salida = $salida;

        return $this;
    }

    /**
     * Get salida
     *
     * @return \DateTime
     */
    public function getSalida()
    {
        return $this->salida;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Reservas
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

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
     * Set tipoHabitacion
     *
     * @param string $tipoHabitacion
     *
     * @return Reservas
     */
    public function setTipoHabitacion($tipoHabitacion)
    {
        $this->tipoHabitacion = $tipoHabitacion;

        return $this;
    }

    /**
     * Get tipoHabitacion
     *
     * @return string
     */
    public function getTipoHabitacion()
    {
        return $this->tipoHabitacion;
    }

    /**
     * Set tipoPension
     *
     * @param string $tipoPension
     *
     * @return Reservas
     */
    public function setTipoPension($tipoPension)
    {
        $this->tipoPension = $tipoPension;

        return $this;
    }

    /**
     * Get tipoPension
     *
     * @return string
     */
    public function getTipoPension()
    {
        return $this->tipoPension;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Reservas
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

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Reservas
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
     * Set voucher
     *
     * @param string $voucher
     *
     * @return Reservas
     */
    public function setVoucher($voucher)
    {
        $this->voucher = $voucher;

        return $this;
    }

    /**
     * Get voucher
     *
     * @return string
     */
    public function getVoucher()
    {
        return $this->voucher;
    }

    /**
     * Set precio
     *
     * @param integer $precio
     *
     * @return Reservas
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return int
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Reservas
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
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Reservas
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
     * Set numAdultos
     *
     * @param integer $numAdultos
     *
     * @return Reservas
     */
    public function setNumAdultos($numAdultos)
    {
        $this->numAdultos = $numAdultos;

        return $this;
    }

    /**
     * Get numAdultos
     *
     * @return int
     */
    public function getNumAdultos()
    {
        return $this->numAdultos;
    }

    /**
     * Set numNinos
     *
     * @param integer $numNinos
     *
     * @return Reservas
     */
    public function setNumNinos($numNinos)
    {
        $this->numNinos = $numNinos;

        return $this;
    }

    /**
     * Get numNinos
     *
     * @return int
     */
    public function getNumNinos()
    {
        return $this->numNinos;
    }

    /**
     * Set numBebes
     *
     * @param integer $numBebes
     *
     * @return Reservas
     */
    public function setNumBebes($numBebes)
    {
        $this->numBebes = $numBebes;

        return $this;
    }

    /**
     * Get numBebes
     *
     * @return int
     */
    public function getNumBebes()
    {
        return $this->numBebes;
    }
}

