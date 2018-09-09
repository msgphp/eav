<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Infra\Doctrine;

use MsgPhp\Eav\Entity\Fields\AttributesField;
use MsgPhp\Eav\Infra\Doctrine\ObjectFieldMappings;
use PHPUnit\Framework\TestCase;

final class ObjectFieldMappingsTest extends TestCase
{
    public function testMapping(): void
    {
        $available = array_flip(array_map(function (string $file): string {
            return 'MsgPhp\\Eav\\Entity\\'.basename(\dirname($file)).'\\'.basename($file, '.php');
        }, glob(\dirname(__DIR__, 3).'/Entity/{Features,Fields}/*.php', \GLOB_BRACE)));
        unset($available[AttributesField::class]);

        $mappings = ObjectFieldMappings::provideObjectFieldMappings();
        $mappings = array_keys($mappings instanceof \Traversable ? iterator_to_array($mappings) : $mappings);
        sort($mappings);

        self::assertSame(array_keys($available), $mappings);
    }
}
