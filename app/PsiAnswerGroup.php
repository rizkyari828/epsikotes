<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsiAnswerGroup extends Model
{

    protected $table = "que_ans_group";

    protected $primaryKey = "QUE_ANS_GROUP_ID";

    public $timestamps = false;

    public function question()
    {
        return $this->belongsTo(PsiQuestion::class, 'QUESTION_ID', 'QUESTION_ID');
    }

}
