<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\Section;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function new_topic(Request $request){
        $request->validate([
            'pdf' => 'required|file',
            'section_id' => 'required|numeric',
        ]);
        $pdf_extension = $request->file('pdf')->extension();
        $name = md5(microtime());
        $pdf_name = $name.".".$pdf_extension;
        $path = $request->file('pdf')->move('presentation/',$pdf_name);
        $dict = new Presentation();
        $dict->presentation = $pdf_name;
        $dict->section_id = $request->section_id;
        $dict->save();
        return back()->with('success',1);
    }

    public function show_theme_topics($section_id){
        $theme = Section::find($section_id);
        $dicts = Presentation::where('section_id', $section_id)->get();
        return view('admin.view_section_presentations', ['theme' => $theme,'pdfs' => $dicts, 'section_id' => $section_id]);
    }

    public function delete_topic($id){
        $pdf = Presentation::where('id', $id)->first();
        unlink('presentation/'.$pdf->pdf);
        Presentation::where('id', $id)->delete();
        return back()->with('delete',1);
    }
}
