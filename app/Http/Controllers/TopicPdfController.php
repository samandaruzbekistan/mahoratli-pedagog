<?php

namespace App\Http\Controllers;

use App\Models\ArticlePdf;
use App\Models\Section;
use Illuminate\Http\Request;

class TopicPdfController extends Controller
{
    public function new_topic(Request $request){
        $request->validate([
            'pdf' => 'required|file',
            'section_id' => 'required|numeric',
        ]);
        $pdf_extension = $request->file('pdf')->extension();
        $name = md5(microtime());
        $pdf_name = $name.".".$pdf_extension;
        $path = $request->file('pdf')->move('pdf/',$pdf_name);
        $dict = new ArticlePdf();
        $dict->pdf = $pdf_name;
        $dict->section_id = $request->section_id;
        $dict->save();
        return back()->with('success',1);
    }

    public function show_theme_topics($section_id){
        $theme = Section::find($section_id);
        $dicts = ArticlePdf::where('section_id', $section_id)->get();
        return view('admin.view_section_topics', ['theme' => $theme,'pdfs' => $dicts, 'section_id' => $section_id]);
    }

    public function delete_topic($id){
        $pdf = ArticlePdf::where('id', $id)->first();
        unlink('pdf/'.$pdf->pdf);
        ArticlePdf::where('id', $id)->delete();
        return back()->with('delete',1);
    }
}
