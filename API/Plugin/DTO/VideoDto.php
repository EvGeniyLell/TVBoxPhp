<?php
require_once 'api/plugin/dto/BaseDto.php';
require_once 'api/bo/Video.php';

class VideoDto extends BaseDto
{
    public string $url;
    public ?string $quality;  // e.g., 1080p, 720p
    public ?string $language; // e.g., English, Spanish
    public ?int $duration;    // in seconds
    public ?array $subtitles; // @array of string

    public function __construct(
        string $url,
        ?string $quality = null,
        ?string $language = null,
        ?int $duration = null,
        ?array $subtitles = null,
        ?array $pluginData = null
    ) {
        parent::__construct($pluginData);
        $this->url       = $url;
        $this->quality   = $quality;
        $this->language  = $language;
        $this->duration  = $duration;
        $this->subtitles = $subtitles;
    }

    public static function fromBo(object $bo): self
    {
        if (! $bo instanceof Video) {
            throw new InvalidArgumentException('Expected instance of Video');
        }
        return new self(
            $bo->url,
            $bo->quality,
            $bo->language,
            $bo->duration,
            $bo->subtitles
        );
    }

    public function toBo(string $pluginUid): Video
    {
        return new Video(
            $pluginUid,
            $this->url,
            $this->quality,
            $this->language,
            $this->duration,
            $this->subtitles,
            $this->pluginData
        );
    }
}
