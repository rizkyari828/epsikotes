<?php

namespace App\Http\Controllers\Peopleentermaintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Model\Menus;
use App\Model\Role;
use App\Model\PersonalInformations;
use Carbon\Carbon;
use DB;


class PeopleentermaintenancePageAdd extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request,$personId = 0,$action='',$menuType='')
    {   
        $valeInput = array();
        $tempAllMenu = $this->getMenu();
        
        $isReadOnly = '';
        $isDisable = '';
        $page = '';
        $disableState = '';
        $isDisableByRole = '';
        $roleType  = $request->session()->get('user.roleType');


        if(!$personId){
            $disableState = '';
			$isDisableUsername = '';
            $valeInput['PERSON_ID'] = '';
            $valeInput['USER_NUMBER'] = '';
            $valeInput['IS_ACTIVE'] = 'checked';
            $valeInput['FULL_NAME'] = '';
            $valeInput['PASSWORD'] = '';
            $valeInput['CONFIRM_PASSWORD'] = '';
            $valeInput['ROLE'] = '';
            $valeInput['ROLE_ID'] = '';
            $valeInput['YEAR_BIRTH_DATE'] = '';
            $valeInput['MONTH_BIRTH_DATE'] = '';
            $valeInput['BIRTH_DATE'] = '';
            $valeInput['GENDER_MALE'] = '';
            $valeInput['GENDER_FEMALE'] = '';
            $valeInput['EMAIL'] = '';
            $valeInput['PHONE_NUMBER'] = '';
            if($roleType === 'VIEW_ALL_NETWORK'){
                $isDisableByRole = '';
               
                $valeInput['NETWORK'] = '';
                $valeInput['NETWORK_ID'] = '';
            }else if($roleType === 'VIEW_BY_NETWORK'){
                $isDisableByRole = 'readonly';
                $valeInput['NETWORK'] = $request->session()->get('user.network');
                $valeInput['NETWORK_ID'] = $request->session()->get('user.networkId');
            }
            $menuType  ='VIEW_ALL';
            $page = 'Add';
        }else if($action == 'view'){
            $disableState = 'state-disabled';
            $page = 'View';
            $isReadOnly = 'readonly';
			$isDisableUsername = 'disabled';
            $isDisable = 'disabled';
            $paramPeopleEnter = array(
                'valueInput' => $valeInput,
                'personId' => $personId
            );
            $valeInput = $this->getValuePeopleEnter($personId);
        }else{
            $disableState = '';
			$isDisableUsername = 'disabled';
            $page = 'Edit';
            $paramPeopleEnter = array(
                'valueInput' => $valeInput,
                'personId' => $personId
            );
            if($roleType === 'VIEW_ALL_NETWORK'){
                $isDisableByRole = '';
            }else if($roleType === 'VIEW_BY_NETWORK'){
                $isDisableByRole = 'disabled';
            }
            $valeInput = $this->getValuePeopleEnter($personId);

        }
        if($menuType === 'VIEW_ALL'){
            $page_nav = $this->createTree($tempAllMenu, null,0,$personId,$isDisable);
            $linkBack = 'peopleenter';
        }else{
            $page_nav = '';
            $linkBack = 'personelinformations';
        }
        $param = array('isDisableUsername'=>$isDisableUsername,'isDisableByRoles'=> $isDisableByRole,'navigationForm'=>$page_nav,'valeInput' => $valeInput,'isReadOnly'=>$isReadOnly,'linkBack'=>$linkBack,'isDisable'=>$isDisable,'page'=>$page,'disableState'=>$disableState);
        return view('pages.PeopleEnterMaintenanceAdd',$param);
    }

    public function resetPasswordPeople(Request $request){

        $roleType  = $request->session()->get('user.roleType');
        $paramFilter = array();

        if($roleType === 'VIEW_BY_NETWORK'){
            $paramFilter['networkId'] = $request->session()->get('user.cabangId');
        }


        $valeInput = $this->getPasswordPeople($paramFilter);

        $param = array('valeInput' => $valeInput);
        return view('pages.PeopleEnterMaintenanceResetPassword',$param);
       
    }

    public function findPasswordPeople(){

        $paramFilter['personId'] = \Request::input('personId');


        $valeInput = $this->getPasswordPeople($paramFilter);

        $records = array();

        foreach ($valeInput as $key => $value) {
            # code..
            $records['data_rows'][] = array('personId'=>$value['PERSON_ID'],'birthDate'=>$value['BIRTH_DATE'],'userName'=>$value['USER_NUMBER'],'fullName'=>$value['FULL_NAME'] );
        }

        echo json_encode($records);

        //$param = array('valeInput' => $valeInput);
        //return view('pages.PeopleEnterMaintenanceResetPassword',$param);
       
    }

    public function getValuePeopleEnter($personId){

        $paramFilter['personId'] = $personId;
		        $paramFilter['isFirstPage'] = 0;

        $PersonalInformations = new PersonalInformations();
        $valeInput = array();
        foreach ($PersonalInformations->getPersonalInformations($paramFilter) as $indexPersonelInformations => $rowPersonelInformations ){



            $years = Carbon::createFromDate(date("Y",strtotime($rowPersonelInformations->BIRTH_DATE)), date("m",strtotime($rowPersonelInformations->BIRTH_DATE)), date("d",strtotime($rowPersonelInformations->BIRTH_DATE)))->diff(Carbon::now())->y; //Carbon::parse($rowPersonelInformations->BIRTH_DATE)->age;

            $month = Carbon::createFromDate(date("Y",strtotime($rowPersonelInformations->BIRTH_DATE)), date("m",strtotime($rowPersonelInformations->BIRTH_DATE)), date("d",strtotime($rowPersonelInformations->BIRTH_DATE)))->diff(Carbon::now())->m;

            $valeInput['PERSON_ID'] = $rowPersonelInformations->PERSON_ID;
            $valeInput['USER_NUMBER'] = $rowPersonelInformations->USER_NUMBER;
            $valeInput['IS_ACTIVE'] = $rowPersonelInformations->IS_ACTIVE == 1 ? 'checked' : '';
            $valeInput['FULL_NAME'] = $rowPersonelInformations->FULL_NAME;
            $valeInput['PASSWORD'] = Crypt::decryptString($rowPersonelInformations->PASSWORD);
            $valeInput['NETWORK'] = $rowPersonelInformations->NETWORK;
            $valeInput['NETWORK_ID'] = $rowPersonelInformations->NETWORK_ID;
            $valeInput['CONFIRM_PASSWORD'] = Crypt::decryptString($rowPersonelInformations->CONFIRM_PASSWORD);
            $valeInput['ROLE'] = $rowPersonelInformations->role_name;
            $valeInput['ROLE_ID'] = $rowPersonelInformations->ROLE_ID;
            $valeInput['BIRTH_DATE'] = date("d-M-Y",strtotime($rowPersonelInformations->BIRTH_DATE));
            $valeInput['YEAR_BIRTH_DATE'] =  $years;
            $valeInput['MONTH_BIRTH_DATE'] =  $month;

            $valeInput['GENDER_MALE'] = $rowPersonelInformations->GENDER == 'MALE' ? 'checked' : '' ;
            $valeInput['GENDER_FEMALE'] = $rowPersonelInformations->GENDER == 'FEMALE' ? 'checked' : '';
            $valeInput['EMAIL'] = $rowPersonelInformations->EMAIL;
            $valeInput['PHONE_NUMBER'] = $rowPersonelInformations->PHONE_NUMBER;

        }

        return $valeInput;

    }

    public function getMenuPeopleEnter($personId = 0){
        $PersonalInformations = new PersonalInformations();
        $eachMenu = array();
        foreach ($PersonalInformations->getEachMenuPersonalEnter($personId) as $indexMenu => $rowMenu ){
            $eachMenu[] = $rowMenu->menu_id;
        }
        return $eachMenu;
    }

    public function getPasswordPeople($paramFilter){

        $PersonalInformations = new PersonalInformations();
        $valeInput = array();
        foreach ($PersonalInformations->getPersonalInformations($paramFilter) as $indexPersonelInformations => $rowPersonelInformations) 
        {
            
          $valeInput[]= array('PERSON_ID'=>$rowPersonelInformations->PERSON_ID,'USER_NUMBER'=>$rowPersonelInformations->USER_NUMBER,'FULL_NAME'=>$rowPersonelInformations->FULL_NAME,'BIRTH_DATE'=>$rowPersonelInformations->BIRTH_DATE);
            

        }

        return $valeInput;

    }

    public function getMenu(){

        $menus = new Menus();
        $allListMenu = array();
        $indexTreeList = 0;
        foreach ($menus->getAllMenu() as $indexMenu => $rowMenu ){
           // $allListMenu[$rowMenu->index_arr]['title'] = $rowMenu->menu_name;
            $allListMenu[$indexTreeList]['parentId'] = $rowMenu->parent;
            $allListMenu[$indexTreeList]['menu'] = $rowMenu->menu;
            $allListMenu[$indexTreeList]['menuId'] = $rowMenu->menu_id;
            $allListMenu[$indexTreeList]['parent'] = $rowMenu->index_parent;
            $allListMenu[$indexTreeList]['child'] = $rowMenu->index_arr;
            $allListMenu[$indexTreeList]['title'] = $rowMenu->menu_name;
            if(isset($rowMenu->index_parent)){
                $allListMenu[$indexTreeList]['url'] = $rowMenu->url_menu;
            }


            $indexTreeList++;
        }

        return $allListMenu;
    }

    public function createTree($elements, $parentId, $index,$personId,$isDisable){


        $branch = array();
        $isCheked = "";
        $classParent = "";

        $tree = "";
        
        if($index == 0){
            $tree .="<div class='tree smart-form'>"; 
            $tree .="<ul>"; 
            $tree .="<li><span><i class='fa fa-lg fa-folder-open'></i> Parent</span> <ul>"; 
        }

        foreach ($elements as $element) {
            if ($element['parent'] == $parentId) {
                $menuPeopleEnter =  $this->getMenuPeopleEnter($personId);
                if(in_array($element['menuId'].$element['parentId'], $menuPeopleEnter)){$isCheked = "checked";}else{$isCheked="";}
                if($personId == null) {if($element['title']=='Dashboard' ||$element['title']=='Personal Information' ){$isCheked = "checked";}else{$isCheked="";}}

                 if ($element['parentId'] == 0) {$classParent = "class='parent-menus'";}else{$classParent = "";}

                $tree .=" <li>
                                                <span><label class='checkbox inline-block'>
                                                                <input ".$classParent." value=".$element['menuId'].$element['parentId']." type='checkbox' name='menu_id[]' ".$isCheked." ".$isDisable.">
                                                                <i></i>".$element['title']."</label></span>
                                                <ul>";

                $children = $this->createTree($elements, $element['child'],1,$personId,$isDisable);
                if ($children) {
                   
                    $element['sub'] = $children;
                    $tree .= $element['sub'];
                }

                $tree .=  "</ul> </li>";
                  
                //unset($element['parent']);
                $branch[$element['child']] = $element;
                unset($branch[$element['child']]['parent']);
                unset($branch[$element['child']]['child']);
                unset($elements[$element['parent']]);

            }
        }
        
        if($index == 0){
            $tree .= "</ul> ";
            $tree .= "</li>";
            $tree .= "</ul> ";
            $tree .= "</div> ";
        }


        return $tree;
    }

    public function roles(){

        $this->middleware('auth');

        $roleName = \Request::input('roleName');
        $roles = new Role();
        $records = array();


        foreach ($roles->getRole($roleName) as $indexRole => $rowRole ){
            $records['data_rows'][] = array('roleId'=>$rowRole->role_id,'roleName'=>$rowRole->role_name );


        }

        echo json_encode($records);
    }

    public function eachMenu(){

        $this->middleware('auth');

        $promptName = \Request::input('promptName');
        $roles = new Menus();
        $records = array();


        foreach ($roles->getEachMenu($promptName) as $indexPrompt => $rowPromt ){
            $records['data_rows'][] = array('menuId'=>$rowPromt->menu_id.$rowPromt->parent,'prompt'=>$rowPromt->menu_name );


        }

        echo json_encode($records);
    }

     public function getFindUserName(){

        $this->middleware('auth');

        $user_number = \Request::input('userNumber');
        
        $PersonalInformations = new PersonalInformations();

        $userNumber = $PersonalInformations->getPersonalInformationsByEmail($user_number);

        

        if(isset($userNumber)){
            $records['data_rows'][] = array('userNumber'=>$userNumber->USER_NUMBER.'-'.$userNumber->FULL_NAME,'personId'=>$userNumber->PERSON_ID );
        }

        echo json_encode($records);
    }

    public function processPeopleEnter(Request $request){

        $peopleEnter = new PersonalInformations();

        $this->middleware('auth');
        $param = $request->all();

        $roleType  = $request->session()->get('user.roleType');

 

		if(!isset($param['PERSON_ID'])){
            $paramInsert['USER_NUMBER'] = strtoupper($param['USER_NUMBER']);
		}
        $paramInsert['FULL_NAME'] = strtoupper($param['FULL_NAME']);
        $paramInsert['NETWORK_ID'] = $param['network_id'];
        $paramInsert['ROLE_ID'] = $param['role_id'];
        $paramInsert['IS_ACTIVE'] = isset($param['IS_ACTIVE']) ? 1 : 0;
        $paramInsert['BIRTH_DATE'] = date( "Y-m-d", strtotime( $param['BIRTH_DATE'] ) );
        $paramInsert['GENDER'] = $param['GENDER'];
        $paramInsert['EMAIL'] = $param['email'];
        $paramInsert['PHONE_NUMBER'] = $param['PHONE_NUMBER'];
        $paramInsert['PASSWORD'] = isset($param['PASSWORD']) ? Crypt::encryptString($param['PASSWORD']) : Crypt::encryptString(date("Ymd", strtotime($param['BIRTH_DATE'])));
        $paramInsert['CONFIRM_PASSWORD'] = isset($param['PASSWORD']) ? Crypt::encryptString($param['PASSWORD']) : $paramInsert['PASSWORD'];
        $paramInsert['CREATED_BY'] = $request->session()->get('user.username');
        $paramInsert['CREATION_DATE'] = date("Y-m-d h:i:s");
        $paramInsert['LAST_UPDATED_BY'] = $request->session()->get('user.username');
        $paramInsert['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");

        if(!isset($param['PERSON_ID'])){
            $personId = $peopleEnter->insertPesonalInformations($paramInsert);
        }else{
            if($roleType === 'VIEW_BY_NETWORK'){
                $paramInsert['IS_ACTIVE'] = $param['IS_BASE_ACTIVE'];
            }
            $personId = $param['PERSON_ID'];
            $paramInsert['PERSON_ID'] = $personId;
            $peopleEnter->updatePeopleEnter($paramInsert);
        }

        $menuTemp = 0;

        if(isset($param['menu_id'])){
            if(isset($param['PERSON_ID'])){
                $paramInsertMenu['PERSON_ID'] = $personId;
                $peopleEnter->deleteMenus($paramInsertMenu);
            }
            foreach ($param['menu_id'] as $key => $value) {

                if( !(isset($value))  || !($value == 0) ){
                    if($menuTemp != $value){
                        $menuTemp = $value;
                        $paramInsertMenu['PERSON_ID'] = $personId;
                        $paramInsertMenu['MENU_ID'] = $value;
                        $paramInsertMenu['IS_ACTIVE'] = 1;
                        $paramInsertMenu['CREATED_BY'] = $request->session()->get('user.username');
                        $paramInsertMenu['CREATION_DATE'] = date("Y-m-d h:i:s");
                        $paramInsertMenu['LAST_UPDATED_BY'] = $request->session()->get('user.username');
                        $paramInsertMenu['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");
                        //if(!isset($param['PERSON_ID'])){
                            $peopleEnter->insertMenus($paramInsertMenu);
                        //}
                    }

                }

            }
        }

        if($request->session()->get('menu.menuViewType') === 'VIEW_ALL' ){
            return redirect('/workspace#peopleenter');
        }else{
            return redirect('/workspace#personelinformations');

        }

    }

    public function processResetPassword(Request $request){

        $id  = $_POST['nilai'];
        $sts = $_POST['status'];
       
        if ($sts == "0"){
            $applicant = DB::table('mst_applicant')->where('applicant_id',$id)->first();
            $nama      =  $applicant->FULL_NAME;
            $applid    =  $applicant->APPLICANT_ID;
            $balikin = array($nama , $applid);
            $balikin = json_encode($balikin);
            echo $balikin ;
            //echo $sts ;
        }else {
            DB::table('mst_applicant')->where('applicant_id',$id)->delete();
            echo "hapus";

        }
        die();

        // $peopleEnter = new PersonalInformations();

        // $this->middleware('auth');
        // $param = $request->all();
        // unset($param['_token']);        

        // foreach ($param['passwordPeople'] as $key => $value) {
        //     $valuePassword = explode('/',$value);
        //     $paramInsert['PERSON_ID'] = $valuePassword[0];
        //     $paramInsert['PASSWORD'] = Crypt::encryptString($this->random_strings(8));
        //     $paramInsert['CONFIRM_PASSWORD'] = $paramInsert['PASSWORD'];
        //     $paramInsert['CREATED_BY'] = $request->session()->get('user.username');
        //     $paramInsert['CREATION_DATE'] = date("Y-m-d h:i:s");
        //     $paramInsert['LAST_UPDATED_BY'] = $request->session()->get('user.username');
        //     $paramInsert['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");
        //     $peopleEnter->updatePeopleEnter($paramInsert);

        // }


        // return redirect('/workspace#peopleenter');

    }

    public function existsUserName(Request $request){
        $userName = \Request::input('email');
        $peopleEnter = new PersonalInformations();
        $isExists = $peopleEnter->getUserNameExists($userName);
        $paramFilter['isExists'] = $isExists->isEmpty() ?  'true' : 'false';
        return $paramFilter['isExists']; 

    }

    public function existsUserId(Request $request){
        $userName = \Request::input('USER_NUMBER');
        $peopleEnter = new PersonalInformations();
        $isExists = $peopleEnter->getUserIdExists($userName);
        $paramFilter['isExists'] = $isExists->isEmpty() ?  'true' : 'false';
        return $paramFilter['isExists']; 

    }

    public   function random_strings($length_of_string){ 

        $length_of_string = floor($length_of_string/4);

        // String of all alphanumeric character 
        $str_numeric = '0123456789'; 

        $str_capital_alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $str_alphabet = 'abcdefghijklmnopqrstuvwxyz';

        $str_special_character = '!@#$%^&**())-_=~';

        // Shufle the $str_result and returns substring 
        // of specified length 

        $str_password = substr(str_shuffle($str_special_character),0, $length_of_string).substr(str_shuffle($str_capital_alphabet),0, $length_of_string).substr(str_shuffle($str_alphabet),0, $length_of_string).substr(str_shuffle($str_numeric),0, $length_of_string);

        return $str_password; 
    } 


}
