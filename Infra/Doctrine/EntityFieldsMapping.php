<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infra\Doctrine;

use MsgPhp\Domain\Infra\Doctrine\ObjectFieldMappingProviderInterface;
use MsgPhp\Eav\Entity\{AttributeValue, Fields};

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 *
 * @internal
 */
final class EntityFieldsMapping implements ObjectFieldMappingProviderInterface
{
    public static function getObjectFieldMapping(): array
    {
        return [
            Fields\AttributeValueField::class => [
                'attributeValue' => [
                    'type' => self::TYPE_MANY_TO_ONE,
                    'targetEntity' => AttributeValue::class,
                    'joinColumns' => [
                        ['nullable' => false],
                    ],
                ],
            ],
        ];
    }
}
