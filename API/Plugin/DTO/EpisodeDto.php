<?php

declare (strict_types = 1);

require_once __DIR__ . '/BaseDto.php';
require_once __DIR__ . '/../../BO/Episode.php';

/**
 * Data Transfer Object for Episode
 */
class EpisodeDto extends BaseDto
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
        string $title,
        ?int $year = null,
        ?string $posterUrl = null,
        ?string $description = null,
        ?array $pluginData = null
    ) {
        parent::__construct($pluginData);
        $this->title       = $title;
        $this->year        = $year;
        $this->posterUrl   = $posterUrl;
        $this->description = $description;
    }

    /**
     * Create DTO from Episode Business Object
     * @param object $bo Episode business object
     * @return self
     */
    public static function fromBo(object $bo): self
    {
        if (! $bo instanceof Episode) {
            throw new InvalidArgumentException('Expected instance of Episode');
        }
        return new self(
            $bo->title,
            $bo->year,
            $bo->posterUrl,
            $bo->description,
            $bo->pluginData
        );
    }

    /**
     * Convert DTO to Episode Business Object
     * @param string $pluginUid Plugin unique identifier
     * @return Episode
     */
    public function toBo(string $pluginUid): Episode
    {
        return new Episode(
            $pluginUid,
            $this->title,
            $this->year,
            $this->posterUrl,
            $this->description,
            $this->pluginData
        );
    }
}
