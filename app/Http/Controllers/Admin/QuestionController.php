<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
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
            ->LeftJoin('question_answers','questions.id','=','question_answers.question_id')
            ->select('questions.*','question_answers.id as question_answer_id')
            ->latest()
            ->get();

        return view('backend.admin.question.index', compact('questions'));
    }

    public function questionStatus(Request $request){
        $question = Question::find($request->question_id);
        $question->status = $request->status;
        $question->save();

        Toastr::success('User Question Status Successfully Updated', 'Success');
        return redirect()->back();
    }

    public function questionAnswerForm($id){
        $question = Question::find($id);
        $doctor_users = User::where('role_id',2)->get();

        return view('backend.admin.question.question_answer_form', compact('question','doctor_users'));
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
        return redirect()->route('admin.users.question.answer.details',$insert_id);
    }

    public function questionAnswerUpdateForm($id){
        $questionAnswer = QuestionAnswer::find($id);
        $doctor_users = User::where('role_id',2)->get();

        return view('backend.admin.question.question_answer_update_form', compact('questionAnswer','doctor_users'));
    }

    public function questionAnswerUpdate(Request $request){
        $answer_by = Auth::user()->role_id == 1 ? 'Admin' : 'Doctor';

        $question_answer = QuestionAnswer::find($request->question_answer_id);
        $question_answer->answer_doctor_user_id = $request->answer_doctor_user_id;
        $question_answer->answer = $request->answer;
        $question_answer->answer_by = $answer_by;
        $question_answer->save();

        Toastr::success('Question Answer Successfully Done', 'Success');
        return redirect()->route('admin.users.question.answer.details',$request->question_answer_id);
    }

    public function questionAnswerDetails($id){
        $question = Question::find($id);
        $answer_doctor_user_id = Auth::user()->id;
        $questionAnswer = QuestionAnswer::where('question_id',$id)->first();

        return view('backend.admin.question.question_answer_details', compact('question','answer_doctor_user_id','questionAnswer'));
    }
}
