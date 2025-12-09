<?php

declare (strict_types = 1);

/**
 * Abstract base class for a plugin
 */
abstract class Plugin
{
    /**
     * Network service for making HTTP requests
     * @var NetworkService
     */
    protected NetworkService $networkService;

    public function __construct(NetworkService $networkService)
    {
        $this->networkService = $networkService;
    }

    /**
     * Returns information about the plugin
     * @return PluginInfoDto Plugin information
     */
    abstract public function getInfo(): PluginInfoDto;

    /**
     * Searches title by query
     * @param string $query Search query
     * @return TitleUnitDto[] Array of movie or series DTOs
     */
    abstract public function searchTitle(string $query): array;

    /**
     * Gets videos for a movie
     * @param MovieDto $movie Movie to get videos for
     * @return VideoDto[] Array of video DTOs
     */
    abstract public function getVideosByMovie(MovieDto $movie): array;

    /**
     * Gets seasons for a series
     * @param SeriesDto $series Series to get seasons for
     * @return SeasonDto[] Array of season DTOs
     */
    abstract public function getSeasonsBySeries(SeriesDto $series): array;

    /**
     * Gets episodes for a season
     * @param SeasonDto $season Season to get episodes for
     * @return EpisodeDto[] Array of episode DTOs
     */
    abstract public function getEpisodesBySeason(SeasonDto $season): array;

    /**
     * Gets videos for an episode
     * @param EpisodeDto $episode Episode to get videos for
     * @return VideoDto[] Array of video DTOs
     */
    abstract public function getVideosByEpisode(EpisodeDto $episode): array;
}

/**
 * Trait providing default naming conventions for seasons and episodes
 */
trait NamingTrait
{
    /**
     * Generates default season name (e.g., "Season 01")
     * @param int $seasonNumber Season number
     * @return string Formatted season name
     */
    public function defaultSeasonName(int $seasonNumber): string
    {
        $index = str_pad((string) $seasonNumber, 2, '0', STR_PAD_LEFT);
        return "Season $index";
    }

    /**
     * Generates default episode name (e.g., "S01E05" or "Episode 5")
     * @param int $episodeNumber Episode number
     * @param int|null $seasonNumber Optional season number for S##E## format
     * @return string Formatted episode name
     */
    public function defaultEpisodeName(int $episodeNumber, ?int $seasonNumber = null): string
    {
        if ($seasonNumber !== null) {
            $sIndex = 'S' . str_pad((string) $seasonNumber, 2, '0', STR_PAD_LEFT);
            $eIndex = 'E' . str_pad((string) $episodeNumber, 2, '0', STR_PAD_LEFT);
            return "$sIndex$eIndex";
        }
        return "Episode $episodeNumber";
    }
}
