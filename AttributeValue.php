<?php

declare(strict_types=1);

namespace MsgPhp\Eav;

use MsgPhp\Eav\Model\AttributeField;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
abstract class AttributeValue
{
    use AttributeField;

    /** @var null|bool */
    private $boolValue;
    /** @var null|int */
    private $intValue;
    /** @var null|float */
    private $floatValue;
    /** @var null|string */
    private $stringValue;
    /** @var null|\DateTimeInterface */
    private $dateTimeValue;
    /** @var string */
    private $checksum;
    /** @var bool */
    private $isNull;
    /** @var mixed */
    private $value;

    /**
     * @param mixed $value
     */
    public function __construct(Attribute $attribute, $value)
    {
        $this->attribute = $attribute;

        $this->changeValue($value);
    }

    /**
     * @param mixed $value
     */
    public static function getChecksum($value): string
    {
        return md5(serialize([\is_object($value) ? \get_class($value) : \gettype($value), static::getIdentityValue($value)]));
    }

    abstract public function getId(): AttributeValueId;

    /**
     * @return mixed
     */
    final public function getValue()
    {
        if ($this->isNull) {
            return null;
        }

        if (null !== $this->value) {
            return $this->value;
        }

        if (null === $value = $this->doGetValue()) {
            $this->isNull = true;
        }

        return $this->value = $value;
    }

    /**
     * @param mixed $value
     */
    final public function changeValue($value): void
    {
        $this->doClearValue();
        $this->isNull = null === $value;

        if (!$this->isNull) {
            $this->doSetValue($value);
        }

        $this->value = $value;
        $this->checksum = static::getChecksum($value);
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    protected static function getIdentityValue($value)
    {
        return $value;
    }

    protected function doClearValue(): void
    {
        $this->boolValue = $this->intValue = $this->floatValue = $this->stringValue = $this->dateTimeValue = null;
    }

    /**
     * @param mixed $value
     */
    protected function doSetValue($value): void
    {
        if (\is_bool($value)) {
            $this->boolValue = $value;
        } elseif (\is_int($value)) {
            $this->intValue = $value;
        } elseif (\is_float($value)) {
            $this->floatValue = $value;
        } elseif (\is_string($value)) {
            $this->stringValue = $value;
        } elseif ($value instanceof \DateTimeInterface) {
            $this->dateTimeValue = $value;
        } else {
            throw new \LogicException('Unsupported attribute value type "'.\gettype($value).'".');
        }
    }

    /**
     * @return mixed
     */
    protected function doGetValue()
    {
        return $this->boolValue ?? $this->intValue ?? $this->floatValue ?? $this->stringValue ?? $this->dateTimeValue;
    }
}
