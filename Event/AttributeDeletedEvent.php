<?php

declare(strict_types=1);

/*
 * This file is part of the MsgPHP package.
 *
 * (c) Roland Franssen <franssen.roland@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MsgPhp\Eav\Event;

use MsgPhp\Eav\Entity\Attribute;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class AttributeDeletedEvent
{
    /**
     * @var Attribute
     */
    public $attribute;

    final public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }
}
