<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 *
 */
class Schedules extends Model
{

    protected $table = "psy_schedules";

    public $timestamps = false;

    public function getScheduled($categoryName)
    {

        $categories = DB::table('psi.que_categories')
            ->join('psi.que_category_versions', 'que_category_versions.category_id', '=', 'que_categories.category_id')
            ->whereRaw('upper(que_categories.category_name) like upper(\'%' . $categoryName . '%\')')
            ->select('que_categories.category_name', 'que_categories.category_id', 'que_categories.last_updated_by', 'que_categories.last_update_date')
            ->get();

        return $categories;

    }

    public function getScheduledByCandidateId($candidateId)
    {

        $scheduleId = DB::table('psi.psy_schedules')
            ->join('psi.psy_schedule_histories', 'psy_schedules.schedule_id', '=', 'psy_schedule_histories.schedule_id')
            ->where('psy_schedules.candidate_id', $candidateId)->select('psy_schedule_histories.schedule_id', 'psy_schedule_histories.test_status', 'psy_schedule_histories.job_mapping_version_id')->first();
        return $scheduleId;
    }

    public function getScheduledSeq($scheduleId)
    {

        $scheduleSeq = DB::table('psi.psy_schedule_histories')->where('schedule_id', $scheduleId)->max('RESCHEDULE_SEQ');

        return $scheduleSeq;

    }

    public function getCategoryScore($paramFilter)
    {
        $categoryScore = DB::select('select
                      psy_job_category_list.category_id,
                      psy_job_category_list.category_seq,
                      que_sub_category_list.sub_category_id,
                      sum(psy_norma_score.raw_score) as sum_rawscore,
                      sum(psy_norma_score.standard_score) as standard_score
                      from psy_job_mapping_versions
                      join psy_job_category_list on psy_job_mapping_versions.version_id = psy_job_category_list.version_id
                      join que_category_versions on psy_job_category_list.category_id = que_category_versions.category_id
                      join que_sub_category_list on que_category_versions.version_id = que_sub_category_list.version_id
                      join psy_norma on psy_norma.category_id = psy_job_category_list.category_id
                      join psy_norma_versions on psy_norma_versions.norma_id = psy_norma.norma_id
                      join psy_norma_score on psy_norma_score.version_id = psy_norma_versions.version_id
                      where psy_job_mapping_versions.job_mapping_id = ?
                      and date(sysdate()) between psy_job_mapping_versions.date_from and psy_job_mapping_versions.date_to
                      and date(sysdate()) between que_category_versions.date_from and que_category_versions.date_to
                      and date(sysdate()) between psy_norma_versions.date_from and psy_norma_versions.date_to
                      group by psy_job_category_list.category_id,que_sub_category_list.sub_category_id,psy_job_category_list.category_seq', [$paramFilter['job_mapping_id']]);
        return $categoryScore;
    }

    public function getScheduledHistoryList($paramFilter)
    {


        $categoryScore = DB::select('select
          psy_job_mappings.name,
          psy_schedule_histories.plan_start_date,
          psy_schedule_histories.plan_end_date,
          psy_schedule_histories.test_status,
          psy_schedule_histories.reschedule_reason_code,
          (select category_submit_date from psy_test_categories where psy_test_categories.schedule_id = psy_schedules.schedule_id and psy_test_categories.category_id = 1 ) as inductive,
          (select category_submit_date from psy_test_categories where psy_test_categories.schedule_id = psy_schedules.schedule_id and psy_test_categories.category_id = 2 ) as deductive,
          (select category_submit_date from psy_test_categories where psy_test_categories.schedule_id = psy_schedules.schedule_id and psy_test_categories.category_id = 3 ) as reading,
          (select category_submit_date from psy_test_categories where psy_test_categories.schedule_id = psy_schedules.schedule_id and psy_test_categories.category_id = 4 ) as arithmatic,
          (select category_submit_date from psy_test_categories where psy_test_categories.schedule_id = psy_schedules.schedule_id and psy_test_categories.category_id = 5 ) as spatials,
          (select category_submit_date from psy_test_categories where psy_test_categories.schedule_id = psy_schedules.schedule_id and psy_test_categories.category_id = 6 ) as memory
           from psy_schedules
           join psy_schedule_histories on psy_schedule_histories.schedule_id = psy_schedules.schedule_id
            join psy_job_mappings on psy_job_mappings.job_mapping_id = psy_schedule_histories.job_mapping_id
          where psy_schedules.candidate_id = ' . $paramFilter['candidateId'] . '
          ');
        return $categoryScore;
    }

    public function insertSchedule($schedulesList)
    {
        return DB::table('psi.psy_schedules')->insertGetId($schedulesList);
    }

    public function insertHistory($schedulesHistoryList)
    {
        DB::table('psi.psy_schedule_histories')->insert($schedulesHistoryList);
    }

    public function insertTestCategory($testCategoryList)
    {
        DB::table('psi.psy_test_categories')->insert($testCategoryList);
    }

    public function getFutureSchedule($candidateId)
    {
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_schedule_histories')
            ->join('psi.psy_schedules', 'psy_schedules.schedule_id', '=', 'psy_schedule_histories.schedule_id')
            ->where('psy_schedules.candidate_id', '=', $candidateId)
            ->where('psy_schedule_histories.plan_start_date', '>', $dateSysdate)
            ->where('psy_schedule_histories.test_status', '!=', 'CANCEL')
            ->select(DB::raw('CASE WHEN psy_schedule_histories.schedule_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
            ->get();
        return $isFuture;
    }

    public function getCurrentSchedule($candidateId)
    {
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_schedule_histories')
            ->join('psi.psy_schedules', 'psy_schedules.schedule_id', '=', 'psy_schedule_histories.schedule_id')
            ->where('psy_schedules.candidate_id', '=', $candidateId)
            ->where('psy_schedule_histories.plan_start_date', '<=', $dateSysdate)
            ->where('psy_schedule_histories.plan_end_date', '>=', $dateSysdate)
            ->select(DB::raw('CASE WHEN psy_schedule_histories.schedule_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
            ->get();
        return $isFuture;
    }

    public function getMaxScheduleStatus($candidateId)
    {
        $isFuture = DB::table('psi.psy_schedule_histories')
            ->join('psi.psy_schedules', 'psy_schedules.schedule_id', '=', 'psy_schedule_histories.schedule_id')
            ->where('psy_schedules.candidate_id', '=', $candidateId)
            ->select(DB::raw('psy_schedule_histories.plan_end_date,psy_schedule_histories.test_status'))
            ->orderBy('psy_schedule_histories.plan_end_date', 'desc')
            ->first();
        return $isFuture;
    }

    public function getStatusScheduleNotAllowReschedule($candidateId)
    {
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_schedule_histories')
            ->join('psi.psy_schedules', 'psy_schedules.schedule_id', '=', 'psy_schedule_histories.schedule_id')
            ->where('psy_schedules.candidate_id', '=', $candidateId)
            ->whereIn('psy_schedule_histories.test_status', ['COMPLETE'])
            ->select(DB::raw('CASE WHEN psy_schedules.candidate_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
            ->get();
        return $isFuture;
    }

    public function scheduleByStatusPsikotes($paramFilter)
    {
        $applicant = DB::table('psi.mst_applicant')
            ->join('psi.psy_schedules', 'psy_schedules.candidate_id', '=', 'mst_applicant.candidate_id')
            ->join('psi.psy_schedule_histories', 'psy_schedule_histories.schedule_id', '=', 'psy_schedules.schedule_id')
            ->join(DB::raw("( select MAX(psy_schedule_histories.schedule_history_id) as schedule_history_id, mst_applicant.applicant_id from psi.mst_applicant
          inner join psi.psy_schedules on psy_schedules.candidate_id = mst_applicant.candidate_id
          inner join psi.psy_schedule_histories on psy_schedule_histories.schedule_id = psy_schedules.schedule_id
          group by mst_applicant.applicant_id ) as schedule_max"), function ($join) {

                $join->on("schedule_max.schedule_history_id", "=", "psy_schedule_histories.schedule_history_id");

            });
        if (isset($paramFilter)) {
            if (isset($paramFilter['cabangId'])) {
                if ($paramFilter['cabangId'] != null) {
                    $applicant->where('mst_applicant.CABANG_ID', '=', $paramFilter['cabangId']);
                }
            }
        }

        return $applicant;
    }

    public function countScheduleByStatusPsikotest($paramFilter)
    {
        $applicant = $this->scheduleByStatusPsikotes($paramFilter);
        return $applicant
            ->select(array('psy_schedule_histories.test_status', DB::raw('count(psy_schedule_histories.test_status) as total_test_status')))
            ->groupBy('psy_schedule_histories.test_status')
            ->get();
    }

    public function getScheduleByStatusPsikotes($paramFilter, $status)
    {
        $applicant = $this->scheduleByStatusPsikotes($paramFilter);
        return $applicant->where('psy_schedule_histories.test_status', '=', $status);
    }

    public function countResultByJob($paramFilter)
    {
        $applicant = DB::table('psi.psy_test_result')
            ->join('psi.mst_jobs', 'psy_test_result.job_id', '=', 'mst_jobs.job_id')
            ->join('psi.psy_schedules', 'psy_schedules.schedule_id', '=', 'psy_test_result.schedule_id')
            ->join('psi.psy_schedule_histories', 'psy_schedule_histories.schedule_history_id', '=', 'psy_test_result.schedule_history_id')
            ->join('psi.mst_applicant', 'psy_schedules.candidate_id', '=', 'mst_applicant.candidate_id')
            ->join(DB::raw("( select MAX(psy_schedule_histories.schedule_history_id) as schedule_history_id, mst_applicant.applicant_id from psi.mst_applicant
          inner join psi.psy_schedules on psy_schedules.candidate_id = mst_applicant.candidate_id
          inner join psi.psy_schedule_histories on psy_schedule_histories.schedule_id = psy_schedules.schedule_id
          group by mst_applicant.applicant_id ) as schedule_max"), function ($join) {

                $join->on("schedule_max.schedule_history_id", "=", "psy_schedule_histories.schedule_history_id");

            });
        if (isset($paramFilter)) {
            if (isset($paramFilter['cabangId'])) {
                if ($paramFilter['cabangId'] != null) {
                    $applicant->where('mst_applicant.CABANG_ID', '=', $paramFilter['cabangId']);
                }
            }
            if (isset($paramFilter['resultBySystem'])) {
                if ($paramFilter['resultBySystem'] != null) {
                    $applicant->where('psy_test_result.recomendation_by_system', '=', $paramFilter['resultBySystem']);
                }
            }
            if (isset($paramFilter['planDateFrom'])) {
                if ($paramFilter['planDateFrom'] != null) {
                    $applicant->where('psy_schedule_histories.PLAN_START_DATE', '>=', date("Y-m-d", strtotime($paramFilter['planDateFrom'])));
                }
            }
            if (isset($paramFilter['planDateTo'])) {
                if ($paramFilter['planDateTo'] != null) {
                    $applicant->where('psy_schedule_histories.PLAN_END_DATE', '<=', date("Y-m-d", strtotime($paramFilter['planDateTo'])));
                }
            }

        }
        $data = $applicant
            ->select(array('mst_applicant.candidate_id', 'mst_jobs.job_name', DB::raw('count(mst_jobs.job_name) as total_test_status')))
            ->groupBy('mst_applicant.candidate_id', 'mst_jobs.job_name')
            ->get();

        return $data;

        /*select mst_jobs.job_name, count(mst_jobs.job_name) from psy_test_result
        inner join mst_jobs on psy_test_result.job_id = mst_jobs.job_id
        inner join `psi`.`psy_schedules` on `psy_schedules`.`schedule_id`  = `psy_test_result`.`schedule_id`
        inner join `psi`.`psy_schedule_histories` on `psy_schedule_histories`.`schedule_history_id` = `psy_test_result`.`schedule_history_id`
        inner join `psi`.`mst_applicant` on `psy_schedules`.`candidate_id` = `mst_applicant`.`candidate_id`
        inner join ( select MAX(psy_schedule_histories.schedule_history_id) as schedule_history_id, mst_applicant.applicant_id from psi.mst_applicant
                inner join psi.psy_schedules on psy_schedules.candidate_id = mst_applicant.candidate_id
                inner join psi.psy_schedule_histories on psy_schedule_histories.schedule_id = psy_schedules.schedule_id
                  group by mst_applicant.applicant_id ) as schedule_max on `schedule_max`.`schedule_history_id` = `psy_schedule_histories`.`schedule_history_id`
        group by mst_jobs.job_name */
    }

    public function countResultByJobAndNetwork($paramFilter)
    {
        $applicant = DB::table('psi.psy_test_result')
            ->join('psi.mst_jobs', 'psy_test_result.job_id', '=', 'mst_jobs.job_id')
            ->join('psi.psy_schedules', 'psy_schedules.schedule_id', '=', 'psy_test_result.schedule_id')
            ->join('psi.psy_schedule_histories', 'psy_schedule_histories.schedule_history_id', '=', 'psy_test_result.schedule_history_id')
            ->join('psi.mst_applicant', 'psy_schedules.candidate_id', '=', 'mst_applicant.candidate_id')
            ->join(DB::raw("( select MAX(psy_schedule_histories.schedule_history_id) as schedule_history_id, mst_applicant.applicant_id from psi.mst_applicant
          inner join psi.psy_schedules on psy_schedules.candidate_id = mst_applicant.candidate_id
          inner join psi.psy_schedule_histories on psy_schedule_histories.schedule_id = psy_schedules.schedule_id
          group by mst_applicant.applicant_id ) as schedule_max"), function ($join) {

                $join->on("schedule_max.schedule_history_id", "=", "psy_schedule_histories.schedule_history_id");

            })
            ->join('psi.mst_networks', 'mst_networks.cabang_id', '=', 'mst_applicant.cabang_id');
        if (isset($paramFilter)) {
            if (isset($paramFilter['cabangId'])) {
                if ($paramFilter['cabangId'] != null) {
                    $applicant->where('mst_applicant.CABANG_ID', '=', $paramFilter['cabangId']);
                }
            }
            if (isset($paramFilter['resultBySystem'])) {
                if ($paramFilter['resultBySystem'] != null) {
                    $applicant->where('psy_test_result.recomendation_by_system', '=', $paramFilter['resultBySystem']);
                }
            }
            if (isset($paramFilter['planDateFrom'])) {
                if ($paramFilter['planDateFrom'] != null) {
                    $applicant->where('psy_schedule_histories.PLAN_START_DATE', '>=', date("Y-m-d", strtotime($paramFilter['planDateFrom'])));
                }
            }
            if (isset($paramFilter['planDateTo'])) {
                if ($paramFilter['planDateTo'] != null) {
                    $applicant->where('psy_schedule_histories.PLAN_END_DATE', '<=', date("Y-m-d", strtotime($paramFilter['planDateTo'])));
                }
            }

        }
        $data = $applicant
            ->select(array('mst_applicant.candidate_id', 'mst_jobs.job_id', 'mst_jobs.job_name', 'mst_networks.network', DB::raw('count(mst_jobs.job_name) as total_test_status')))
            ->groupBy('mst_applicant.candidate_id', 'mst_jobs.job_id', 'mst_jobs.job_name', 'mst_networks.network')
            ->get();

        return $data;


        /*select mst_jobs.job_name,mst_networks.network, count(mst_jobs.job_name) from psy_test_result
        inner join mst_jobs on psy_test_result.job_id = mst_jobs.job_id
        inner join `psi`.`psy_schedules` on `psy_schedules`.`schedule_id`  = `psy_test_result`.`schedule_id`
        inner join `psi`.`psy_schedule_histories` on `psy_schedule_histories`.`schedule_history_id` = `psy_test_result`.`schedule_history_id`
        inner join `psi`.`mst_applicant` on `psy_schedules`.`candidate_id` = `mst_applicant`.`candidate_id`
        inner join ( select MAX(psy_schedule_histories.schedule_history_id) as schedule_history_id, mst_applicant.applicant_id from psi.mst_applicant
                inner join psi.psy_schedules on psy_schedules.candidate_id = mst_applicant.candidate_id
                inner join psi.psy_schedule_histories on psy_schedule_histories.schedule_id = psy_schedules.schedule_id
                  group by mst_applicant.applicant_id ) as schedule_max on `schedule_max`.`schedule_history_id` = `psy_schedule_histories`.`schedule_history_id`
        join mst_networks on mst_networks.cabang_id = mst_applicant.cabang_id
        group by mst_jobs.job_name,mst_networks.network*/

    }

}
