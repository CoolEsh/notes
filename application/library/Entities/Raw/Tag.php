<?php

namespace Entities\Raw;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\MappedSuperclass
 */
class Tag
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
     * @ORM\Column(name="name", type="string", length=32, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Reminder", mappedBy="tag")
     */
    protected $reminder;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reminder = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set name
     *
     * @param string $name
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add reminder
     *
     * @param \Entities\Reminder $reminder
     * @return Tag
     */
    public function addReminder(\Entities\Reminder $reminder)
    {
        $this->reminder[] = $reminder;

        return $this;
    }

    /**
     * Remove reminder
     *
     * @param \Entities\Reminder $reminder
     */
    public function removeReminder(\Entities\Reminder $reminder)
    {
        $this->reminder->removeElement($reminder);
    }

    /**
     * Get reminder
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReminder()
    {
        return $this->reminder;
    }
}
