<?php

declare (strict_types = 1);

require_once __DIR__ . '/BaseBo.php';

/**
 * Represents a video stream or file
 * can be associated with movies or episodes.
 */
class Video extends BaseBo
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
        string $pluginUid,
        string $url,
        ?string $quality = null,
        ?string $language = null,
        ?int $duration = null,
        ?array $subtitles = null,
        ?array $pluginData = null
    ) {
        parent::__construct($pluginUid, $pluginData);
        $this->url       = $url;
        $this->quality   = $quality;
        $this->language  = $language;
        $this->duration  = $duration;
        $this->subtitles = $subtitles;
    }
}
