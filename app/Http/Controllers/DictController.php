<?php

namespace App\Http\Controllers;

use App\Models\Dict;
use App\Models\DictSection;
use App\Models\Section;
use Illuminate\Http\Request;

class DictController extends Controller
{
    public function new_dict(Request $request){
        $request->validate([
            'english' => 'required|string',
            'uzbek' => 'required|string',
            'dict_section_id' => 'required|numeric',
        ]);
        $dict = new Dict;
        $dict->english = $request->english;
        $dict->uzbek = $request->uzbek;
        $dict->dict_section_id = $request->dict_section_id;
        $dict->save();
        return back()->with('success',1);
    }

    public function show_section_dicts($section_id){
        $section = DictSection::find($section_id);
        $dicts = Dict::where('dict_section_id', $section_id)->get();
        return view('admin.view_section_dicts', ['section' => $section,'dicts' => $dicts, 'section_id' => $section_id]);
    }

    public function delete_dict($dict_id){
        Dict::where('id', $dict_id)->delete();
        return back()->with('delete',1);
    }
}
