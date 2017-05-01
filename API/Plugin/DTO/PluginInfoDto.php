<?php

class PluginInfoDto
{
    public string $uid;
    public string $name;
    public ?string $version;
    public ?string $author;
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
