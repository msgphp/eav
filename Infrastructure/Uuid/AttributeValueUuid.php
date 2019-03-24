<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infrastructure\Uuid;

use MsgPhp\Domain\Infrastructure\Uuid\DomainIdTrait;
use MsgPhp\Eav\AttributeValueIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class AttributeValueUuid implements AttributeValueIdInterface
{
    use DomainIdTrait;
}
