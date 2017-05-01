<?php

/// Abstract  class for a plugin
abstract class Plugin
{
    protected NetworkService $networkService;

    public function __construct(NetworkService $networkService)
    {
        $this->networkService = $networkService;
    }

    /**
     * Returns information about the plugin
     */
    abstract public function getInfo(): PluginInfoDto;

    /**
     * Searches title by query
     * @return TitleUnitDto[]
     */
    abstract public function searchTitle(string $query): array;

    /**
     * Videos by movie
     * @return VideoDto[]
     */
    abstract public function getVideosByMovie(MovieDto $movie): array;

    /**
     * Seasons by series
     * @return SeasonDto[]
     */
    abstract public function getSeasonsBySeries(SeriesDto $series): array;

    /**
     * Episodes by season
     * @return EpisodeDto[]
     */
    abstract public function getEpisodesBySeason(SeasonDto $season): array;

    /**
     * Videos by episode
     * @return VideoDto[]
     */
    abstract public function getVideosByEpisode(EpisodeDto $episode): array;

}

trait NamingTrait
{
    public function defaultSeasonName(int $seasonNumber): string
    {
        $index = str_pad((string) $seasonNumber, 2, '0', STR_PAD_LEFT);
        return "Season $index";
    }

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
