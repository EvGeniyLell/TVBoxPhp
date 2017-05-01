<?php
require_once __DIR__ . '/BaseBo.php';

class Video extends BaseBo
{
    public string $url;
    public ?string $quality;  // e.g., 1080p, 720p
    public ?string $language; // e.g., English, Spanish
    public ?int $duration;    // in seconds
    public ?array $subtitles; // @array of string

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
