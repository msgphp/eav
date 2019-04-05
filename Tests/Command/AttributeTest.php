<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Command;

use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\Command;
use MsgPhp\Eav\Event;
use PHPUnit\Framework\TestCase;

final class AttributeTest extends TestCase
{
    use IntegrationTestTrait;

    public function testCreate(): void
    {
        self::$bus->dispatch(new Command\CreateAttribute([]));

        self::assertMessageIsDispatchedOnce(Event\AttributeCreated::class, static function (Event\AttributeCreated $event): void {
            self::assertFalse($event->attribute->getId()->isEmpty());
            self::assertArrayHasKey('id', $event->context);
            self::assertInstanceOf(AttributeId::class, $event->context['id']);
            self::assertTrue($event->context['id']->isEmpty());
        });

        self::assertCount(1, self::createAttributeRepository()->findAll());
    }

    public function testCreateWithId(): void
    {
        self::$bus->dispatch(new Command\CreateAttribute([
            'id' => $id = self::createDomainFactory()->create(AttributeId::class),
        ]));

        self::assertMessageIsDispatchedOnce(Event\AttributeCreated::class, static function (Event\AttributeCreated $event) use ($id): void {
            self::assertFalse($event->attribute->getId()->isEmpty());
            self::assertArrayHasKey('id', $event->context);
            self::assertSame($id, $event->context['id']);
        });
    }

    public function testDelete(): void
    {
        self::$bus->dispatch(new Command\CreateAttribute([]));

        self::assertCount(1, self::createAttributeRepository()->findAll());

        /** @var Event\AttributeCreated $event */
        $event = self::$dispatchedMessages[Event\AttributeCreated::class][0];

        self::$bus->dispatch(new Command\DeleteAttribute($event->attribute->getId()));

        self::assertMessageIsDispatchedOnce(Event\AttributeDeleted::class);
        self::assertCount(0, self::createAttributeRepository()->findAll());
    }

    public function testDeleteUnknownId(): void
    {
        self::$bus->dispatch(new Command\DeleteAttribute(self::createDomainFactory()->create(AttributeId::class)));

        self::assertMessageIsNotDispatched(Event\AttributeDeleted::class);
        self::addToAssertionCount(1);
    }
}
