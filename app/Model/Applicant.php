<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




/**
 *
 */
class Applicant extends Model
{
    protected $table = 'psi.mst_applicant';
    protected $primaryKey = 'CANDIDATE_ID';
    public $timestamps = false;

    protected $fillable = [
        'APPLICANT_ID',
        'DATA_SOURCE',
        'CABANG_ID',
        'USER_NAME',
        'FULL_NAME',
        'BIRTH_DATE',
        'GENDER',
        'KTP',
        'ADDRESS',
        'CITY',
        'PHONE_NUMBER',
        'EMAIL',
        'LAST_EDUCATIONS',
    ];

    protected $hidden = [
        'PASSWORD',
    ];

    public function Schedules(){
        return $this->hasOne('App\Model\Schedules');
    }

	public function getAllAplicant($paramFilter){

		$applicant =  DB::table('psi.mst_applicant')
        ->join('psi.psy_schedules','psy_schedules.candidate_id','=','mst_applicant.candidate_id')
        ->join('psi.psy_schedule_histories','psy_schedule_histories.schedule_id','=','psy_schedules.schedule_id')
        ->join('psi.mst_networks','mst_networks.cabang_id','=','mst_applicant.cabang_id')
		->join(DB::raw("(
				select MAX(psy_schedule_histories.schedule_history_id) as schedule_history_id
                    ,psy_schedule_histories.schedule_id
                    ,psy_schedule_histories.test_status
                    ,MAX(psy_schedule_histories.reschedule_seq) as reschedule_seq
                from psi.psy_schedule_histories
                group by psy_schedule_histories.schedule_id,
                psy_schedule_histories.test_status,psy_schedule_histories.schedule_history_id
                order by psy_schedule_histories.schedule_history_id desc
			) as max_schedule"),function($join){

        $join->on("max_schedule.schedule_history_id","=","psy_schedule_histories.schedule_history_id");

			});
		   if(isset($paramFilter)){
            if($paramFilter['applicantName'] != null)
            {
                $applicant->where('mst_applicant.full_name','=',$paramFilter['applicantName']);
            }
            if(isset($paramFilter['applicantId'])){
                if($paramFilter['applicantId'] != null)
                {
                    $applicant->where('mst_applicant.APPLICANT_ID','=',$paramFilter['applicantId']);
                }
            }
            if(isset($paramFilter['ktp'])){
                if($paramFilter['ktp'] != null)
                {
                    $applicant->where('mst_applicant.KTP','=',$paramFilter['ktp']);
                }
            }
			if(isset($paramFilter['psikotestStatus'])){
                if($paramFilter['psikotestStatus'] != null)
                {
                    $applicant->where('psy_schedule_histories.TEST_STATUS','=',$paramFilter['psikotestStatus']);
                }
            }
			if(isset($paramFilter['rescheduleReason'])){
                if($paramFilter['rescheduleReason'] != null)
                {
                    $applicant->where('psy_schedule_histories.RESCHEDULE_REASON_CODE','=',$paramFilter['rescheduleReason']);
                }
            }
			if(isset($paramFilter['planDateFrom'])){
                if($paramFilter['planDateFrom'] != null)
                {
                    $applicant->where('psy_schedule_histories.PLAN_START_DATE','>=',date( "Y-m-d", strtotime($paramFilter['planDateFrom']) ));
                }
            }
			if(isset($paramFilter['planDateTo'])){
                if($paramFilter['planDateTo'] != null)
                {
                    $applicant->where('psy_schedule_histories.PLAN_END_DATE','<=',date( "Y-m-d", strtotime($paramFilter['planDateTo']) ));
                }
            }
            if(isset($paramFilter['networkId'])){
                if($paramFilter['networkId'] != null)
                {
                    $applicant->where('mst_applicant.cabang_id','=',$paramFilter['networkId']);
                }
            }
            if(isset($paramFilter['location'])){
                if($paramFilter['location'] != null)
                {
                    //$applicant->whereRaw('mst_networks.network_id in( select network_id from mst_city where city_id = '.$paramFilter['locationId'].' )');

                    $applicant->where('mst_applicant.city','=',$paramFilter['location']);

                }
            }
            if(isset($paramFilter['actualStartFrom'])){
                if($paramFilter['actualStartFrom'] != null)
                {
                    $applicant->whereRaw('DATE(psy_schedule_histories.ACTUAL_START_DATE) >= '.date( "Y-m-d", strtotime($paramFilter['actualStartFrom']) ));
                }
            }
			if(isset($paramFilter['actualStartTo'])){
                if($paramFilter['actualStartTo'] != null)
                {
                    $applicant->whereRaw('DATE(psy_schedule_histories.ACTUAL_START_DATE) <= '.date( "Y-m-d", strtotime($paramFilter['actualStartTo']) ));

                }
            }

        }
        $data = $applicant->select('mst_applicant.candidate_id','mst_applicant.applicant_id','mst_applicant.user_name','mst_applicant.full_name','mst_applicant.birth_date','mst_applicant.gender','mst_applicant.ktp','mst_applicant.address','mst_applicant.city','mst_applicant.phone_number','mst_applicant.last_educations','psy_schedule_histories.plan_start_date','psy_schedule_histories.plan_end_date','psy_schedule_histories.actual_start_date','psy_schedule_histories.reschedule_seq','psy_schedule_histories.reschedule_reason_code','psy_schedule_histories.reschedule_reason_text','psy_schedule_histories.last_updated_by','psy_schedule_histories.last_update_date','psy_schedule_histories.schedule_history_id','psy_schedule_histories.test_status')
         ->orderBy('psy_schedule_histories.plan_start_date', 'desc')
		 ->get();

        return $data;

	}


    public function getApplicant($paramFilter){

        $applicant =  DB::table('psi.mst_applicant')
        ->where('mst_applicant.candidate_id',$paramFilter['candidateId'])
        ->select('mst_applicant.candidate_id','mst_applicant.applicant_id','mst_applicant.user_name','mst_applicant.full_name','mst_applicant.birth_date','mst_applicant.gender','mst_applicant.ktp','mst_applicant.address','mst_applicant.city','mst_applicant.phone_number','mst_applicant.last_educations','mst_applicant.email')
        ->get();
        return $applicant;

    }

    public function insertApplicant($applicantId){
       return DB::table('psi.mst_applicant')->insertGetId($applicantId);
    }

    public function getUserName($userName){
        $applicant =  DB::table('psi.mst_applicant')
        ->whereRaw('upper(mst_applicant.full_name) like upper(\'%'.$userName.'%\')')
        ->select('mst_applicant.full_name')
        ->get();
        return $applicant;
    }

    public function getUserId($userId){

        $applicant =  DB::table('psi.mst_applicant')
        ->join('psi.psy_schedules','psy_schedules.candidate_id','=','mst_applicant.candidate_id')
        ->join('psi.psy_schedule_histories','psy_schedule_histories.schedule_id','=','psy_schedules.schedule_id')
        ->where('mst_applicant.applicant_id',$userId)
        ->whereRaw('(12 * (YEAR(NOW()) - YEAR(psy_schedule_histories.plan_start_date)) + (MONTH(NOW()) - MONTH(psy_schedule_histories.plan_start_date))) < (select meaning from psi.mst_lookup_dtl where detail_code = ?)', 'GRACE_PERIOD')
        ->where('psy_schedule_histories.test_status','!=','CANCEL')
        ->select('mst_applicant.applicant_id')
        ->get();

        //dd($applicant);
        //exit();
        return $applicant;
    }

    public function getExistsUserid($userId){
        $applicant =  DB::table('psi.mst_applicant')
        ->where('mst_applicant.applicant_id',$userId)
        ->select('mst_applicant.candidate_id')
        ->first();


        return $applicant;

    }

}
