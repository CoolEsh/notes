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
            ->removeDecorator('HtmlTag')
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
            ->removeDecorator('HtmlTag')
            ->removeDecorator( 'Errors' );

        $elements['tags'] = new Zend_Form_Element_Text( 'tags' );
        $elements['tags']->addFilter( 'StripTags' )
            ->setAttribs( array(
                'id' => 'note-tags',
                'class' => 'form-control'
            ) )
            ->removeDecorator( 'Label' )
            ->removeDecorator('HtmlTag')
            ->removeDecorator( 'Errors' );

        $this->addElements( $elements );
    }

    public function setContent( $todos )
    {
        $subform = new Zend_Form_SubForm( 'todos' );

        if ( !empty( $todos ) )
        {
            foreach ( $todos as $todo )
            {
                $todoElem = new My_Form_Element_Todo( 'todo[]' );
                $todoElem->addFilter( 'StripTags' )
                    ->setAttribs( array(
                        'id' => 'note-content',
                        'class' => 'form-control',
                        'key' => $todo->getId()
                    ) )
                    ->removeDecorator( 'Label' )
                    ->removeDecorator('HtmlTag')
                    ->removeDecorator( 'Errors' );
                $todoElem->setCompleted( $todo->getCompleted() );
                $todoElem->setContent( $todo->getContent() );

                $subform->addElement( $todoElem, 'todo' . $todo->getId() );
            }
        }
        else
        {
            $todoElem = new My_Form_Element_Todo( 'todo[]' );
            $todoElem->addFilter( 'StripTags' )
                ->setAttribs( array(
                    'id' => 'note-content',
                    'class' => 'form-control',
                    'key' => 0
                ) )
                ->removeDecorator( 'Label' )
                ->removeDecorator('HtmlTag')
                ->removeDecorator( 'Errors' );

            $subform->addElement( $todoElem, 'todo0' );
        }

        $this->addSubForm( $subform, 'todos' );
    }

}
