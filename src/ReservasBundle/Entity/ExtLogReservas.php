<?php

namespace ReservasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Loggable\Entity\MappedSuperclass\AbstractLogEntry;

/**
 * @ORM\Entity(repositoryClass="Gedmo\Loggable\Entity\Repository\LogEntryRepository", readOnly=true)
 * @ORM\Table(
 *      name="EXT_LOG_RESERVAS",
 *      indexes={
 *          @ORM\Index(name="log_class_lookup_idx", columns={"object_class"}),
 *          @ORM\Index(name="log_date_lookup_idx", columns={"logged_at"}),
 *          @ORM\Index(name="log_user_lookup_idx", columns={"username"}),
 *      }
 * )
 */
class ExtLogReservas extends AbstractLogEntry {

}

