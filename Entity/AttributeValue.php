<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Entity;

use MsgPhp\Eav\AttributeIdInterface;
use MsgPhp\Eav\AttributeValueIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class AttributeValue
{
    private $id;
    private $attribute;
    private $isNull;
    private $boolValue;
    private $intValue;
    private $floatValue;
    private $stringValue;
    private $dateTimeValue;
    private $value;

    /**
     * @internal
     */
    public function __construct(AttributeValueIdInterface $id, Attribute $attribute, $value)
    {
        $this->id = $id;
        $this->attribute = $attribute;

        $this->changeValue($value);
    }

    public function getId(): AttributeValueIdInterface
    {
        return $this->id;
    }

    public function getAttribute(): Attribute
    {
        return $this->attribute;
    }

    public function getAttributeId(): AttributeIdInterface
    {
        return $this->attribute->getId();
    }

    public function isNull(): bool
    {
        return $this->isNull;
    }

    public function getValue()
    {
        if ($this->isNull) {
            return null;
        } elseif (null !== $this->value) {
            return $this->value;
        } else {
            return $this->value = $this->doGetValue();
        }
    }

    /**
     * @internal
     */
    public function changeValue($value): void
    {
        $this->isNull = false;
        $this->boolValue = $this->intValue = $this->floatValue = $this->stringValue = $this->value = null;

        $this->doSetValue($value);

        $this->value = $value;
    }

    protected function doSetValue($value): void
    {
        if (null === $value) {
            $this->isNull = true;
        } elseif (is_bool($value)) {
            $this->boolValue = $value;
        } elseif (is_int($value)) {
            $this->intValue = $value;
        } elseif (is_float($value)) {
            $this->floatValue = $value;
        } elseif (is_string($value)) {
            $this->stringValue = $value;
        } elseif ($value instanceof \DateTimeInterface) {
            $this->dateTimeValue = $value;
        } else {
            throw new \LogicException(sprintf('Unsupported attribute value type "%s".', gettype($value)));
        }
    }

    protected function doGetValue()
    {
        return $this->boolValue ?? $this->intValue ?? $this->floatValue ?? $this->stringValue ?? $this->dateTimeValue;
    }
}
