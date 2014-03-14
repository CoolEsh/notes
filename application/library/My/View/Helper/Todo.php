<?php

class My_View_Helper_Todo extends Zend_View_Helper_FormText
{
    public function formTodo( $name, $value = null, $attribs = null )
    {
        $info = $this->_getInfo( $name, $value, $attribs );
        extract( $info );

        $xhtml = '
            <input type="checkbox" class="' . $attribs['class'] . '" />
            <input type="text" class="' . $attribs['class'] . '" value="' . $value . '" />
        ';

        return $xhtml;
    }

}