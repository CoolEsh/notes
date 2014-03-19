<?php

class My_View_Helper_FormTodo extends Zend_View_Helper_FormElement
{
    public function formTodo( $name, $value = null, $attribs = null )
    {
        $info = $this->_getInfo( $name, $value, $attribs );
        extract( $info );

        $xhtml = '<div class="todo-item checkbox-inline" style="margin-left:0;">
    <div class="pull-left">
        <input type="hidden" name="todo_completed[' . $attribs['key'] . ']" value="0" data-key="' . $attribs['key'] . '" />
        <input type="checkbox" name="todo_completed[' . $attribs['key'] . ']" class="' . $attribs['class'] . ' pull-left" style="margin-top:8px; display:inline; vertical-align:bottom; margin-bottom:2px; width:16px; height:16px;" ' . ( $value['completed'] ? 'checked="checked"' : '' ) . ' value="1" data-key="' . $attribs['key'] . '" />
        <input type="text" name="todo_content[' . $attribs['key'] . ']" class="' . $attribs['class'] . ' pull-left" value="' . $value['content'] . '" size="50" style="margin-left:10px;" data-key="' . $attribs['key'] . '" />
    </div>
    <div class="pull-left" style="margin-left:20px;">
        <a href="javascript:;" class="pull-left remove-todo-item" style="margin-top:8px;"><i class="glyphicon glyphicon-trash"></i></a>
    </div>
    <div class="clearfix"></div>
</div>';

        return $xhtml;
    }

}