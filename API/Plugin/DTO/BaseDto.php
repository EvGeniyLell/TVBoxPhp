<?php

/**
 * Base Plugin Data Object
 * Base Data Transfer Object
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
     * @return static
     */
    abstract public static function fromBo(object $bo): self;

    /**
     * Convert DTO to Business Object
     * @return object
     */
    abstract public function toBo(string $pluginUid): object;
}
