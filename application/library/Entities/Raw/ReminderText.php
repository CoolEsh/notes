<?php

namespace Entities\Raw;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReminderText
 *
 * @ORM\Table(name="reminder_text", indexes={@ORM\Index(name="reminder_text_reminder1", columns={"reminder_id"})})
 * @ORM\Entity
 */
class ReminderText
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
     * @var \Reminder
     *
     * @ORM\ManyToOne(targetEntity="Reminder",cascade={"persist"})
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
     * @return ReminderText
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
     * Set reminder
     *
     * @param \Reminder $reminder
     * @return ReminderText
     */
    public function setReminder($reminder = null)
    {
        $this->reminder = $reminder;

        return $this;
    }

    /**
     * Get reminder
     *
     * @return \Reminder 
     */
    public function getReminder()
    {
        return $this->reminder;
    }
}
