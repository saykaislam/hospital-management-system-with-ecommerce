<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{

    public function doctor(){
        return $this->belongsTo('App\User','answer_user_id');
}
    public function question(){
        return $this->belongsTo('App\Question');
    }
}
