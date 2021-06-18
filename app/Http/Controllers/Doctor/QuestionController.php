<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Question;
use App\QuestionAnswer;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index(){
        $questions = DB::table('questions')
            ->join('doctors','questions.doctor_speciality_id','=','doctors.doctor_speciality_id')
            ->join('users','doctors.user_id','=','users.id')
            ->LeftJoin('question_answers','questions.id','=','question_answers.question_id')
            ->where('users.id', Auth::user()->id)
            ->where('questions.status',1)
            ->select('questions.*','question_answers.id as question_answer_id')
            ->get();

        return view('backend.doctor.question.index', compact('questions'));
    }

    public function questionAnswerForm($id){
        $question = Question::find($id);
        $answer_user_id = Auth::user()->id;

        return view('backend.doctor.question.question_answer_form', compact('question','answer_user_id'));
    }

    public function questionAnswerStore(Request $request){
        $answer_by = Auth::user()->role_id == 1 ? 'Admin' : 'Doctor';

        $question_answer = new QuestionAnswer();
        $question_answer->question_id = $request->question_id;
        $question_answer->answer_doctor_user_id = $request->answer_doctor_user_id;
        $question_answer->answer = $request->answer;
        $question_answer->date = date('Y-m-d');
        $question_answer->answer_by = $answer_by;
        $question_answer->save();
        $insert_id = $question_answer->id;

        Toastr::success('Question Answer Successfully Done', 'Success');
        return redirect()->route('doctor.users.question.answer.details',$insert_id);
    }

    public function questionAnswerUpdateForm($id){
        $questionAnswer = QuestionAnswer::find($id);
        $answer_doctor_user_id = Auth::user()->id;

        return view('backend.doctor.question.question_answer_update_form', compact('questionAnswer','answer_doctor_user_id'));
    }

    public function questionAnswerUpdate(Request $request){
        $answer_by = Auth::user()->role_id == 1 ? 'Admin' : 'Doctor';

        $question_answer = QuestionAnswer::find($request->question_answer_id);
        $question_answer->answer_doctor_user_id = Auth::user()->id;
        $question_answer->answer = $request->answer;
        $question_answer->answer_by = $answer_by;
        $question_answer->save();

        Toastr::success('Question Answer Successfully Done', 'Success');
        return redirect()->route('doctor.users.question.answer.details',$request->question_answer_id);
    }

    public function questionAnswerDetails($id){
        $question = Question::find($id);
        $answer_user_id = Auth::user()->id;
        $questionAnswer = QuestionAnswer::where('question_id',$id)->first();

        return view('backend.doctor.question.question_answer_details', compact('question','answer_user_id','questionAnswer'));
    }
}
