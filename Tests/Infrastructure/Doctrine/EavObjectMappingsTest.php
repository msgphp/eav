<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Infrastructure\Doctrine;

use MsgPhp\Domain\Infrastructure\Doctrine\MappingConfig;
use MsgPhp\Eav\Infrastructure\Doctrine\EavObjectMappings;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class EavObjectMappingsTest extends TestCase
{
    public function testMapping(): void
    {
        $available = array_flip(array_map(static function (string $file): string {
            return 'MsgPhp\\Eav\\Model\\'.basename($file, '.php');
        }, glob(\dirname(__DIR__, 3).'/Model/*.php')));
        $mappings = EavObjectMappings::provideObjectMappings(new MappingConfig([]));
        $mappings = array_keys($mappings instanceof \Traversable ? iterator_to_array($mappings) : $mappings);
        sort($mappings);

        self::assertSame(array_keys($available), $mappings);
    }
}
