<?php
require_once 'api/plugin/dto/BaseDto.php';
require_once 'api/bo/Episode.php';

class EpisodeDto extends BaseDto
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
        if (! $bo instanceof Episode) {
            throw new InvalidArgumentException('Expected instance of Episode');
        }
        return new self(
            $bo->title,
            $bo->year,
            $bo->posterUrl,
            $bo->description
        );
    }

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
