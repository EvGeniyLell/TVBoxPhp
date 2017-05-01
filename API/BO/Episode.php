<?php
require_once __DIR__ . '/BaseBo.php';

/**
 * Represents an episode of a series
 * can be associated with videos.
 */
class Episode extends BaseBo
{
    public string $title;
    public ?int $year;
    public ?string $posterUrl;
    public ?string $description;

    public function __construct(
        string $pluginUid,
        string $title,
        ?int $year = null,
        ?string $posterUrl = null,
        ?string $description = null,
        ?array $pluginData = null
    ) {
        parent::__construct($pluginUid, $pluginData);
        $this->title       = $title;
        $this->year        = $year;
        $this->posterUrl   = $posterUrl;
        $this->description = $description;
    }
}
