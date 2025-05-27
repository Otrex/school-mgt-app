<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use App\Models\User;
use App\Models\Answer;
use Livewire\Component;
use App\Models\Question;
use Livewire\WithPagination;
use App\Models\OptionQuestion;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class Questionaire extends Component
{
    use WithPagination;

    public $exam;

    public $auth_user;

    public $answer;

    protected $listeners = ['submitAnswers'];

    public function getQueryString()
    {
        return [];
    }

    public function saveAnswer($question_id, $option_question_id, $answer)
    {
        $this->auth_user->answers()->create([
            'exam_id' => $this->exam->id,
            'question_id' => $question_id,
            'option_question_id' =>$option_question_id,
            'answer' => $answer
        ]);
    }

    public function updateAnswer($question_id, $option_question_id, $answer)
    {
        $this->auth_user->answers()->where([
                'exam_id' => $this->exam->id,
                'question_id' => $question_id,
                'option_question_id' => $option_question_id
            ])
            ->update(['answer' => $answer]);
    }

    public function saveResult()
    {
        $score = 0;

        $answers = $this->auth_user->answers()
            ->where(['exam_id' => $this->exam->id, 'is_final' => true])
            ->get();

        foreach ($answers as $answer) {
            $correct_option = $answer->question->option_questions()->where(['is_correct' => true ])->first();
            if ($correct_option->id == $answer->option_question_id) {
                $score += 1;
            }
        }

        $this->auth_user->examResults()->create([
            'exam_id' => $this->exam->id,
            'score' => $score,
        ]);
    }

    public function submitAnswers()
    {
        // Submit answers when user click the 'submit' button
        if ($this->auth_user->answers()->where(['exam_id' => $this->exam->id])->count() > 0) {

            $this->auth_user->answers()
                ->where(['exam_id' => $this->exam->id])
                ->update(['is_final' => true]);

            session()->forget(['exam_id', 'take_test']);
        } else {
            // Submit answers automatically when the timer count down
            $questions = $this->exam->questions;

            foreach ($questions as $question) {
                $this->auth_user->answers()->create([
                    'exam_id' => $this->exam->id,
                    'question_id' => $question->id,
                    'option_question_id' => null,
                    'answer' => '',
                    'is_final' => true
                ]);
            }

            session()->forget(['exam_id', 'take_test']);
        }

        // create a record to show that a user has taken the exam
        $this->auth_user->attempts()->create(['exam_id' => $this->exam->id]);

        // calculate and save result
        $this->saveResult();

        return redirect()->route('exam.question.submitted');
    }

    public function isSelected($question_id, $option_question_id)
    {
        $result = $this->auth_user->answers()->where([
            'exam_id' => $this->exam->id,
            'question_id' => $question_id,
            'option_question_id' => $option_question_id
        ])
        ->first();

        $status = is_null($result) ? false : ($result->option_question_id == $option_question_id);

        return $status;
    }

    public function isAnswerAvailable($question_id)
    {
        $status = $this->auth_user->answers()->where([
            'exam_id' => $this->exam->id,
            'question_id' => $question_id
        ])->first();
        return !is_null($status);
    }

    public function paginate($items, $perPage = 1, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function render()
    {
        $this->exam = Exam::find(session()->get('exam_id'));

        $questions_count = $this->exam->questions->count();

        // if(empty(session('exam_questions'))){
        //     session()->put('exam_questions', $this->exam->questions()->inRandomOrder()->get());
        // }

        // $questions = $this->paginate(session('exam_questions'));

        // session()->forget('exam_questions');

        if (empty(session('exam_questions'))) {
            $get_question_by_lesson = $this->exam->questions->groupBy('course_series_id')->shuffle()->all();

            $final_selected_question = collect();

            foreach ($get_question_by_lesson as $question_by_lessons) {
                $selected_questions = $question_by_lessons->take(3);
                foreach ($selected_questions as $selected_question_key => $selected_question_value) {
                    $final_selected_question[] = $selected_question_value;
                }
            }

            session()->put('exam_questions', $final_selected_question->shuffle()->all());
        }

        $questions = $this->paginate(session('exam_questions'));

        if (Auth::check())
            $this->auth_user = Auth::user();

        if (Auth::guard('community')->check())
            $this->auth_user = Auth::guard('community')->user();

        $time_duration = collect(session('exam_questions'))->sum('question_duration');

        $option_tag = ['A', 'B', 'C', 'D'];

        title('Program Acccessment Test');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.questionaire', compact('questions', 'questions_count', 'time_duration', 'option_tag'))
            ->extends('layouts.question')
            ->section('content');
    }
}
