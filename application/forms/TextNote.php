<?php

class Application_Form_TextNote extends Zend_Form
{

    /**
     * Initialization.
     *
     * @return void
     */
    public function init()
    {
        $elements = array();

        $elements['title'] = new Zend_Form_Element_Text( 'title' );
        $elements['title']->addFilter( 'StripTags' )
            ->setAttribs( array(
                'id' => 'note-title',
                'class' => 'form-control'
            ) )
            ->setRequired( true )
            ->addValidator( 'NotEmpty', true, array(
                'messages'  => array(
                    Zend_Validate_NotEmpty::IS_EMPTY => 'Title is required'
                )
            ) )
            ->removeDecorator( 'Label' )
            ->removeDecorator( 'Errors' );

        $elements['content'] = new Zend_Form_Element_Textarea( 'content' );
        $elements['content']->addFilter( 'StripTags' )
            ->setAttribs( array(
                'id' => 'note-content',
                'class' => 'form-control',
                'rows' => '6'
            ) )
            ->setRequired( true )
            ->addValidator( 'NotEmpty', true, array(
                'messages'  => array(
                    Zend_Validate_NotEmpty::IS_EMPTY => 'Message is required'
                )
            ) )
            ->removeDecorator( 'Label' )
            ->removeDecorator( 'Errors' );

        $elements['tags'] = new Zend_Form_Element_Text( 'tags' );
        $elements['tags']->addFilter( 'StripTags' )
            ->setAttribs( array(
                'id' => 'note-tags',
                'class' => 'form-control'
            ) )
            ->removeDecorator( 'Label' )
            ->removeDecorator( 'Errors' );

        $this->setElements( $elements );
    }
}
