<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;





/**
 *
 */
class PersonalInformations extends Model
{

    public function getPersonalInformationsByEmail($paramEmail){

        $PersonalInformations = DB::table('psi.pea_personal_informations')
            ->leftJoin('psi.mst_roles','mst_roles.role_id','=','pea_personal_informations.role_id')
            ->leftJoin('psi.mst_networks','mst_networks.network_id','=','pea_personal_informations.network_id')
            ->where('pea_personal_informations.user_number', $paramEmail)
            ->where('pea_personal_informations.is_active',1)
            ->first();


        return $PersonalInformations;
    }

    public function getPersonalInformations($paramFilter){
        

        $PersonalInformations = DB::table('psi.pea_personal_informations')
      //  ->whereRaw('upper(que_categories.category_name) like upper(\'%'.$categoryName.'%\')')
        ->join('psi.mst_roles','mst_roles.role_id','=','pea_personal_informations.role_id')
        ->join('psi.mst_networks','mst_networks.network_id','=','pea_personal_informations.network_id');
        if(isset($paramFilter)){
            if(isset($paramFilter['personId'])){
                if($paramFilter['personId'] != null)
                {
                    $PersonalInformations->where('pea_personal_informations.person_id','=',$paramFilter['personId']);
                }
            }
            if(isset($paramFilter['roleId'])){
                if($paramFilter['roleId'] != null)
                {
                    $PersonalInformations->where('mst_roles.ROLE_ID','=',$paramFilter['roleId']);
                }
            }
            if(isset($paramFilter['networkId'])){
                if($paramFilter['networkId'] != null)
                {
                    $PersonalInformations->where('mst_networks.CABANG_ID','=',$paramFilter['networkId']);
                }
            }
            if(isset($paramFilter['isFirstPage'])){
                if($paramFilter['isFirstPage']){
                    
                        $paramFilter['isActive'] = $paramFilter['isActive'] === 'true' ? 1 : 0;
                        $PersonalInformations->where('pea_personal_informations.IS_ACTIVE','=',$paramFilter['isActive']);
               
                }
            }
            if(isset($paramFilter['menuId'])){
                if($paramFilter['menuId'] != null)
                {   

                    $PersonalInformations->whereRaw('pea_personal_informations.person_id in( select person_id from pea_menus where menu_id = '.$paramFilter['menuId'].' )');
                }
            }

        }
        $data =  $PersonalInformations ->select('pea_personal_informations.PERSON_ID','pea_personal_informations.FULL_NAME','pea_personal_informations.USER_NUMBER','pea_personal_informations.IS_ACTIVE','mst_roles.role_name','mst_networks.NETWORK','pea_personal_informations.last_updated_by','pea_personal_informations.last_update_date','pea_personal_informations.PASSWORD','mst_networks.NETWORK_ID','pea_personal_informations.CONFIRM_PASSWORD','mst_roles.ROLE_ID','mst_roles.ROLE_TYPE','pea_personal_informations.last_update_date','pea_personal_informations.last_update_date','pea_personal_informations.BIRTH_DATE','pea_personal_informations.GENDER','pea_personal_informations.EMAIL','pea_personal_informations.PHONE_NUMBER')
        ->get();
			
        return $data;

    }

    public function getEachMenuPersonalEnter($personId){

        $menuPeople = DB::table('psi.pea_menus')
        ->where('pea_menus.person_id','=',$personId)
        ->where('pea_menus.is_active','=',1)
        ->select('pea_menus.person_id','pea_menus.menu_id')
        ->get();

        return $menuPeople;

    }

    public function getUserNameExists($paramEmail){
        $isExists = DB::table('psi.pea_personal_informations')
        ->where('pea_personal_informations.EMAIL', $paramEmail)
        ->select(DB::raw('CASE WHEN pea_personal_informations.EMAIL is not null THEN 1 ELSE 0 END as IS_EXISTS'))
        ->get();
        return $isExists;
    }

    public function getUserIdExists($paramEmail){
        $isExists = DB::table('psi.pea_personal_informations')
        ->where('pea_personal_informations.user_number', $paramEmail)
        ->select(DB::raw('CASE WHEN pea_personal_informations.user_number is not null THEN 1 ELSE 0 END as IS_EXISTS'))
        ->get();
        return $isExists;
    }

    public function insertPesonalInformations($personalList){
       return DB::table('psi.pea_personal_informations')->insertGetId($personalList);
    }

    public function insertMenus($menuList){
            DB::table('psi.pea_menus')->insert($menuList);
    }

    public function updatePeopleEnter($personalList){
            DB::table('psi.pea_personal_informations')->where('PERSON_ID',$personalList['PERSON_ID'])->update($personalList);
    }

    public function deleteMenus($personalList){
            DB::table('psi.pea_menus')->where('PERSON_ID',$personalList['PERSON_ID'])->delete();
    }

    public function updateMenus($menuList){
            DB::table('psi.pea_menus')->where('PERSON_ID',$menuList['PERSON_ID'])->delete();
            DB::table('psi.pea_menus')->insert($menuList);

    }

}
