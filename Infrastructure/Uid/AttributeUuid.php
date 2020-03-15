<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infrastructure\Uid;

use MsgPhp\Domain\Infrastructure\Uid\DomainIdTrait;
use MsgPhp\Eav\AttributeId;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class AttributeUuid implements AttributeId
{
    use DomainIdTrait;
}
