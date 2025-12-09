<?php

declare (strict_types = 1);

/**
 * Base Data Transfer Object for plugin communication
 */
abstract class BaseDto
{
    /**
     * Plugin specific additional data
     * @var array|null
     */
    public ?array $pluginData;

    public function __construct(?array $pluginData = null)
    {
        $this->pluginData = $pluginData;
    }

    /**
     * Create DTO from Business Object
     * @param object $bo Business object to convert
     * @return static
     */
    abstract public static function fromBo(object $bo): self;

    /**
     * Convert DTO to Business Object
     * @param string $pluginUid Plugin unique identifier
     * @return object Business object instance
     */
    abstract public function toBo(string $pluginUid): object;
}
