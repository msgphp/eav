<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infra\Doctrine;

use MsgPhp\Domain\Infra\Doctrine\{MappingConfig, ObjectFieldMappingsProviderInterface};
use MsgPhp\Eav\Entity\{AttributeValue, Features};

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 *
 * @internal
 */
final class ObjectFieldMappings implements ObjectFieldMappingsProviderInterface
{
    public static function provideObjectFieldMappings(MappingConfig $config): iterable
    {
        yield Features\EntityAttributeValue::class => [
            'attributeValue' => [
                'type' => self::TYPE_ONE_TO_ONE,
                'targetEntity' => AttributeValue::class,
                'cascade' => ['all'],
                'joinColumns' => [
                    ['nullable' => false, 'onDelete' => 'CASCADE'],
                ],
            ],
        ];
    }
}
