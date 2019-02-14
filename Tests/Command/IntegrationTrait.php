<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Command;

use MsgPhp\Domain\Factory\DomainObjectFactory as BaseDomainObjectFactory;
use MsgPhp\Domain\Infra\Doctrine\DomainObjectFactory;
use MsgPhp\Domain\Infra\Doctrine\Test\EntityManagerTrait;
use MsgPhp\Domain\Infra\Messenger\Test\MessageBusTrait;
use MsgPhp\Eav\{AttributeId, AttributeIdInterface, AttributeValueId, AttributeValueIdInterface};
use MsgPhp\Eav\{Command, Entity};
use MsgPhp\Eav\Infra\Doctrine\Repository;
use MsgPhp\Eav\Infra\Doctrine\Type\{AttributeIdType, AttributeValueIdType};
use MsgPhp\Eav\Tests\Fixtures\Entities;

trait IntegrationTrait
{
    use EntityManagerTrait;
    use MessageBusTrait;

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
        yield AttributeIdType::class => AttributeId::class;
        yield AttributeValueIdType::class => AttributeValueId::class;
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
            AttributeIdInterface::class => AttributeId::class,
            AttributeValueIdInterface::class => AttributeValueId::class,
            Entity\Attribute::class => Entities\TestAttribute::class,
            Entity\AttributeValue::class => Entities\TestAttributeValue::class,
        ]), self::$em);
    }

    private static function createAttributeRepository(): Repository\AttributeRepository
    {
        return new Repository\AttributeRepository(Entities\TestAttribute::class, self::$em);
    }
}
