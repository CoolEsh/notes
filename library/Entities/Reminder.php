<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM,
    Entities\Raw;

/**
 * Reminder
 *
 * @ORM\Table(name="reminder", indexes={@ORM\Index(name="reminder_reminder_type1", columns={"type_id"})})
 * @ORM\Entity
 */
class Reminder extends \Entities\Raw\Reminder
{
    /**
     * @ORM\OneToOne(targetEntity="\Entities\ReminderText", mappedBy="reminder")
     */
    protected $textContent;

    /**
     * @ORM\OneToMany(targetEntity="\Entities\ReminderTodo", mappedBy="reminder")
     **/
    protected $todoContent;

    /**
     * Get text content
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTextContent()
    {
        return $this->textContent;
    }

    /**
     * Get to-do content
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTodoContent()
    {
        return $this->todoContent;
    }

}
