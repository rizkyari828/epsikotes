<?php

namespace App\Http\Controllers\Authenticate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Mst_Departemen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Model\PersonalInformations;
use App\Model\Menus;


class LoginPage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userName  = $request->session()->get('user.username');
        echo  $userName;
        if(!isset($userName)){
          return view('loginPage'); 
        }else{
          return redirect('/workspace#dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->middleware('auth');
        $param = $request->all();
        unset($param['_token']);
        $param['CREATED_DATE'] = date("Y/m/d");
        $param['CREATED_BY'] = -1;
        $param['UPDATED_DATE'] = date("Y/m/d");
        $param['UPDATED_BY'] = -1;
        DB::table('master.mst_departemen')->insert($param);
        return redirect('/departemen');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkSession(Request $request)
    {
        $userName  = $request->session()->get('user.username');
                $personId  = $request->session()->get('user.personId');
        if(!isset($userName)){

          return 1; 
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($departemenId,$showStatus)
    {
        //
        $test = array('department' => 'department'  , 'areaoperation' => 'Area Operation' );
        $param = array('content' => 'page.departmenadd','param' => array( 'departmentId'=> $departemenId , 'showStatus' => $showStatus,'test'=>'demo' ) );
        return view('workspace', $param);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

	public function prosesLogin(Request $request)
    {
        $user_number = $request->user_number;
        $password = $request->password;

        $PersonalInformations = new PersonalInformations();
        $data = $PersonalInformations->getPersonalInformationsByEmail($user_number);

        $Menus = new Menus();
       
        if($data){ //apakah email tersebut ada atau tidak
            
            if($password === Crypt::decryptString($data->PASSWORD)){
                $menuData = $Menus->getMenuIdByPerson($data->PERSON_ID);
                $request->session()->put('user.personId', $data->PERSON_ID);
                $request->session()->put('user.username', $data->USER_NUMBER);
                $request->session()->put('user.password', $data->PASSWORD);
                $request->session()->put('user.roleId', $data->ROLE_ID);
                $request->session()->put('user.networkId', $data->NETWORK_ID);
                $request->session()->put('user.role', $data->ROLE_CODE);
                $request->session()->put('user.roleName', $data->ROLE_NAME);
                $request->session()->put('user.network', $data->NETWORK);
                $request->session()->put('user.roleType', $data->ROLE_TYPE);
                $request->session()->put('user.cabangId', $data->CABANG_ID);
                $request->session()->push('user.menuId', $menuData);
                $request->session()->save();
                return redirect('/workspace#dashboard');
            }
            else{
                return redirect('/')->with('alert','Password atau User Name, Salah !');
            }
        }
        else{
            return redirect('/')->with('alert','Password atau User Name, Salah!');
        }

        // $request->session()->put('user.username', 'CMS.ADMIN');
        // $request->session()->put('user.password', '12345');
        // $request->session()->save();
        // return redirect('/dasboard#ajax/dashboard.blade.php');

		 /*
        $param = $request->all();
        unset($param['_token']);
        $param['CREATED_DATE'] = date("Y/m/d");
        $param['CREATED_BY'] = -1;
        $param['UPDATED_DATE'] = date("Y/m/d");
        $param['UPDATED_BY'] = -1;
        DB::table('master.mst_user')->insert($param);
        return redirect('/home'); UNTUK INSERT*/
		/*
		$this->middleware('auth');
		$param = $request->all();
        unset($param['_token']);
		$username = $param['username'];
		$password = md5($param['password']);


		//DB Add User
		$formListAdd = DB::table('master.mst_user')->where('iduser', '=', $username)->where('pass', '=', $password)->get();
		//->toSql; dd($formListAdd);
		//print_r ($formListAdd);exit;

		//Session User
		if (!$formListAdd->isEmpty())
		{
			foreach ($formListAdd as $value)
		  {
			//echo($value->iduser);exit;
			$request->session()->flash('username', $value->iduser);
			$request->session()->flash('password', $value->pass);

		  }
		         return redirect('/');

		}
		else
		{
			return redirect('/login');
		}*/

    }

	public function prosesLogout(Request $request)
    {

		$request->session()->forget('user.username');
        $request->session()->flush();

		$request->session()->forget('user.password');
		$request->session()->flush();

        $request->session()->forget('user.roleId');
        $request->session()->flush();
        
        $request->session()->forget('user.networkId');
        $request->session()->flush();

        $request->session()->forget('user.role');
        $request->session()->flush();
        
        $request->session()->forget('user.network');
        $request->session()->flush();

         $request->session()->forget('user.roleType');
        $request->session()->flush();

         $request->session()->forget('user.menuId');
        $request->session()->flush();

	     return redirect('/');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
