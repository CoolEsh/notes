<?php

namespace Models;

use Zend_Controller_Front,
    \Doctrine\ORM\Tools\Pagination\Paginator;

class Reminder extends ModelAbstract
{
    private $_itemsPerPage = 3;

    /**
     * @param int $currentPage
     * @return array
     */
    public function getPageRecords( $currentPage )
    {
        $em = $this->getEntityManager();

        $dql = "SELECT reminder FROM \Entities\Reminder reminder";
        $query = $em->createQuery( $dql );
        $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator( $query );

        $totalItems = count( $paginator );
        $pagesCount = (int) ceil( $totalItems / $this->_itemsPerPage );

        $paginator->getQuery()
            ->setFirstResult( $this->_itemsPerPage * ( $currentPage - 1 ) ) // set the offset
            ->setMaxResults( $this->_itemsPerPage ); // set the limit

        return array(
            'items_per_page' => $this->_itemsPerPage,
            'current_page' => $currentPage,
            'total_pages' => $pagesCount,
            'data' => $paginator
        );
    }

    public function delete( $id )
    {
        $em = $this->getEntityManager();

        $reminder = $this->getReminderRepository()->find( $id );

        $em->remove( $reminder );
        $em->flush();
    }

}