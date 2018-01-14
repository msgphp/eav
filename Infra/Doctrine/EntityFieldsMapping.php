<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infra\Doctrine;

use MsgPhp\Domain\Infra\Doctrine\Mapping\ObjectFieldMappingProviderInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 *
 * @internal
 */
final class EntityFieldsMapping implements ObjectFieldMappingProviderInterface
{
    public static function getObjectFieldMapping(): array
    {
        return [];
    }
}
