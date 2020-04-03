<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




/**
 *
 */
class Menus extends Model
{

      public function getMenuIdByPerson($paramPersonId){
        $menu = DB::table('psi.pea_menus')
            ->where('PERSON_ID', $paramPersonId)
            ->where('IS_ACTIVE', 1)
            ->pluck('MENU_ID');

        return $menu;
    }

     public function getMenuByMenuId ($paramMenuId){
        $menus = DB::select("select * from(
                select
                    mmh.menu_name,
                    mmh.menu_id,
                    0 as parent,
                    mmh.menu_id as menu,
                    lower(replace(mmh.menu_name, ' ','')) as index_arr,
                    null as url_menu,
                    null as index_parent
                from psi.mst_menu_hdr mmh
                where mmh.menu_id in ($paramMenuId)
                union all
                select
                    mmd.prompt as menu_name,
                    mmd.menu_dtl_id,
                    mmh.menu_id as parent,
                    mmh.menu_id as menu,
                    concat(lower(replace(mmd.prompt, ' ','')),mmd.menu_dtl_id)  as index_arr,
                    mfs.action_url as url_menu,
                    lower(replace(mmh.menu_name, ' ','')) as index_parent
                from psi.mst_menu_hdr mmh
                left join psi.mst_menu_dtl mmd on mmh.menu_id = mmd.menu_id
                left join psi.mst_functions mfs on mmd.item_id = mfs.function_id
                where mmh.is_active = 1
                and mmh.menu_id in ($paramMenuId)
                )  mm
                order by mm.menu_id,mm.parent asc ");
        return $menus;
    }

    public function getAllMenu(){

        $menus = DB::select("select * from(
                select
                    mmh.menu_name,
                    mmh.menu_id,
                    0 as parent,
                    mmh.menu_id as menu,
                    lower(replace(mmh.menu_name, ' ','')) as index_arr,
                    null as url_menu,
                    null as index_parent
                from psi.mst_menu_hdr mmh
                union all
                select
                    mmd.prompt as menu_name,
                    mmd.menu_dtl_id,
                    mmh.menu_id as parent,
                    mmh.menu_id as menu,
                    concat(lower(replace(mmd.prompt, ' ','')),mmd.menu_dtl_id)  as index_arr,
                    mfs.action_url as url_menu,
                    lower(replace(mmh.menu_name, ' ','')) as index_parent
                from psi.mst_menu_hdr mmh
                left join psi.mst_menu_dtl mmd on mmh.menu_id = mmd.menu_id
                left join psi.mst_functions mfs on mmd.item_id = mfs.function_id
                where mmh.is_active = 1
                )  mm
                order by mm.menu_id,mm.parent asc ");
        return $menus;
    }

    public function getEachMenu($menuName){
        /*
        $lookup = DB::table('psi.mst_menu_dtl')
       // ->whereBetween(date("Y-m-d"), ['que_sub_category_versions.date_from','que_sub_category_versions.date_to'])
        ->whereRaw('upper(mst_menu_dtl.prompt) like upper(\'%'.$menuName.'%\')')
        ->select('mst_menu_dtl.menu_id','mst_menu_dtl.prompt')
        ->get();*/
         $lookup = DB::select("select * from(
                select
                    mmh.menu_name,
                    mmh.menu_id,
                    0 as parent,
                    mmh.menu_id as menu,
                    lower(replace(mmh.menu_name, ' ','')) as index_arr,
                    null as url_menu,
                    null as index_parent
                from psi.mst_menu_hdr mmh
                union all
                select
                    mmd.prompt as menu_name,
                    mmd.menu_dtl_id,
                    mmh.menu_id as parent,
                    mmh.menu_id as menu,
                    concat(lower(replace(mmd.prompt, ' ','')),mmd.menu_dtl_id)  as index_arr,
                    mfs.action_url as url_menu,
                    lower(replace(mmh.menu_name, ' ','')) as index_parent
                from psi.mst_menu_hdr mmh
                left join psi.mst_menu_dtl mmd on mmh.menu_id = mmd.menu_id
                left join psi.mst_functions mfs on mmd.item_id = mfs.function_id
                where mmh.is_active = 1
                )  mm
                where upper(mm.menu_name) like '%$menuName%'
                order by mm.menu_id,mm.parent asc ");


        return $lookup;

    }

}
