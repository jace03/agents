<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private const MIN_RELEASE_YEAR = 1888;

    /**
     * Display a listing of movies.
     */
    public function index(): JsonResponse
    {
        $movies = Movie::orderBy('title')->paginate(15);

        return response()->json($movies);
    }

    /**
     * Store a newly created movie.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate($this->validationRules());

        $movie = Movie::create($validated);

        return response()->json($movie, 201);
    }

    /**
     * Display the specified movie.
     */
    public function show(Movie $movie): JsonResponse
    {
        return response()->json($movie);
    }

    /**
     * Update the specified movie.
     */
    public function update(Request $request, Movie $movie): JsonResponse
    {
        $validated = $request->validate($this->validationRules(update: true));

        $movie->update($validated);

        return response()->json($movie);
    }

    /**
     * Remove the specified movie (soft-delete).
     */
    public function destroy(Movie $movie): JsonResponse
    {
        $movie->delete();

        return response()->json(null, 204);
    }

    /**
     * Return the shared validation rules for store/update.
     */
    private function validationRules(bool $update = false): array
    {
        $titleRule = $update ? 'sometimes|required' : 'required';
        $maxYear   = date('Y') + 5;

        return [
            'title'            => "{$titleRule}|string|max:255",
            'description'      => 'nullable|string',
            'genre'            => 'nullable|string|max:100',
            'release_year'     => "nullable|integer|min:" . self::MIN_RELEASE_YEAR . "|max:{$maxYear}",
            'director'         => 'nullable|string|max:255',
            'rating'           => 'nullable|numeric|min:0|max:10',
            'duration_minutes' => 'nullable|integer|min:1',
        ];
    }
}
