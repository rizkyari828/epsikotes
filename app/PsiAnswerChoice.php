<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsiAnswerChoice extends Model
{

    protected $table = "que_ans_choices";

    protected $primaryKey = "ANS_CHOICE_ID";

    public $timestamps = false;

    public function question()
    {
        return $this->belongsTo(PsiQuestion::class, 'QUESTION_ID', 'QUESTION_ID');
    }

}
