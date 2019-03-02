<?php

declare(strict_types=1);

namespace MsgPhp\Eav;

use MsgPhp\Domain\DomainIdTrait;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class AttributeId implements AttributeIdInterface
{
    use DomainIdTrait;
}
