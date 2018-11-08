<?php

namespace ReservasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PrecioTipoHab
 *
 * @ORM\Table(name="precio_tipo_hab")
 * @ORM\Entity(repositoryClass="ReservasBundle\Repository\PrecioTipoHabRepository")
 */
class PrecioTipoHab
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
     * @var string
     *
     * @ORM\Column(name="tipoHabitacion", type="string")
     */
    private $tipoHabitacion;

    /**
     * @var int
     *
     * @ORM\Column(name="precioxdia", type="integer")
     */
    private $precioxdia;


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
     * Set tipoHabitacion
     *
     * @param string $tipoHabitacion
     *
     * @return PrecioTipoHab
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
     * Set precioxdia
     *
     * @param integer $precioxdia
     *
     * @return PrecioTipoHab
     */
    public function setPrecioxdia($precioxdia)
    {
        $this->precioxdia = $precioxdia;

        return $this;
    }

    /**
     * Get precioxdia
     *
     * @return int
     */
    public function getPrecioxdia()
    {
        return $this->precioxdia;
    }
}

