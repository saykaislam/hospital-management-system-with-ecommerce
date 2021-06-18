<?php

namespace App\Http\Controllers\Admin;

use App\DoctorSpeciality;
use App\Http\Controllers\Controller;
use App\RelatedQuestion;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RelatedQuestionController extends Controller
{
    public function index()
    {
        $relatedQuestions = RelatedQuestion::latest()->get();
        return view('backend.admin.related_question.index',compact('relatedQuestions'));
    }


    public function create()
    {
        $doctorSpecialities = DoctorSpeciality::all();
        return view('backend.admin.related_question.create', compact('doctorSpecialities'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'doctor_speciality_id' => 'required'
        ]);
        $related_question = new RelatedQuestion();
        $related_question->doctor_speciality_id = $request->doctor_speciality_id;
        $related_question->search_title = $request->search_title;
        $related_question->question = $request->question;
        $related_question->save();
        Toastr::success('Related Question Created Successfully','Success');
        return  redirect()->route("admin.relatedQuestions.index");
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $doctorSpecialities = DoctorSpeciality::all();
        $relatedQuestion = RelatedQuestion::find($id);
        return view('backend.admin.related_question.edit',compact('relatedQuestion','doctorSpecialities'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'doctor_speciality_id' => 'required'
        ]);
        $related_question = RelatedQuestion::find($id);
        $related_question->doctor_speciality_id = $request->doctor_speciality_id;
        $related_question->search_title = $request->search_title;
        $related_question->question = $request->question;
        $related_question->save();
        Toastr::success('Related Question Updated Successfully','Success');
        return  redirect()->route("admin.relatedQuestions.index");
    }


    public function destroy($id)
    {
        RelatedQuestion::destroy($id);
        Toastr::success('Related Question Deleted Successfully','Success');
        return  redirect()->route("admin.relatedQuestions.index");
    }
}
