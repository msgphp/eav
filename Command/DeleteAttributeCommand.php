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

namespace MsgPhp\Eav\Command;

use MsgPhp\Eav\AttributeIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class DeleteAttributeCommand
{
    /**
     * @var AttributeIdInterface
     */
    public $attributeId;

    final public function __construct(AttributeIdInterface $attributeId)
    {
        $this->attributeId = $attributeId;
    }
}
