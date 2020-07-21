<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsiAnswerTextSeries extends Model
{

    protected $table = "que_ans_text_series";

    protected $primaryKey = "ANS_TEXT_SERIES_ID";

    public $timestamps = false;

    public function question()
    {
        return $this->belongsTo(PsiQuestion::class, 'QUESTION_ID', 'QUESTION_ID');
    }

}
