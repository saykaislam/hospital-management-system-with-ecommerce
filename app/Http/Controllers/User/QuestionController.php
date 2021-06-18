<?php

namespace App\Http\Controllers\User;

use App\Order;
use App\OrderServiceDetail;
use App\Question;
use App\ServiceProviderReview;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function question(){
        //$question = Question::where('question_user_id',Auth::user()->id)
        //->orderBy('id','desc')
        //->get();

        $question = DB::table('questions')
            ->leftJoin('question_answers','questions.id','=','question_answers.question_id')
            ->leftJoin('users','users.id','=','question_answers.answer_doctor_user_id')
            ->where('question_user_id',Auth::user()->id)
            ->select('questions.*','question_answers.answer_doctor_user_id','question_answers.answer','question_answers.date','question_answers.answer_by','users.name')
            ->orderBy('questions.id','desc')
            ->get();

        return view('backend.user.question.question_answer',compact('question'));
    }
}
