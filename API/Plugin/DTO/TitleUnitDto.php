<?php

declare (strict_types = 1);

require_once 'API/Plugin/DTO/BaseDto.php';
require_once 'API/BO/TitleUnit.php';

/**
 * Base Data Transfer Object for title types (Movie/Series)
 */
abstract class TitleUnitDto extends BaseDto
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
        string $title,
        ?int $year = null,
        ?string $posterUrl = null,
        ?string $description = null,
        ?array $genres = null,
        ?array $pluginData = null
    ) {
        parent::__construct($pluginData);
        $this->title       = $title;
        $this->year        = $year;
        $this->posterUrl   = $posterUrl;
        $this->description = $description;
        $this->genres      = $genres;
    }

    abstract public static function fromBo(object $bo): self;

    abstract public function toBo(string $pluginUid): object;
}

/**
 * Data Transfer Object for Movie
 */
class MovieDto extends TitleUnitDto
{
    public function __construct(
        string $title,
        ?int $year = null,
        ?string $posterUrl = null,
        ?string $description = null,
        ?array $genres = null,
        ?array $pluginData = null
    ) {
        parent::__construct($title, $year, $posterUrl, $description, $genres, $pluginData);
    }

    /**
     * Create DTO from Movie Business Object
     * @param object $bo Movie business object
     * @return self
     */
    public static function fromBo(object $bo): self
    {
        if (! $bo instanceof Movie) {
            throw new InvalidArgumentException('Expected instance of Movie');
        }
        return new self(
            $bo->title,
            $bo->year,
            $bo->posterUrl,
            $bo->description,
            $bo->genres,
            $bo->pluginData
        );
    }

    /**
     * Convert DTO to Movie Business Object
     * @param string $pluginUid Plugin unique identifier
     * @return Movie
     */
    public function toBo(string $pluginUid): Movie
    {
        return new Movie(
            $pluginUid,
            $this->title,
            $this->year,
            $this->posterUrl,
            $this->description,
            $this->genres,
            $this->pluginData
        );
    }
}

/**
 * Data Transfer Object for Series
 */
class SeriesDto extends TitleUnitDto
{
    public function __construct(
        string $title,
        ?int $year = null,
        ?string $posterUrl = null,
        ?string $description = null,
        ?array $genres = null,
        ?array $pluginData = null
    ) {
        parent::__construct($title, $year, $posterUrl, $description, $genres, $pluginData);
    }

    /**
     * Create DTO from Series Business Object
     * @param object $bo Series business object
     * @return self
     */
    public static function fromBo(object $bo): self
    {
        if (! $bo instanceof Series) {
            throw new InvalidArgumentException('Expected instance of Series');
        }
        return new self(
            $bo->title,
            $bo->year,
            $bo->posterUrl,
            $bo->description,
            $bo->genres,
            $bo->pluginData
        );
    }

    /**
     * Convert DTO to Series Business Object
     * @param string $pluginUid Plugin unique identifier
     * @return Series
     */
    public function toBo(string $pluginUid): Series
    {
        return new Series(
            $pluginUid,
            $this->title,
            $this->year,
            $this->posterUrl,
            $this->description,
            $this->genres,
            $this->pluginData
        );
    }
}
