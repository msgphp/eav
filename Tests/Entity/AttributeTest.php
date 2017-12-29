<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Entity;

use MsgPhp\Eav\AttributeIdInterface;
use MsgPhp\Eav\Entity\Attribute;
use PHPUnit\Framework\TestCase;

final class AttributeTest extends TestCase
{
    public function testCreate(): void
    {
        $attribute = new Attribute($id = $this->getMockBuilder(AttributeIdInterface::class)->getMock());

        $this->assertSame($id, $attribute->getId());
    }
}
