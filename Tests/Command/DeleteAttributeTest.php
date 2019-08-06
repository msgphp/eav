<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Command;

use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\Command;
use MsgPhp\Eav\Event;
use PHPUnit\Framework\TestCase;

final class DeleteAttributeTest extends TestCase
{
    use IntegrationTestTrait;

    public function testDelete(): void
    {
        $repository = self::createAttributeRepository();
        $repository->save($attribute = self::createDomainFactory()->create(Attribute::class));

        self::$bus->dispatch(new Command\DeleteAttribute($attribute->getId()));

        self::assertMessageIsDispatchedOnce(Event\AttributeDeleted::class);
        self::assertCount(0, $repository->findAll());
    }

    public function testDeleteUnknownId(): void
    {
        self::$bus->dispatch(new Command\DeleteAttribute(self::createDomainFactory()->create(AttributeId::class)));

        self::assertMessageIsNotDispatched(Event\AttributeDeleted::class);
    }
}
