<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use App\Http\Requests\StorescoreRequest;
use App\Http\Requests\UpdatescoreRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class ScoreController extends Controller
{
    // gets the top 5 scores sorted by time
    public function index() : JsonResponse
    {
        $scores = Score::orderBy('elapsed_time')->limit(5)->get();
        return response()->json(['scores' => $scores]);
    }

    // stores a new score in the db
    public function store(Request $request) : JsonResponse
    {
        $score = new Score;
        $score->name = $request->name;
        $score->elapsed_time = $request->time;
        $score->clicks = $request->clicks;
        $score->save();
        return response()->json(['msg' => 'Score has been saved!']);
    }
}