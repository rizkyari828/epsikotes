<?php

namespace App\Http\Controllers\Norma;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Categories;
use App\Model\Norma;



class NormaPage extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {

        return view('pages.NormaPageInquiry');
    }

    public function categories(){

        $this->middleware('auth');

        $subCategoryName = \Request::input('categoryName');
        $Categories = new Categories();
        $records = array();


        foreach ($Categories->getallCategory2($subCategoryName) as $indexCategory => $rowCategory ){
            $records['data_rows'][] = array('catagoryName'=>$rowCategory->category_name,'categoryId' => $rowCategory->category_id  );


        }

        echo json_encode($records);
    }

    public function allCategories(){

        // $this->middleware('auth');

        $paramFilters = \Request::input('paramFilters');
        $Norma = new Norma();
        $records = array();

      //  print_r($Categories->getAllNorma($subCategoryName));
       // exit();


        foreach ($Norma->getAllNormaActive($paramFilters) as $indexCategory => $rowCategory ){
            $records['data'][] = array('<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /><span></span></label>','<a href="normaview/'.$rowCategory->NORMA_ID.'">detail</a>',$rowCategory->CATEGORY_NAME,$rowCategory->last_update_date,$rowCategory->last_updated_by );


        }

        echo json_encode($records);
    }


}
