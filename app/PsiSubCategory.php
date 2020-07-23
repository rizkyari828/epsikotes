<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsiSubCategory extends Model
{

    protected $table = "que_sub_categories";

    protected $primaryKey = "SUB_CATEGORY_ID";

    const CREATED_AT = "CREATION_DATE";

    const UPDATED_AT = "LAST_UPDATE_DATE";

    protected $guarded = [];

    public function versions()
    {
        return $this->hasMany(PsiSubCategoryVersion::class, 'SUB_CATEGORY_ID', 'SUB_CATEGORY_ID');
    }

}
