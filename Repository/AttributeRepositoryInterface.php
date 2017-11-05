<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Repository;

use MsgPhp\Domain\Entity\EntityCollectionInterface;
use MsgPhp\Eav\Entity\Attribute;
use MsgPhp\Eav\AttributeIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
interface AttributeRepositoryInterface
{
    /**
     * @return EntityCollectionInterface|Attribute[]
     */
    public function findAll(int $offset = null, int $limit = null): EntityCollectionInterface;
    public function find(AttributeIdInterface $id): Attribute;
    public function exists(AttributeIdInterface $id): bool;

    /**
     * @internal
     */
    public function save(Attribute $attribute): void;

    /**
     * @internal
     */
    public function delete(Attribute $attribute): void;
}
