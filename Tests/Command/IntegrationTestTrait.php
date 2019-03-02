<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Command;

use MsgPhp\Domain\Factory\DomainObjectFactory as BaseDomainObjectFactory;
use MsgPhp\Domain\Infra\Doctrine\DomainObjectFactory;
use MsgPhp\Domain\Infra\Doctrine\Test\EntityManagerTestTrait;
use MsgPhp\Domain\Infra\Messenger\Test\MessageBusTestTrait;
use MsgPhp\Eav\{ScalarAttributeId, AttributeIdInterface};
use MsgPhp\Eav\{Command, Entity};
use MsgPhp\Eav\Infra\Doctrine\{Repository, Type};
use MsgPhp\Eav\Tests\Fixtures\Entities;

trait IntegrationTestTrait
{
    use EntityManagerTestTrait;
    use MessageBusTestTrait;

    public static function setUpBeforeClass(): void
    {
        self::initEm();
        self::initBus();
    }

    public static function tearDownAfterClass(): void
    {
        self::destroyBus();
        self::destroyEm();
    }

    protected static function getMessageHandlers(): iterable
    {
        $factory = self::createDomainFactory();
        $bus = self::createDomainMessageBus();
        $repository = self::createAttributeRepository();

        yield Command\CreateAttributeCommand::class => new Command\Handler\CreateAttributeHandler($factory, $bus, $repository);
        yield Command\DeleteAttributeCommand::class => new Command\Handler\DeleteAttributeHandler($factory, $bus, $repository);
    }

    protected static function createSchema(): bool
    {
        return true;
    }

    protected static function getEntityMappings(): iterable
    {
        yield 'annot' => [
            'MsgPhp\\Eav\\Tests\\Fixtures\\Entities\\' => \dirname(__DIR__).'/Fixtures/Entities',
        ];
        yield 'xml' => [
            'MsgPhp\\Eav\\Entity\\' => self::createEntityDistMapping(\dirname(__DIR__, 2).'/Infra/Doctrine/Resources/dist-mapping'),
        ];
    }

    protected static function getEntityIdTypes(): iterable
    {
        yield Type\AttributeIdType::class => ScalarAttributeId::class;
    }

    protected function setUp(): void
    {
        self::prepareEm();
    }

    protected function tearDown(): void
    {
        self::cleanEm();
        self::cleanBus();
    }

    private static function createDomainFactory(): DomainObjectFactory
    {
        return new DomainObjectFactory(new BaseDomainObjectFactory([
            AttributeIdInterface::class => ScalarAttributeId::class,
            Entity\Attribute::class => Entities\TestAttribute::class,
        ]), self::$em);
    }

    private static function createAttributeRepository(): Repository\AttributeRepository
    {
        return new Repository\AttributeRepository(Entities\TestAttribute::class, self::$em);
    }
}
