<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //    Auth admin
    public function auth(Request $request){
        $request->validate([
            'username' => "required|string",
            'password' => "required|string",
        ]);
        $admin = Admin::where('username', $request->username)->first();
        if (!empty($admin)){
            if (Hash::check($request->password, $admin->password)){
                session()->put('admin',1);
                session()->put('id',$admin->id);
                session()->put('fullname',$admin->fullname);
                return redirect()->route('admin.profile');
            }
            else{
                return back()->with("login_error",1);
            }
        }
        else{
            return back()->with("login_error",1);
        }
    }

    public function logout(){
        session()->flush();
        return redirect()->route('admin.login');
    }

    public function update_password(Request $request){
        if ($request->password1 != $request->password2){
            return back()->with('logic_error',1);
        }
        else{
            $admin = Admin::find(session('id'));
            $admin->password = Hash::make($request->password1);
            $admin->save();
            return back()->with('success',1);
        }
    }

    public function all_sections(){
        $sections = Section::all();
        return view('admin.section', ['sections' => $sections]);
    }

    public function section($id){
        $section = Section::find($id);
        return view('admin.section', ['section' => $section]);
    }

    public function add_section(Request $request){
        $request->validate([
            'name' => 'required|string',
        ]);
        $section = new Section();
        $section->name = $request->name;
        $section->description = $request->description;

        $file = $request->img;
        $fileName = $request->file('img')->getClientOriginalExtension();
        $new_name = time().$fileName;
        $dir = "topic/";
        $file->move($dir, $new_name);
        $section->save();
        return back()->with('success',1);
    }
}
