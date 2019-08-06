<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Command;

use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\Command;
use MsgPhp\Eav\Event;
use PHPUnit\Framework\TestCase;

final class CreateAttributeTest extends TestCase
{
    use IntegrationTestTrait;

    public function testCreate(): void
    {
        self::$bus->dispatch(new Command\CreateAttribute(['foo' => 'bar']));

        self::assertMessageIsDispatchedOnce(Event\AttributeCreated::class);

        /** @var Event\AttributeCreated $event */
        $event = self::$dispatchedMessages[Event\AttributeCreated::class][0];
        $repository = self::createAttributeRepository();

        self::assertSame('bar', $event->context['foo'] ?? null);
        self::assertInstanceOf(AttributeId::class, $event->context['id'] ?? null);
        self::assertTrue($event->context['id']->isEmpty());
        self::assertCount(1, $repository->findAll());
        self::assertSame($event->attribute, $repository->find($event->attribute->getId()));
    }

    public function testCreateWithId(): void
    {
        self::$bus->dispatch(new Command\CreateAttribute([
            'id' => $id = self::createDomainFactory()->create(AttributeId::class),
        ]));

        self::assertMessageIsDispatchedOnce(Event\AttributeCreated::class);

        /** @var Event\AttributeCreated $event */
        $event = self::$dispatchedMessages[Event\AttributeCreated::class][0];
        $repository = self::createAttributeRepository();

        self::assertSame($id, $event->context['id'] ?? null);
        self::assertFalse($event->attribute->getId()->isEmpty());
        self::assertTrue($repository->exists($event->attribute->getId()));
    }
}
