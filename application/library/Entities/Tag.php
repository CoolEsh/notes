<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM,
    Entities\Raw;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity
 */
class Tag extends \Entities\Raw\Tag
{

}
