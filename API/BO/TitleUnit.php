<?php

declare (strict_types = 1);

require_once 'API/BO/BaseBo.php';

/**
 * Represents a title type, which can be either a Movie or Series.
 */
abstract class TitleUnit extends BaseBo
{
    /**
     * Title name
     * @var string
     */
    public string $title;

    /**
     * Release year
     * @var int|null
     */
    public ?int $year;

    /**
     * URL to poster image
     * @var string|null
     */
    public ?string $posterUrl;

    /**
     * Title description
     * @var string|null
     */
    public ?string $description;

    /**
     * List of genre names
     * @var array|null Array of strings
     */
    public ?array $genres;

    public function __construct(
        string $pluginUid,
        string $title,
        ?int $year = null,
        ?string $posterUrl = null,
        ?string $description = null,
        ?array $genres = null,
        ?array $pluginData = null
    ) {
        parent::__construct($pluginUid, $pluginData);
        $this->title       = $title;
        $this->year        = $year;
        $this->posterUrl   = $posterUrl;
        $this->description = $description;
        $this->genres      = $genres;
    }
}

/**
 * Represents a movie
 * can be associated with videos.
 */
class Movie extends TitleUnit
{
    public function __construct(
        string $pluginUid,
        string $title,
        ?int $year = null,
        ?string $posterUrl = null,
        ?string $description = null,
        ?array $genres = null,
        ?array $pluginData = null
    ) {
        parent::__construct($pluginUid, $title, $year, $posterUrl, $description, $genres, $pluginData);
    }
}

/**
 * Represents a series
 * can be associated with seasons.
 */
class Series extends TitleUnit
{
    public function __construct(
        string $pluginUid,
        string $title,
        ?int $year = null,
        ?string $posterUrl = null,
        ?string $description = null,
        ?array $genres = null,
        ?array $pluginData = null
    ) {
        parent::__construct($pluginUid, $title, $year, $posterUrl, $description, $genres, $pluginData);
    }
}
