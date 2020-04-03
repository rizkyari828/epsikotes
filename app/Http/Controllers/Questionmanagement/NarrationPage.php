<?php

namespace App\Http\Controllers\Questionmanagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Categories;
use App\Model\Norma;
use App\Model\Narrations;




class NarrationPage extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        
        return view('pages.NarrationInquiryPage');
    }

    public function getNameNarration(){
        $this->middleware('auth');

        $paramFilters = \Request::input('paramFilters');
        $narrations = new Narrations();
        $records = array();
        
        foreach ($narrations->getNarrations($paramFilters) as $indexNarration => $rowNarration ){
            $records['data'][] = array('<a href="narrationView/'.$rowNarration->narration_id.'">detail</a>',$rowNarration->narration_name,$rowNarration->last_update_date,$rowNarration->last_updated_by );


        }

        echo json_encode($records);
    }

    public function categories(){

        $this->middleware('auth');

        $subCategoryName = \Request::input('categoryName');
        $Categories = new Categories();
        $records = array();


        foreach ($Categories->getCategory($subCategoryName) as $indexCategory => $rowCategory ){
            $records['data_rows'][] = array('catagoryName'=>$rowCategory->category_name,'categoryId' => $rowCategory->category_id  );


        }

        echo json_encode($records);
    }

    public function allCategories(){

        $this->middleware('auth');

        $subCategoryName = \Request::input('categoryName');
        $Categories = new Norma();
        $records = array();

      //  print_r($Categories->getAllNorma($subCategoryName));
       // exit();


        foreach ($Categories->getAllNormaActive($subCategoryName) as $indexCategory => $rowCategory ){
            $records['data'][] = array('<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /><span></span></label>','<a href="#normaview/'.$rowCategory->NORMA_ID.'">detail</a>',$rowCategory->CATEGORY_NAME,$rowCategory->last_update_date,$rowCategory->last_updated_by );


        }

        echo json_encode($records);
    }


}
