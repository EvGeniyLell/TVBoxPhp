<?php

declare (strict_types = 1);

require_once __DIR__ . '/BaseDto.php';
require_once __DIR__ . '/../../BO/Video.php';

/**
 * Data Transfer Object for Video
 */
class VideoDto extends BaseDto
{
    /**
     * Video URL or stream link
     * @var string
     */
    public string $url;

    /**
     * Video quality (e.g., 1080p, 720p)
     * @var string|null
     */
    public ?string $quality;

    /**
     * Audio language (e.g., English, Spanish)
     * @var string|null
     */
    public ?string $language;

    /**
     * Video duration in seconds
     * @var int|null
     */
    public ?int $duration;

    /**
     * List of available subtitle URLs or identifiers
     * @var array|null Array of strings
     */
    public ?array $subtitles;

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

    /**
     * Create DTO from Video Business Object
     * @param object $bo Video business object
     * @return self
     */
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
            $bo->subtitles,
            $bo->pluginData
        );
    }

    /**
     * Convert DTO to Video Business Object
     * @param string $pluginUid Plugin unique identifier
     * @return Video
     */
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
