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

}
