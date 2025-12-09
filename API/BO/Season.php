<?php

declare (strict_types = 1);

require_once __DIR__ . '/BaseBo.php';

/**
 * Represents a season of a series
 * can be associated with episodes.
 */
class Season extends BaseBo
{
    /**
     * Season title
     * @var string
     */
    public string $title;

    /**
     * Release year
     * @var int|null
     */
    public ?int $year;

    /**
     * URL to season poster image
     * @var string|null
     */
    public ?string $posterUrl;

    /**
     * Season description
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
