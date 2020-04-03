<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




/**
 *
 */
class Job extends Model
{

    public function getJob($jobName){

        /*DB::table('psi.que_sub_categories')
        ->join('psi.que_sub_category_versions','que_sub_categories.sub_category_id','=','que_sub_category_versions.sub_category_id')
       // ->whereBetween(date("Y-m-d"), ['que_sub_category_versions.date_from','que_sub_category_versions.date_to'])
        ->whereRaw('date(sysdate()) between que_sub_category_versions.date_from and que_sub_category_versions.date_to')
        ->whereRaw('upper(que_sub_categories.sub_category_name) like upper(\'%'.$categoryName.'%\')')
        ->select('que_sub_categories.sub_category_name','que_sub_categories.sub_category_id','que_sub_categories.last_updated_by','que_sub_categories.last_update_date')
        ->get();*/
        $job = DB::table('psi.mst_jobs')
        ->whereRaw('upper(mst_jobs.job_name) like upper(\'%'.$jobName.'%\')')
        ->where('is_active',1)
        ->select('mst_jobs.job_name','mst_jobs.job_id')
        ->get();

        return $job;
    }

    public function getAllJob(){
        $job = DB::table('psi.mst_jobs')
        ->where('is_active',1)
        ->select('mst_jobs.job_name','mst_jobs.job_id')
        ->get();

        return $job;
    }

}
