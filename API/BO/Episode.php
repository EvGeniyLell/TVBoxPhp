<?php

declare (strict_types = 1);

require_once 'API/BO/BaseBo.php';

/**
 * Represents an episode of a series
 * can be associated with videos.
 */
class Episode extends BaseBo
{
    /**
     * Episode title
     * @var string
     */
    public string $title;

    /**
     * Release year
     * @var int|null
     */
    public ?int $year;

    /**
     * URL to episode poster image
     * @var string|null
     */
    public ?string $posterUrl;

    /**
     * Episode description
     * @var string|null
     */
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
