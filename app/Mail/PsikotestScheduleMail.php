<?php

namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
 
class PsikotestScheduleMail extends Mailable
{
    use Queueable, SerializesModels;
    public $applicantName;
    public $planStartDate;
    public $planEndDate;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($applicantName,$planStartDate,$planEndDate)
    {
        $this->applicantName = $applicantName;
        $this->planStartDate = $planStartDate;
        $this->planEndDate = $planEndDate;

    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $param['NamaKandidat'] =  $this->applicantName;
        $param['PlanStartDate'] =  $this->planStartDate;
        $param['PlanEndDate'] =  $this->planEndDate;
        return $this->from('psikotest-noreplay@gawe.id')->view('mail.PsikotestScheduleTemplateMail',$param);
    }
}