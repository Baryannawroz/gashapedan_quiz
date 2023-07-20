<?php

namespace App\Http\Controllers;

use Attribute;
use Carbon\Carbon;
use App\Models\Quiz;

use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use App\Models\QuizAttempt;
use GuzzleHttp\Psr7\Request;
use App\Models\StudentAnswer;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function activateUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['type' => 1]);
        return redirect()->back();
    }
    public function update()
    {
        $request = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'id' => 'required',
        ]);

        $quiz = Quiz::find($request['id']);
        $quiz->title = $request['title'];
        $quiz->description = $request['description'];
        $quiz->starts_at = $request['start_time'];
        $quiz->ends_at = $request['end_time'];

        $quiz->save();
        return redirect("quizzes/check");
    }



    public function permition()
    {
        $users = User::where('type', 0)->get();
        return view("permition", ['users' => $users]);
    }



    public function index()
    {

        $quiz = Quiz::where(function ($query) {
            $query->where('attempts_allowed', 1);
            $query->orWhere(function ($query) {
                $query->where('ends_at', '>=', Carbon::now()->addHours(3));
                // ->where('starts_at', '<=', Carbon::now()->addHours(3))
            });
        })->whereNotIn('id', function ($query) {
            $query->select('quiz_id')
                ->from('quiz_attempts')
                ->where('user_id', auth()->user()->id);
        })->orderByDesc('created_at')
            ->get();
foreach ($quiz as $q) {

    $endTime = Carbon::parse($q['starts_at']);
    $currentTime = Carbon::now()->addHours(3);
    $remainTime = $endTime->diffInSeconds($currentTime);

        // Make $remainTime negative if the quiz has ended
        if ($endTime < $currentTime) {
            $remainTime = -$remainTime;

        }
        $q['remainTime']=$remainTime;
    }






        return view('quizzes.quizzes', compact('quiz'));
    }
    public function edit(Quiz $quiz)
    {

        if (Auth()->user()->type) {
            return view("quizzes.edit_quiz", compact('quiz'));
        }
    }
    public function show(Quiz $quiz)
    {



        if (auth()->user()->type) {
            return view('quizzes.edit_question', compact('quiz'));
        }
        $endTime = Carbon::parse($quiz['ends_at']);
        $currentTime = Carbon::now()->addHours(3);
        $remainTime = $endTime->diffInSeconds($currentTime);

        // Make $remainTime negative if the quiz has ended
        if ($endTime < $currentTime) {
            $remainTime = -$remainTime;
        }
        if ($quiz['attempts_allowed'] || ($remainTime > 0 && $currentTime > Carbon::parse($quiz['starts_at'])) ) {

            $quiz->questions = $quiz->questions->shuffle();
            return view('quizzes.show_quiz', compact('quiz', 'remainTime'));
        } else
            return redirect('dashboard');
    }

    public function check()
    {
        $user = Auth::user();
        $quiz = Quiz::where('user_id', "$user->id")->get();



        return view('quizzes.quizzes', compact('quiz'));
    }



    public function stdAnswer()
    {
        $attributes = request();

        $count = QuizAttempt::where('quiz_id', $attributes["quiz_id"])
            ->where('user_id', Auth()->user()->id)
            ->count();
        if ($count == 0) {

            $studentAttempt = new QuizAttempt;

            $len =  (count($attributes->request));
            $scour = 0;

            $quiz_id = $attributes["quiz_id"];
            $quiz = Quiz::find($quiz_id);
            $questionCount = $quiz->questions()->count();


            $user_id = $attributes["auth"];

            $studentAttempt->quiz_id = $quiz_id;
            $studentAttempt->user_id = $user_id;
            $studentAttempt->score = 0;
            $studentAttempt->started_at = '2022-01-01 09:00:00';
            $studentAttempt->ended_at = '2022-01-01 09:30:00';
            $studentAttempt->save();


            for ($i = 0; $i < $len - 3; $i++) {



                $record = Answer::find($attributes["A" . $i]);

                if ($record->is_correct) {
                    $scour++;
                }
                $studentAnswer = new StudentAnswer;
                $studentAnswer->quiz_attempt_id = $studentAttempt->id;
                $studentAnswer->question_id = $record->question_id;
                $studentAnswer->answer_id = $record->id;
                $studentAnswer->user_id = $user_id;
                $studentAnswer->save();
            }

            if ($scour > 0) {

                $change = QuizAttempt::where('id', $studentAttempt->id)->first();


                $change->score = $scour;
                $change->save();
            }
        }

        return redirect("/dashboard");
    }

    public function create()
    {
        if (Auth()->user()->type) {
            return view("quizzes.create_quiz");
        } else {
            echo "sorry you are not teacher";
            echo   '<br> <a href="/dashboard">home</a>';
        }
    }
    public function store()
    {
        $request = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        $quiz = new Quiz;
        $quiz->user_id = auth()->user()->id;
        $quiz->title = $request['title'];
        $quiz->description = $request['description'];
        $quiz->time_limit = 1;
        $quiz->attempts_allowed = 0;

        $quiz->starts_at = $request['start_time'];
        $quiz->ends_at = $request['end_time'];
        $quiz->save();

        return redirect("create/question");
    }
    public function deactivate($id)
    {
        $user = Quiz::find($id);
        $user->attempts_allowed = 0;
        $user->save();
        return back();
    }
    public function activate($id)
    {
        $user = Quiz::find($id);
        $user->attempts_allowed = 1;
        $user->save();
        return back();
    }
}
