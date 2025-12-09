<?php

declare (strict_types = 1);

abstract class BaseBo
{
    /**
     * Plugin unique identifier
     * @var string
     */
    public string $pluginUid;

    /**
     * Plugin specific additional data
     * @var array|null
     */
    public ?array $pluginData;

    public function __construct(string $pluginUid, ?array $pluginData = null)
    {
        $this->pluginUid  = $pluginUid;
        $this->pluginData = $pluginData;
    }
}
