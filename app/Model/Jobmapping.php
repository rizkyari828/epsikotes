<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




/**
 *
 */
class Jobmapping extends Model
{

    public function getJobMapping($paramFilter){

        $dateSysdate = date("Y-m-d");

        $jobMapping = DB::table('psi.psy_job_mappings')
        ->join('psi.psy_job_mapping_versions','psy_job_mappings.job_mapping_id','=','psy_job_mapping_versions.job_mapping_id')
        //->whereBetween(date("Y-m-d"), ['que_sub_category_versions.date_from','que_sub_category_versions.date_to'])
        ->whereRaw('date(sysdate()) between psy_job_mapping_versions.date_from and psy_job_mapping_versions.date_to')
        ->whereRaw('upper(psy_job_mappings.name) like upper(\'%'.$paramFilter['jobMappingName'].'%\')')
        ->select('psy_job_mappings.name','psy_job_mapping_versions.random_category','psy_job_mappings.last_updated_by','psy_job_mappings.last_update_date','psy_job_mappings.job_mapping_id','psy_job_mapping_versions.version_id')
        ->get();
        return $jobMapping;

    }

    public function getAllJobMapping($paramFilter){
                $dateSysdate = date("Y-m-d");

        $jobMapping = DB::table('psi.psy_job_mappings')
        ->join('psi.psy_job_mapping_versions','psy_job_mappings.job_mapping_id','=','psy_job_mapping_versions.job_mapping_id')
         ->join('psi.que_narrations as A','A.narration_id','=','psy_job_mapping_versions.GENERAL_INSTRUCTION')
         ->join('psi.que_narrations as B','B.narration_id','=','psy_job_mapping_versions.FINAL_GREATING');

        //->whereBetween(date("Y-m-d"), ['que_sub_category_versions.date_from','que_sub_category_versions.date_to'])
       // ->whereRaw('date(sysdate()) between psy_job_mapping_versions.date_from and psy_job_mapping_versions.date_to')
       // ->whereRaw('upper(psy_job_mappings.name) like upper(\'%'.$jobMappingName.'%\')')
        if($paramFilter['countJobMapping'] >= 1){
           if($paramFilter['isCurrent']){
                $jobMapping->where('psy_job_mapping_versions.date_from','<=',$dateSysdate)->where('psy_job_mapping_versions.date_to','>=',$dateSysdate);
            }else if($paramFilter['isFuture']){
                $jobMapping->where('psy_job_mapping_versions.date_from','>',$dateSysdate);
            }else{
                $jobMapping->where('psy_job_mapping_versions.date_to','<',$dateSysdate);

            }
        }
        if(isset($paramFilter)){
            $jobMapping->where('psy_job_mappings.job_mapping_id','=',$paramFilter['jobMappingId']);
        }
        $data = $jobMapping->select('psy_job_mappings.NAME','psy_job_mapping_versions.random_category','psy_job_mapping_versions.VERSION_ID','psy_job_mapping_versions.VERSION_NUMBER','psy_job_mapping_versions.DESCRIPTION','psy_job_mapping_versions.DATE_FROM','psy_job_mapping_versions.DATE_TO','psy_job_mappings.last_updated_by','psy_job_mappings.last_update_date','psy_job_mappings.JOB_MAPPING_ID','A.narration_id','A.narration_name','B.narration_id as final_greating_id','B.narration_name as final_greating_name')
        ->get();
        return $data;
    }

     public function getAllJobMappingActive($paramFilter){
        $jobMapping = DB::table('psi.psy_job_mappings')
        ->join('psi.psy_job_mapping_versions','psy_job_mappings.job_mapping_id','=','psy_job_mapping_versions.job_mapping_id')
        ->whereRaw('upper(psy_job_mappings.name) like upper(\'%'.$paramFilter['jobMappingName'].'%\')')  ->groupBy('psy_job_mappings.JOB_MAPPING_ID')
        ->select('psy_job_mappings.NAME','psy_job_mapping_versions.random_category','psy_job_mapping_versions.VERSION_ID','psy_job_mapping_versions.VERSION_NUMBER','psy_job_mapping_versions.DESCRIPTION','psy_job_mapping_versions.DATE_FROM','psy_job_mapping_versions.DATE_TO','psy_job_mappings.last_updated_by','psy_job_mappings.last_update_date','psy_job_mappings.JOB_MAPPING_ID')
      
        ->get();
        return $jobMapping;
    }

    public function insertJobMapping($jobMappingList){
       return DB::table('psi.psy_job_mappings')->insertGetId($jobMappingList);
    }

    public function insertJobMappingVersions($jobMappingVersions){
        return DB::table('psi.psy_job_mapping_versions')->insertGetId($jobMappingVersions);
    }

    public function insertJobCategoryList($jobCategoryList){
         DB::table('psi.psy_job_category_list')->insert($jobCategoryList);

    }

    public function insertJobProfile($jobProfiles){
       return  DB::table('psi.psy_job_profiles')->insertGetId($jobProfiles);

    }

    public function insertJobProfileScore($jobProfileScore){
         DB::table('psi.psy_job_profile_score')->insert($jobProfileScore);

    }

    public function getJobCategoryList($paramFilter){

         $normaAspect = DB::table('psi.psy_job_category_list')
         ->join('psi.que_categories','que_categories.category_id','=','psy_job_category_list.category_id')
         ->join('psi.que_category_versions','que_category_versions.category_id','=','que_categories.category_id')
         ->where('psy_job_category_list.version_id','=',$paramFilter['versionId'])
         ->select('que_categories.category_id','que_categories.category_name')
         ->get();

         return $normaAspect;

    }

    public function getJobProfile($paramFilter){
          $jobProfiles = DB::table('psi.mst_jobs')
             ->join('psi.psy_job_profiles','psy_job_profiles.job_id','=','mst_jobs.job_id')
             ->where('psy_job_profiles.version_id','=',$paramFilter['versionId'])
             ->select('mst_jobs.job_name','psy_job_profiles.job_id','psy_job_profiles.job_profile_id','psy_job_profiles.total_pass_score')
             ->get();
         return $jobProfiles;
    }

    public function getJobProfileScore($paramFilter){
          $jobProfiles = DB::table('psi.psy_job_profile_score')
             ->join('psi.que_categories','que_categories.category_id','=','psy_job_profile_score.category_id')
             ->join('psi.que_category_versions','que_category_versions.category_id','=','que_categories.category_id')
             ->where('psy_job_profile_score.job_profile_id','=',$paramFilter['jobProfileId'])
             ->whereRaw('date(sysdate()) between que_category_versions.date_from and que_category_versions.date_to')
             ->select('psy_job_profile_score.profile_score_id','psy_job_profile_score.job_profile_id','psy_job_profile_score.pass_score','que_categories.category_name','psy_job_profile_score.mandatory','que_categories.category_id')
             ->get();
         return $jobProfiles;
    }

    public function getFutureJobMapping($jobMappingId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_job_mapping_versions')
        ->where('job_mapping_id','=',$jobMappingId)
        ->where('date_from','>',$dateSysdate)
        ->select(DB::raw('CASE WHEN job_mapping_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }

     public function getPastJobMapping($jobMappingId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_job_mapping_versions')
        ->where('job_mapping_id','=',$jobMappingId)
        ->where('date_to','<',$dateSysdate)
        ->select(DB::raw('CASE WHEN job_mapping_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }


    public function getCurrentJobMapping($jobMappingId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_job_mapping_versions')
        ->where('job_mapping_id','=',$jobMappingId)
        ->where('psy_job_mapping_versions.date_from','<=',$dateSysdate)
        ->where('psy_job_mapping_versions.date_to','>=',$dateSysdate)
        ->select(DB::raw('CASE WHEN job_mapping_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }

    public function getMaxVersion($jobMappingId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_job_mapping_versions')
        ->where('job_mapping_id','=',$jobMappingId)
        ->select(DB::raw('MAX(VERSION_NUMBER) as version_number'))
        ->get();
        return $isFuture;
    }

    public function getFutureVersion($versionNumber,$jobMappingId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_job_mapping_versions')
        ->where('job_mapping_id','=',$jobMappingId)
        ->where('version_number','=',$versionNumber)
        ->where('date_from','>',$dateSysdate)
        ->select(DB::raw('CASE WHEN job_mapping_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }

     public function getPastVersion($versionNumber,$jobMappingId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_job_mapping_versions')
        ->where('job_mapping_id','=',$jobMappingId)
        ->where('version_number','=',$versionNumber)
        ->where('date_to','<',$dateSysdate)
        ->select(DB::raw('CASE WHEN job_mapping_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }

    public function getCurrentVersion($versionNumber,$jobMappingId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_job_mapping_versions')
        ->where('job_mapping_id','=',$jobMappingId)
        ->where('version_number','=',$versionNumber)
        ->where('psy_job_mapping_versions.date_from','<=',$dateSysdate)
        ->where('psy_job_mapping_versions.date_to','>=',$dateSysdate)
        ->select(DB::raw('CASE WHEN job_mapping_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }


    public function getVersionNumber($paramFilter){
        $dateSysdate = date("Y-m-d");
        $versionNumbers = DB::table('psi.psy_job_mapping_versions')
        ->where('job_mapping_id','=',$paramFilter['jobMappingId'])
        ->select(DB::raw('CASE WHEN date_from > "'.$dateSysdate.'" THEN "FUTURE" WHEN date_to < "'.$dateSysdate.'" THEN "PAST" ELSE "CURRENT"  END as STATE,  VERSION_ID, VERSION_NUMBER, job_mapping_id'))
        ->get();

        return $versionNumbers;
    }

    public function updateVersionActive($paramFilter){
        DB::table('psi.psy_job_mapping_versions') 
        ->where('job_mapping_id','=',$paramFilter['jobMappingId'])
        ->where('version_number','=',$paramFilter['versionNumber'])
        ->update($paramFilter['value']);

    }


}
