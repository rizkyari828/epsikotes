<?php

namespace App\Http\Controllers\Questionmanagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Categories;
use App\Model\Norma;
use App\Model\SubCategory;




class CategoryPage extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        
        return view('pages.CategoryPageInquiry');
    }

    public function subCategories(){

        $this->middleware('auth');

        $subCategoryName = \Request::input('subCategoryName');
        $SubCategory = new SubCategory();
        $records = array();


        foreach ($SubCategory->getSubCategory($subCategoryName) as $indexCategory => $rowCategory ){
            $records['data_rows'][] = array('subCatagoryName'=>$rowCategory->sub_category_name,'subCategoryId' => $rowCategory->sub_category_id  );


        }

        echo json_encode($records);
    }

    public function allCategories(){

        $this->middleware('auth');

        $paramFilters = \Request::input('paramFilters');
        $Categories = new Categories();
        $records = array();

      //  print_r($Categories->getAllNorma($subCategoryName));
       // exit();


        foreach ($Categories->getAllCategory($paramFilters) as $indexCategory => $rowCategory ){
            $records['data'][] = array('<a class="categoryview" href="categoryview/'.$rowCategory->category_id.'">detail</a>',$rowCategory->category_name,$rowCategory->total_sub_category,$rowCategory->RANDOM_SUB_CATEGORY == 1 ? 'Yes' : 'No',$rowCategory->GET_ONE_SUB_CATEGORY == 1 ? 'Yes' : 'No',$rowCategory->last_update_date,$rowCategory->last_updated_by );


        }

        echo json_encode($records);
    }


}
