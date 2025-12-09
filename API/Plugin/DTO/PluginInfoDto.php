<?php

declare (strict_types = 1);

/**
 * Data Transfer Object for Plugin Information
 */
class PluginInfoDto
{
    /**
     * Plugin unique identifier
     * @var string
     */
    public string $uid;

    /**
     * Plugin name
     * @var string
     */
    public string $name;

    /**
     * Plugin version
     * @var string|null
     */
    public ?string $version;

    /**
     * Plugin author
     * @var string|null
     */
    public ?string $author;

    /**
     * Plugin description
     * @var string|null
     */
    public ?string $description;

    public function __construct(
        string $uid,
        string $name,
        ?string $version = null,
        ?string $author = null,
        ?string $description = null
    ) {
        $this->uid         = $uid;
        $this->name        = $name;
        $this->version     = $version;
        $this->author      = $author;
        $this->description = $description;
    }
}
