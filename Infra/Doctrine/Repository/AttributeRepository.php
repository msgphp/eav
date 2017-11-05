<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infra\Doctrine\Repository;

use MsgPhp\Domain\Entity\EntityCollectionInterface;
use MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait;
use MsgPhp\Eav\AttributeIdInterface;
use MsgPhp\Eav\Entity\Attribute;
use MsgPhp\Eav\Repository\AttributeRepositoryInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class AttributeRepository implements AttributeRepositoryInterface
{
    use DomainEntityRepositoryTrait;

    private $alias = 'attribute';
    private $idFields = ['id'];

    /**
     * @return EntityCollectionInterface|Attribute[]
     */
    public function findAll(int $offset = null, int $limit = null): EntityCollectionInterface
    {
        return $this->createResultSet($this->createQueryBuilder($offset, $limit)->getQuery());
    }

    public function find(AttributeIdInterface $id): Attribute
    {
        return $this->doFind($id);
    }

    public function exists(AttributeIdInterface $id): bool
    {
        return $this->doExists($id);
    }

    /**
     * @internal
     */
    public function save(Attribute $attribute): void
    {
        $this->doSave($attribute);
    }

    /**
     * @internal
     */
    public function delete(Attribute $attribute): void
    {
        $this->doDelete($attribute);
    }
}
