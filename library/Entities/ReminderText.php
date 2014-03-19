<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM,
    Entities\Raw;

/**
 * ReminderText
 *
 * @ORM\Table(name="reminder_text", indexes={@ORM\Index(name="reminder_text_reminder1", columns={"reminder_id"})})
 * @ORM\Entity
 */
class ReminderText extends \Entities\Raw\ReminderText
{

}
