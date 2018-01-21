<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infra\InMemory\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Domain\Infra\InMemory\DomainEntityRepositoryTrait;
use MsgPhp\Eav\AttributeIdInterface;
use MsgPhp\Eav\Entity\Attribute;
use MsgPhp\Eav\Repository\AttributeRepositoryInterface;

/**
 * Proof of concept implementation for in-memory persistence. Currently no full support due extra maintenance and no
 * real practical added value.
 *
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class AttributeRepository implements AttributeRepositoryInterface
{
    use DomainEntityRepositoryTrait;

    /**
     * @return DomainCollectionInterface|Attribute[]
     */
    public function findAll(int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        return $this->doFindAll($offset, $limit);
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
