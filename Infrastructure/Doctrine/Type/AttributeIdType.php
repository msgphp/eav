<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infrastructure\Doctrine\Type;

use MsgPhp\Domain\Infrastructure\Doctrine\DomainIdType;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class AttributeIdType extends DomainIdType
{
    public const NAME = 'msgphp_attribute_id';
}
