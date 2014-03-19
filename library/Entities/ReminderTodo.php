<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM,
    Entities\Raw;

/**
 * ReminderTodo
 *
 * @ORM\Table(name="reminder_todo", indexes={@ORM\Index(name="reminder_todo_reminder1", columns={"reminder_id"})})
 * @ORM\Entity
 */
class ReminderTodo extends \Entities\Raw\ReminderTodo
{

}
