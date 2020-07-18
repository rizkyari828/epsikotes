<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsiSubCategoryVersion extends Model
{

    protected $table = "que_sub_category_versions";

    protected $primaryKey = "VERSION_ID";

    const CREATED_AT = "CREATION_DATE";

    const UPDATED_AT = "LAST_UPDATE_DATE";

    public function subCategory()
    {
        return $this->belongsTo(PsiSubCategory::class, 'SUB_CATEGORY_ID', 'SUB_CATEGORY_ID');
    }

}
