<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsiNarration extends Model
{

    protected $table = "que_narrations";

    protected $primaryKey = "NARRATION_ID";

    const CREATED_AT = "CREATION_DATE";

    const UPDATED_AT = "LAST_UPDATE_DATE";

}
