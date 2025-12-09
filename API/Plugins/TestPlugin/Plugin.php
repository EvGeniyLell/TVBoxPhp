<?php

declare (strict_types = 1);

require_once __DIR__ . '/../../Plugin/Plugin.php';
require_once __DIR__ . '/../../Plugin/DTO/PluginInfoDto.php';
require_once __DIR__ . '/../../Plugin/DTO/TitleUnitDto.php';
require_once __DIR__ . '/../../Plugin/DTO/EpisodeDto.php';
require_once __DIR__ . '/../../Plugin/DTO/SeasonDto.php';
require_once __DIR__ . '/../../Plugin/DTO/VideoDto.php';

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
        $query = strtolower($query);

        $allTitles = [
            new MovieDto(
                title: 'Léon: The Professional',
                year: 1994,
                posterUrl: 'https://upload.wikimedia.org/wikipedia/uk/e/e1/Léon_poster.JPG',
                description: 'A professional assassin named Léon takes in a young girl after her family is murdered.',
                genres: ['Action', 'Crime', 'Drama', 'Thriller', 'Foreign', 'Cult', 'Classic', 'Independent'],
                pluginData: ['uid' => 'movie_lk']
            ),
            new MovieDto(
                title: 'The Matrix',
                year: 1999,
                posterUrl: 'https://upload.wikimedia.org/wikipedia/uk/f/f1/Matrix_poster.jpg',
                pluginData: ['uid' => 'movie_mx']
            ),
            new MovieDto(
                title: 'The Matrix 2',
                year: 2000,
                posterUrl: 'https://m.media-amazon.com/images/M/MV5BN2NmN2VhMTQtMDNiOS00NDlhLTliMjgtODE2ZTY0ODQyNDRhXkEyXkFqcGc@._V1_.jpg',
                pluginData: ['uid' => 'movie_mx2']
            ),
            new MovieDto(
                title: 'The Matrix 3',
                year: 2001,
                posterUrl: 'https://m.media-amazon.com/images/M/MV5BN2NmN2VhMTQtMDNiOS00NDlhLTliMjgtODE2ZTY0ODQyNDRhXkEyXkFqcGc@._V1_.jpg',
                pluginData: ['uid' => 'movie_mx3']
            ),
            new MovieDto(
                title: 'The Matrix: Reloaded',
                year: 2003,
                posterUrl: 'https://upload.wikimedia.org/wikipedia/uk/0/05/Matrixreloaded.jpg',
                pluginData: ['uid' => 'movie_mx4']
            ),
            new MovieDto(
                title: 'The Matrix: Resurrections',
                year: 2021,
                posterUrl: 'https://upload.wikimedia.org/wikipedia/uk/a/a6/Matrixrevolt.jpg',
                pluginData: ['uid' => 'movie_mx5']
            ),
            new SeriesDto(
                title: 'The Simpsons: Definitive Guide DVD Collection Season 1-20',
                year: 1989,
                posterUrl: 'https://upload.wikimedia.org/wikipedia/uk/0/0d/Simpsons_FamilyPicture.png',
                description: 'The satirical adventures of the Simpson family.',
                genres: ['Animation', 'Comedy'],
                pluginData: ['uid' => 'series_001']
            ),
            new SeriesDto(
                title: 'Breaking Bad',
                year: 2008,
                posterUrl: 'https://upload.wikimedia.org/wikipedia/en/0/03/Walter_White_S5B.png',
                description: 'A chemistry teacher turned methamphetamine manufacturer.',
                genres: ['Crime', 'Drama', 'Thriller'],
                pluginData: ['uid' => 'series_002']
            ),
        ];

        return array_values(array_filter($allTitles, function ($title) use ($query) {
            return stripos($title->title, $query) !== false;
        }));
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
