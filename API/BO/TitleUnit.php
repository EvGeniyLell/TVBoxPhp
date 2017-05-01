<?php
require_once __DIR__ . '/BaseBo.php';

/**
 * Represents a title type, which can be either a Movie or Series.
 */
abstract class TitleUnit extends BaseBo
{
    public string $title;
    public ?int $year;
    public ?string $posterUrl;
    public ?string $description;
    public ?array $genres; // @array of string

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
 * Represents an movie
 * can be associated with videos.
 * @extends TitleUnit<Movie>
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
 * Represents an series
 * can be associated with seasons.
 * @extends TitleUnit<Series>
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
