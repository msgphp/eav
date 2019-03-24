<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infrastructure\Uuid;

use MsgPhp\Domain\Infrastructure\Uuid\DomainIdTrait;
use MsgPhp\Eav\AttributeIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class AttributeUuid implements AttributeIdInterface
{
    use DomainIdTrait;
}
