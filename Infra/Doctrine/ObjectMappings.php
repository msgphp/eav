<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infra\Doctrine;

use MsgPhp\Domain\Infra\Doctrine\{MappingConfig, ObjectMappingProviderInterface};
use MsgPhp\Eav\Entity\{AttributeValue, Features};

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 *
 * @internal
 */
final class ObjectMappings implements ObjectMappingProviderInterface
{
    public static function provideObjectMappings(MappingConfig $config): iterable
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
