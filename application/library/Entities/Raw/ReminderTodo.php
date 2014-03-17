<?php

namespace Entities\Raw;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReminderTodo
 *
 * @ORM\MappedSuperclass
 */
class ReminderTodo
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
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var boolean
     *
     * @ORM\Column(name="completed", type="boolean", nullable=false)
     */
    private $completed = '0';

    /**
     * @var \Reminder
     *
     * @ORM\ManyToOne(targetEntity="Reminder")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reminder_id", referencedColumnName="id")
     * })
     */
    private $reminder;



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
     * Set content
     *
     * @param string $content
     * @return ReminderTodo
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set completed
     *
     * @param boolean $completed
     * @return ReminderTodo
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get completed
     *
     * @return boolean 
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set reminder
     *
     * @param \Entities\Reminder $reminder
     * @return ReminderTodo
     */
    public function setReminder(\Entities\Reminder $reminder = null)
    {
        $this->reminder = $reminder;

        return $this;
    }

    /**
     * Get reminder
     *
     * @return \Entities\Reminder
     */
    public function getReminder()
    {
        return $this->reminder;
    }
}
