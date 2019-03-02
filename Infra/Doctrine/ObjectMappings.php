<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infra\Doctrine;

use MsgPhp\Domain\Infra\Doctrine\MappingConfig;
use MsgPhp\Domain\Infra\Doctrine\ObjectMappingProviderInterface;
use MsgPhp\Eav\Entity\Attribute;
use MsgPhp\Eav\Entity\AttributeValue;
use MsgPhp\Eav\Entity\Features;
use MsgPhp\Eav\Entity\Fields;

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
        yield Fields\AttributeField::class => [
            'attribute' => [
                'type' => self::TYPE_MANY_TO_ONE,
                'targetEntity' => Attribute::class,
                'joinColumns' => [
                    ['nullable' => false],
                ],
            ],
        ];
    }
}
