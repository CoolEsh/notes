<?php

namespace Models;

use Zend_Filter_File_Rename;

class ReminderAbstract extends ModelAbstract
{
    protected $_tmpUploadPath = '/application/tmp/upload/';
    protected $_uploadPath = '/upload/';

    protected $_formValues;

    public function getTmpUploadPath()
    {
        return ROOT_PATH . $this->_tmpUploadPath;
    }

    public function getUploadPath()
    {
        return ROOT_PATH . $this->_uploadPath;
    }

    public function getFormValues()
    {
        return $this->_formValues;
    }

    protected function _renameFile( $locationFile )
    {
        $newFileName = sha1( uniqid( rand(), true ) ).'.jpg';
        $fullPathFileName = $this->getUploadPath() . $newFileName;

        $filterRename = new Zend_Filter_File_Rename( array(
            'target' => $fullPathFileName,
            'overwrite' => true
        ) );
        $filterRename->filter( $locationFile );

        return $newFileName;
    }

    public function save( $data )
    {
        if ( empty( $data['id'] ) )
        {
            $this->_create( $data );
        }
        else
        {
            $this->_update( $data );
        }
    }

}