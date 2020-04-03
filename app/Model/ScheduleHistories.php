<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ScheduleHistories extends Model
{
    protected $table = 'psy_schedule_histories';
    protected $primaryKey = 'SCHEDULE_HISTORY_ID';
	
	public function Schedules()
    {
        return $this->belongsTo('App\Model\Schedules','SCHEDULE_ID');
    }
	  public function cancelSchedule($id){
    	$updt = DB::table('psi.psy_schedule_histories')
    		->where('SCHEDULE_HISTORY_ID',$id)
            ->update(['TEST_STATUS' => 'CANCEL']);

        if($updt)
        	return true;
        else
        	return false;
    }
}
?>