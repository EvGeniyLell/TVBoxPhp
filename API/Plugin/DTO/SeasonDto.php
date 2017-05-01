<?php
require_once 'api/plugin/dto/BaseDto.php';
require_once 'api/bo/Season.php';

class SeasonDto extends BaseDto
{
    public string $title;
    public ?int $year;
    public ?string $posterUrl;
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

    public static function fromBo(object $bo): self
    {
        if (! $bo instanceof Season) {
            throw new InvalidArgumentException('Expected instance of Season');
        }
        return new self(
            $bo->title,
            $bo->year,
            $bo->posterUrl,
            $bo->description
        );
    }

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
