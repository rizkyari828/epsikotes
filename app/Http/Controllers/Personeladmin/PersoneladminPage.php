<?php

namespace App\Http\Controllers\Personeladmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersoneladminPage extends Controller
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
        $request->session()->put('menu.menuViewType', 'VIEW_OWN');

         if($roleType === 'VIEW_ALL_NETWORK'){
                $isDisableByRole = '';
                $disableState = '';
                $isDisable = '';
                $valeInput['ROLE'] = '';
                $valeInput['ROLE_ID'] = '';
                $valeInput['NETWORK'] = '';
                $valeInput['NETWORK_ID'] = '';
                $valeInput['CABANG_ID'] = '';
                $valeInput['USER_NUMBER'] = '';
                $valeInput['PERSON_ID'] = '';
            }else if($roleType === 'VIEW_BY_NETWORK'){
                $isDisableByRole = 'readonly';
                $isDisable = 'disabled';
                $disableState = 'state-disabled';
                $valeInput['USER_NUMBER'] = $request->session()->get('user.username');
                $valeInput['PERSON_ID'] = $request->session()->get('user.personId');
                $valeInput['ROLE'] = $request->session()->get('user.roleName');
                $valeInput['ROLE_ID'] = $request->session()->get('user.roleId');
                $valeInput['NETWORK'] = $request->session()->get('user.network');
                $valeInput['NETWORK_ID'] = $request->session()->get('user.networkId');
                $valeInput['CABANG_ID'] = $request->session()->get('user.cabangId');
            }
        $param = array('isDisableByRoles'=> $isDisableByRole,'valeInput' => $valeInput,'disableState' => $disableState,'isDisable'=>$isDisable);
        return view('pages.PersonelAdminPageInquiry',$param);
    }

    public function addPersonelAdmin(Request $request)
    {
        return view('pages.PersonelAdminPageAdd');

    }
}
