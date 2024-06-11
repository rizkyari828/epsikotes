<?php

namespace App\Http\Controllers\Peopleentermaintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PersonalInformations;
use DB;


class PeopleentermaintenancePage extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */


    public function index(Request $request)
    {
        $roleType  = $request->session()->get('user.roleType');
        $request->session()->put('menu.menuViewType', 'VIEW_ALL');
                        $disableState = '';


         if($roleType === 'VIEW_ALL_NETWORK'){
                $isDisableByRole = '';
                $disableState = '';
                $valeInput['ROLE'] = '';
                $valeInput['ROLE_ID'] = '';
                $valeInput['NETWORK'] = '';
                $valeInput['NETWORK_ID'] = '';
                $valeInput['CABANG_ID'] = '';
                $valeInput['USER_NUMBER'] = '';
                $valeInput['PERSON_ID'] = '';
            }else if($roleType === 'VIEW_BY_NETWORK'){
                $isDisableByRole = 'readonly';
                $disableState = 'state-disabled';
                $valeInput['USER_NUMBER'] = $request->session()->get('user.username');
                $valeInput['PERSON_ID'] = $request->session()->get('user.personId');
                $valeInput['ROLE'] = $request->session()->get('user.role');
                $valeInput['ROLE_ID'] = $request->session()->get('user.roleId');
                $valeInput['NETWORK'] = $request->session()->get('user.network');
                $valeInput['NETWORK_ID'] = $request->session()->get('user.networkId');
                $valeInput['CABANG_ID'] = $request->session()->get('user.cabangId');
            }
        $param = array('isDisableByRoles'=> $isDisableByRole,'valeInput' => $valeInput,'disableState' => $disableState);
        return view('pages.PeopleEnterMaintenanceInquiry',$param);
    }

    public function addPersonelAdmin(Request $request)
    {
        return view('pages.PeopleEnterMaintenanceAdd');

    }

    public function testBox(Request $request){
        //return view('pages.testbox');
        $id   =  $request->applId;
        if ($id <> ""){
           $msg = "This is a simple message.";
           return response()->json(array('msg'=> $msg), 200);
        }
        else{
            return view('pages.Hapus');
        }     

    }

    public function allPeopleEnter(Request $request){

        $this->middleware('auth');
        $paramFilter = \Request::input('paramFilters');
        $PersonalInformations = new PersonalInformations();
        $records = array();

        if( $paramFilter['isFirstPage'] != 0 ){

    		foreach ($PersonalInformations->getPersonalInformations($paramFilter) as $indexPersonelInformations => $rowPersonelInformations ){
    		   
    				$records['data'][] = array('checkbox'=>'<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /><span></span></label>','action'=>'<a href="viewPerson/'.$rowPersonelInformations->PERSON_ID.'/view/'.$request->session()->get('menu.menuViewType').'">view</a>|<a href="viewPerson/'.$rowPersonelInformations->PERSON_ID.'/edit/'.$request->session()->get('menu.menuViewType').'">edit</a>','userNumber'=>$rowPersonelInformations->USER_NUMBER,'fullName'=>$rowPersonelInformations->FULL_NAME,'roleName'=>$rowPersonelInformations->role_name,'network'=>$rowPersonelInformations->NETWORK,'isActive'=>$rowPersonelInformations->IS_ACTIVE == 1 ? 'Yes' : 'No','lastUpdateDate'=>$rowPersonelInformations->last_update_date,'lastUpdateBy'=>$rowPersonelInformations->last_updated_by );
    			


    		} 
        }else{
            $records['data'] =  array('checkbox'=>null,'action'=>null,'userNumber'=>null,'fullName'=>null,'roleName'=>null,'network'=>null,'isActive'=>null,'lastUpdateDate'=>null,'lastUpdateBy'=>null);
        }
			
        if(!isset($rowPersonelInformations->PERSON_ID)){
            $records['data'] =  array('checkbox'=>null,'action'=>null,'userNumber'=>null,'fullName'=>null,'roleName'=>null,'network'=>null,'isActive'=>null,'lastUpdateDate'=>null,'lastUpdateBy'=>null);

        } 

        echo json_encode($records);
        
    }
}
