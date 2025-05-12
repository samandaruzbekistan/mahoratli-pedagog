<?php

namespace App\Http\Controllers;

use App\Models\ArticlePdf;
use App\Models\DictSection;
use App\Models\Presentation;
use App\Models\Quiz;
use App\Models\Section;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function view_section($id)
    {
        $section = Section::find($id);
        $article_pdf = ArticlePdf::where('section_id', $id)->get();
        $article_ppt = Presentation::where('section_id', $id)->get();
        $quizzes = Quiz::with('answers')->where('section_id', $id)->get();
        $dict_sections = DictSection::with('dicts')->where('section_id', $id)->get();
//        return $dict_sections;
        return view('user.show_theme', ['dict_sections' => $dict_sections, 'quizzes' => $quizzes, 'theme' => $section, 'article_pdfs' => $article_pdf, 'article_ppts' => $article_ppt]);
    }

    public function check(Request $request){
        $correct = 0;
        $incorrect = 0;
        $r = [];
        for ($x = 1; $x <= $request->quiz_count; $x++) {
            $index = 'answer'.$x;
            if (isset($request->$index)){
                if ($request[$index] == '1'){
                    $correct = $correct+1;
                }
                else{
                    $incorrect = $incorrect+1;
                }
            }
        }
        session()->flash('result',1);
        session()->flash('correct',$correct);
        session()->flash('incorrect',$incorrect);
        return back();
    }
}
