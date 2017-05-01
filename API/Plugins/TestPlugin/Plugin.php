<?php

require_once 'API/Plugin/DTO/TitleUnitDto.php';
require_once 'API/Plugin/DTO/EpisodeDto.php';
require_once 'API/Plugin/DTO/SeasonDto.php';
require_once 'API/Plugin/DTO/VideoDto.php';
require_once 'API/Plugin/DTO/PluginInfoDto.php';
require_once 'API/Plugin/Plugin.php';

class TestPlugin extends Plugin
{
    private PluginInfoDto $info;

    /**
     * Creates a new instance of the TestPlugin.
     */
    public function __construct(
        NetworkService $networkService,
    ) {
        parent::__construct($networkService);
        $this->info = new PluginInfoDto(
            uid: 'test_plugin',
            name: 'Test Plugin',
            version: '1.0.0'
        );
    }

    public function getUid(): string
    {
        return $this->info->uid;
    }

    /**
     * Returns information about the plugin.
     */
    public function getInfo(): PluginInfoDto
    {
        return $this->info;
    }

    /**
     * Searches title by query.
     *
     * @return TitleUnitDto[]
     */
    public function searchTitle(string $query): array
    {
        // Dummy implementation for testing
        return [
            new MovieDto(
                title: 'Lion Killer',
                year: 2024,
                posterUrl: 'https://upload.wikimedia.org/wikipedia/uk/e/e1/Léon_poster.JPG', description: 'A professional assassin named Léon takes in a young girl after her family is murdered.',
                genres: ['Action', 'Crime', 'Drama'],
                pluginData: ['uid' => 'movie_001']
            ),
            new SeriesDto(
                title: 'Simpsons: Television Series DVD Collection. Megapack of 13 seasons', year: 1990,
                posterUrl: 'https://upload.wikimedia.org/wikipedia/uk/0/0d/Simpsons_FamilyPicture.png',
                pluginData: ['uid' => 'series_001']
            ),
        ];
    }

    /**
     * Videos by movie.
     *
     * @return VideoDto[]
     */
    public function getVideosByMovie(MovieDto $movie): array
    {
        // Dummy implementation for testing
        return [];
    }

    /**
     * Seasons by series.
     *
     * @return SeasonDto[]
     */
    public function getSeasonsBySeries(SeriesDto $series): array
    {
        // Dummy implementation for testing
        return [];
    }

    /**
     * Episodes by season.
     *
     * @return EpisodeDto[]
     */
    public function getEpisodesBySeason(SeasonDto $season): array
    {
        // Dummy implementation for testing
        return [];
    }

    /**
     * Videos by episode.
     *
     * @return VideoDto[]
     */
    public function getVideosByEpisode(EpisodeDto $episode): array
    {
        // Dummy implementation for testing
        return [];
    }
}
