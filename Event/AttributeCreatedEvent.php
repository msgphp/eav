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
class AttributeCreatedEvent
{
    /**
     * @var Attribute
     */
    public $attribute;

    /**
     * @var array
     */
    public $context;

    final public function __construct(Attribute $attribute, array $context)
    {
        $this->attribute = $attribute;
        $this->context = $context;
    }
}
