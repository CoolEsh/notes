<?php

class My_Form_Element_Todo extends Zend_Form_Element_Xhtml
{
    public $helper = 'My_View_Helper_Todo';

    protected $_completed;
    protected $_content;

    public function init()
    {
        return parent::init();
    }

    public function setCompleted( $value )
    {
        $this->_completed = $value;
        return $this;
    }

    public function getCompleted()
    {
        return $this->_completed;
    }

    public function setContent( $value )
    {
        $this->_content = $value;
        return $this;
    }

    public function getContent()
    {
        return $this->_content;
    }

}