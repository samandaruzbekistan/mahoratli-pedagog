<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DictSectionController extends Controller
{
    public function show($section_id){
        $section = \App\Models\Section::find($section_id);
        $dict_sections = \App\Models\DictSection::where('section_id', $section_id)->get();
        return view('admin.view_dict_sections', ['section' => $section, 'dicts' => $dict_sections]);
    }

    public function new_section(Request $request){
        $request->validate([
            'name' => 'required',
            'section_id' => 'required'
        ]);

        $dict_section = new \App\Models\DictSection();
        $dict_section->name = $request->name;
        $dict_section->section_id = $request->section_id;
        $dict_section->save();

        return redirect()->back()->with('success', 'New dict section added successfully');
    }
}
