<?php

class Application_Form_TodoNote extends Zend_Form
{

    /**
     * Initialization.
     *
     * @return void
     */
    public function init()
    {
        $elements = array();

        $this->getView()->headScript()->appendFile( '/js/tag-it.min.js' );
        $this->getView()->headLink()->appendStylesheet( '/css/jquery.tagit.css' );

        $this->getView()->headScript()->appendFile( '/js/scripts/add-edit-note.js' );

        $elements['id'] = new Zend_Form_Element_Hidden( 'id' );
        $elements['id']->removeDecorator( 'Label' )
            ->removeDecorator( 'Errors' );

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

        $elements['content'] = new My_Form_Element_Todo( 'content[]' );
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

    public function setTodos( $todos )
    {
        foreach ( $todos as $todo )
        {
            $todoElem = new My_Form_Element_Todo( 'content[]' );
            $todoElem->addFilter( 'StripTags' )
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

            $this->addElement( $todoElem );
        }
    }

}
