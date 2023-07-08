<?php

namespace App\Http\Controllers;


use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = QuizAttempt::latest('quiz_id')->orderByDesc('score')->paginate(30);

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
     * Store a newly created resource in storage.
     */
    public function show(Request $request)
    {

        $searchQuery = request()->input('search');

        $results = QuizAttempt::latest()->select('quiz_attempts.*')
            ->join('quizzes', 'quizzes.id', '=', 'quiz_attempts.quiz_id')
            ->join('users', 'users.id', '=', 'quiz_attempts.user_id')
            ->where(function ($query) use ($searchQuery) {
                $query->where('quizzes.title', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('users.name', 'LIKE', '%' . $searchQuery . '%');
            })
            ->paginate(30)->withQueryString();
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
    public function showUser(Request $request)
    {



        $results = QuizAttempt::latest()
            ->select('quiz_attempts.*')
            ->join('quizzes', 'quizzes.id', '=', 'quiz_attempts.quiz_id')
            ->join('users', 'users.id', '=', 'quiz_attempts.user_id')
            ->where(function ($query)  {
                $query->where('users.id', '=', auth()->user()->id);
            })
            ->paginate(30);

$quizattepts=QuizAttempt::all();
        foreach ($results as $value) {


   $value->rank = QuizAttempt::where("quiz_id","=",$value->quiz_id)->where("score",">",$value->score)->count()+1;

        }

        return view('result.index_result', compact('results'));
    }

    /**
     * Display the specified resource.
     */
    public function store(string $id)
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
