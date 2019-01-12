<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Infra\Doctrine;

use MsgPhp\Domain\Infra\Doctrine\MappingConfig;
use MsgPhp\Eav\Entity\Fields\AttributesField;
use MsgPhp\Eav\Infra\Doctrine\ObjectMappings;
use PHPUnit\Framework\TestCase;

final class ObjectMappingsTest extends TestCase
{
    public function testMapping(): void
    {
        $available = array_flip(array_map(function (string $file): string {
            return 'MsgPhp\\Eav\\Entity\\'.basename(\dirname($file)).'\\'.basename($file, '.php');
        }, array_merge(glob(\dirname(__DIR__, 3).'/Entity/Features/*.php'), glob(\dirname(__DIR__, 3).'/Entity/Fields/*.php'))));
        unset($available[AttributesField::class]);

        $mappings = ObjectMappings::provideObjectMappings(new MappingConfig([]));
        $mappings = array_keys($mappings instanceof \Traversable ? iterator_to_array($mappings) : $mappings);
        sort($mappings);

        self::assertSame(array_keys($available), $mappings);
    }
}
