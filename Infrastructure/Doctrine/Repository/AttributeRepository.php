<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infrastructure\Doctrine\Repository;

use MsgPhp\Domain\DomainCollection;
use MsgPhp\Domain\Infrastructure\Doctrine\DomainEntityRepositoryTrait;
use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\Repository\AttributeRepository as BaseAttributeRepository;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 *
 * @template T of Attribute
 * @implements BaseAttributeRepository<T>
 */
final class AttributeRepository implements BaseAttributeRepository
{
    /** @use DomainEntityRepositoryTrait<T> */
    use DomainEntityRepositoryTrait;

    public function findAll(int $offset = 0, int $limit = 0): DomainCollection
    {
        return $this->doFindAll($offset, $limit);
    }

    public function find(AttributeId $id): Attribute
    {
        return $this->doFind($id);
    }

    public function exists(AttributeId $id): bool
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
