<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infra\InMemory\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Domain\Infra\InMemory\DomainEntityRepositoryTrait;
use MsgPhp\Eav\AttributeIdInterface;
use MsgPhp\Eav\Entity\Attribute;
use MsgPhp\Eav\Repository\AttributeRepositoryInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class AttributeRepository implements AttributeRepositoryInterface
{
    use DomainEntityRepositoryTrait;

    private $idFields = ['id'];

    /**
     * @return DomainCollectionInterface|Attribute[]
     */
    public function findAll(int $offset = null, int $limit = null): DomainCollectionInterface
    {
        return $this->createResultSet($offset, $limit);
    }

    public function find(AttributeIdInterface $id): Attribute
    {
        return $this->doFind($id);
    }

    public function exists(AttributeIdInterface $id): bool
    {
        return $this->doExists($id);
    }

    public function save(Attribute $attribute): void
    {
        $this->doSave($attribute);
    }

    public function delete(Attribute $attribute): void
    {
        $this->doDelete($attribute);
    }
}
