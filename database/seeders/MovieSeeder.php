<?php

namespace Database\Seeders;

use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{

    public function run(): void
    {
        $client = new Client();

        try {
            // OMDB API requires a specific title (t parameter) or search term (s parameter)
            // Your current URL is trying to search by genre which isn't supported directly
            $response = $client->get('http://www.omdbapi.com/?s=action&y=2024&apikey=9fca8f65&type=movie');

            $data = json_decode($response->getBody(), true);

            // Check if response contains movies
            if ($data['Response'] === 'True' && isset($data['Search'])) {
                foreach ($data['Search'] as $movie) {
                    // For each movie, make another API call to get full details
                    $movieResponse = $client->get('http://www.omdbapi.com/?i=' . $movie['imdbID'] . '&apikey=9fca8f65');
                    $movieDetails = json_decode($movieResponse->getBody(), true);

                    DB::table('movies')->insert([
                        'movie_title' => $movieDetails['Title'] ?? 'N/A',
                        'movie_description' => $movieDetails['Plot'] ?? 'No plot available',
                        'is_active' => 1,
                        'movie_image' => $movieDetails['Poster'] ?? null,
                        'movie_video' => '',
                        'created_by' => 1,
                        'updated_by' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        } catch (\Exception $e) {
            //log err
        }
    }
}
