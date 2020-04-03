<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->SUB_CATEGORY_ID,
            'subCategoryName' => $this->SUB_CATEGORY_NAME,
            'totalExample'=>$this->TOTAL_EXAMPLE,
            'totalQueActive'=>$this->TOTAL_QUE_ACTIVE,
            'totalDuration'=>$this->TOTAL_DURATION,
            'isRandomQuestion'=>$this->IS_RANDOM_QUE,
            'createBy' => $this->CREATED_BY,
            'creationDate' => $this->CREATION_DATE,
            'lastUpdatedBy' => $this->LAST_UPDATED_BY,
            'lastUpdatedDate' => $this->LAST_UPDATE_DATE
        ];
    }
}
