<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsiQuestion extends Model
{

    protected $table = "que_questions";

    protected $primaryKey = "QUESTION_ID";

    public $timestamps = false;

    protected $guarded = [];

    public function subCategoryVersion()
    {
        return $this->belongsTo(PsiSubCategoryVersion::class, 'VERSION_ID', 'VERSION_ID');
    }

    public function answerChoices()
    {
        return $this->hasMany(PsiAnswerChoice::class, 'QUESTION_ID', 'QUESTION_ID');
    }

    public function answerGroups()
    {
        return $this->hasMany(PsiAnswerGroup::class, 'QUESTION_ID', 'QUESTION_ID');
    }

    public function answerTextSeries()
    {
        return $this->hasMany(PsiAnswerTextSeries::class, 'QUESTION_ID', 'QUESTION_ID');
    }

}
