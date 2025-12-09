<?php

declare (strict_types = 1);

require_once 'API/Plugin/DTO/BaseDto.php';
require_once 'API/BO/Season.php';

/**
 * Data Transfer Object for Season
 */
class SeasonDto extends BaseDto
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
     * Create DTO from Season Business Object
     * @param object $bo Season business object
     * @return self
     */
    public static function fromBo(object $bo): self
    {
        if (! $bo instanceof Season) {
            throw new InvalidArgumentException('Expected instance of Season');
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
     * Convert DTO to Season Business Object
     * @param string $pluginUid Plugin unique identifier
     * @return Season
     */
    public function toBo(string $pluginUid): Season
    {
        return new Season(
            $pluginUid,
            $this->title,
            $this->year,
            $this->posterUrl,
            $this->description,
            $this->pluginData
        );
    }
}
