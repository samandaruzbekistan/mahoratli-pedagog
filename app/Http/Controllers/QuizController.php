<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\Section;
use App\Models\Test;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function add_quiz(Request $request){
        $request->validate([
            'quiz' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'answer_a' => 'required|string',
            'answer_b' => 'required|string',
            'answer_c' => 'required|string',
            'answer_d' => 'nullable|string',
            'section_id' => 'required|numeric',
        ]);

        $quiz = new Quiz;
        $quiz->quiz = $request->quiz;
        $quiz->section_id = $request->section_id;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('img/quiz', $imageName);
            $quiz->photo = $imageName;
        }

        $quiz->save();

        $saved_id = $quiz->id;

        $this->add_answer($request->answer_a, $saved_id, 1);
        $this->add_answer($request->answer_b, $saved_id, 0);
        $this->add_answer($request->answer_c, $saved_id, 0);

        if ($request->answer_d) {
            $this->add_answer($request->answer_d, $saved_id, 0);
        }

        return back()->with('success', 1);
    }

    protected function add_answer($answerText, $quiz_id, $is_correct){
        $answer = new Answer;
        $answer->answer = $answerText;
        $answer->quiz_id = $quiz_id;
        $answer->is_correct = $is_correct;
        $answer->save();
    }

    public function show_quizzes($test_id){
        $theme = Section::find($test_id);
        $quizzes = Quiz::with('answers')->where('section_id', $test_id)->get();
//        return $quizzes;
        return view('admin.view_theme_quizzes', ['section' => $theme,'quizzes' => $quizzes, 'section_id' => $test_id]);
    }

    public function delete_quiz($quiz_id){
        Answer::where('quiz_id', $quiz_id)->delete();
        Quiz::where('id', $quiz_id)->delete();
        return back()->with('delete',1);
    }

}
