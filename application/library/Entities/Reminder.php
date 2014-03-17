<?php

namespace Entities;

use Zend_Controller_Front,
    Doctrine\ORM\Mapping as ORM,
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
     * Get content
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContent()
    {
        $front = Zend_Controller_Front::getInstance();

        $bootstrap = $front->getParam( 'bootstrap' );
        $container = $bootstrap->getResource( 'container' );

        $em = $container['entityManager'];

        switch ( $this->getType() )
        {
            case 'text':
                $query = $em->createQuery( 'SELECT reminderText FROM \Entities\ReminderText reminderText WHERE reminderText.reminder = ' . $this->getId() );
                $content = $query->getResult();
                break;
            case 'todo':
                $query = $em->createQuery( 'SELECT reminderTodo FROM \Entities\ReminderTodo reminderTodo WHERE reminderTodo.reminder = ' . $this->getId() );
                $content = $query->getResult();
                break;
        }

        return $content;
    }

}
