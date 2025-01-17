<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsiSubCategoryVersion extends Model
{

    protected $table = "que_sub_category_versions";

    protected $primaryKey = "VERSION_ID";

    const CREATED_AT = "CREATION_DATE";

    const UPDATED_AT = "LAST_UPDATE_DATE";

    protected $guarded = [];

    public function subCategory()
    {
        return $this->belongsTo(PsiSubCategory::class, 'SUB_CATEGORY_ID', 'SUB_CATEGORY_ID');
    }

    public function questions()
    {
        return $this->hasMany(PsiQuestion::class, 'VERSION_ID', 'VERSION_ID')->orderBy('QUESTION_SEQUENCE', 'ASC');
    }

}
