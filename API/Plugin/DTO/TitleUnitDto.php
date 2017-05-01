<?php
require_once 'api/plugin/dto/BaseDto.php';
require_once 'api/bo/Movie.php';
require_once 'api/bo/Series.php';

abstract class TitleUnitDto extends BaseDto
{
    public string $title;
    public ?int $year;
    public ?string $posterUrl;
    public ?string $description;
    public ?array $genres; // @array of string

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
 * @extends TitleUnitDto<Movie>
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
 * @extends TitleUnitDto<Series>
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
