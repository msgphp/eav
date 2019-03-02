<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infra\Uuid;

use MsgPhp\Domain\Infra\Uuid\DomainIdTrait;
use MsgPhp\Eav\AttributeValueIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class AttributeValueUuid implements AttributeValueIdInterface
{
    use DomainIdTrait;
}
