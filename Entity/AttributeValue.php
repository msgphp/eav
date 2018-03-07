<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Entity;

use MsgPhp\Eav\{AttributeIdInterface, AttributeValueIdInterface};

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
abstract class AttributeValue
{
    private $attribute;
    private $boolValue;
    private $intValue;
    private $floatValue;
    private $stringValue;
    private $dateTimeValue;
    private $checksum;
    private $value;
    private $isNull;

    public function __construct(Attribute $attribute, $value)
    {
        $this->attribute = $attribute;

        $this->changeValue($value);
    }

    abstract public function getId(): AttributeValueIdInterface;

    public function getAttribute(): Attribute
    {
        return $this->attribute;
    }

    public function getAttributeId(): AttributeIdInterface
    {
        return $this->attribute->getId();
    }

    public function getValue()
    {
        if ($this->isNull || null !== $this->value) {
            return $this->value;
        }

        if (null === $value = $this->doGetValue()) {
            $this->isNull = true;
        }

        return $this->value = $value;
    }

    public function getChecksum(): string
    {
        return $this->checksum;
    }

    public function changeValue($value): void
    {
        $this->isNull = true;
        $this->boolValue = $this->intValue = $this->floatValue = $this->stringValue = $this->dateTimeValue = $this->value = null;

        if (null !== $value) {
            $this->doSetValue($value);

            $this->value = $value;
        }

        $this->checksum = md5(serialize($value));
    }

    protected function doSetValue($value): void
    {
        if (is_bool($value)) {
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
