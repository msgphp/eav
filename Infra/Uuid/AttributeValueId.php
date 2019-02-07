<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infra\Uuid;

use MsgPhp\Domain\Infra\Uuid\DomainId;
use MsgPhp\Eav\AttributeValueIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class AttributeValueId extends DomainId implements AttributeValueIdInterface
{
}
