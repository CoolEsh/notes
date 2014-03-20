<?php

namespace Models;

class Tag extends ModelAbstract
{
    private $_tag = null;

    /**
     * @param string $tagName
     * @return bool
     */
    public function isTagExist( $tagName )
    {
        $result = false;

        $tag = $this->getTagRepository()->findOneBy( array( 'name' => $tagName ) );
        if ( $tag )
        {
            $this->_tag = $tag;
            $result = true;
        }

        return $result;
    }

    /**
     * @return \Entities\Tag
     */
    public function getExistingTag()
    {
        return $this->_tag;
    }

}