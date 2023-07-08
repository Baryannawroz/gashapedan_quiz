<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class reportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes=Quiz::all();
        return view('reports.report-index',compact('quizzes'));
    }
    public function quizname()
    {
        $quiz = Quiz::where('title', request('quiz'))->first();

        $results = QuizAttempt::where('quiz_id','=',$quiz->id)->orderByDesc('score')->paginate(200);

        foreach ($results as $value) {
            $rank = 1;
            foreach ($results as $othervalue) {
                if ($value->quiz_id == $othervalue->quiz_id & $value->score < $othervalue->score) {
                    $rank++;
                }
                $value->rank = $rank;
            }
        }
        return view('result.index_result', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
