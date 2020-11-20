<?php

namespace App\Service;

class PaymentCalendar
{
    private $daysNum = [1,2,3,4,5,6,7,8,9,10,11,12];

    private $months = ["01","02","03","04","05","06","07","08","09","10","11","12"];

    private $headers = ['Month', 'Name Day', 'Num Day'];

    public function getHeaders()
    {
        return $this->headers;
    }

    private function getCurrentYear()
    {
        return date("Y");
    }

    private function numOfMonthDays()
    {
        $daysNum = $this->daysNum;
        $array = [];
        foreach($daysNum as $num){
            $number = cal_days_in_month(CAL_GREGORIAN, $num, $this->getCurrentYear());
            $array[] = $number;
        }
        return array_combine($this->months,$array);
    }

    private function nameOfMonthDays()
    {
        $year = $this->getCurrentYear();
        $numDays = $this->numOfMonthDays();
        $array = [];
        foreach($numDays as $key=> $day) {
            $array[] = date('D', mktime(0, 0, 0, $key, $day, $year));
        }
        return array_combine($this->months,$array);
    }

    private function getPaymentDays()
    {
        $year = $this->getCurrentYear();
        $numDays = $this->numOfMonthDays();
	$data = [];
        foreach($numDays as $month=>$num){
            for ($i = 1; $i <= $num; $i++) {
                $date = $year.'/'.$month.'/'.$i;
                $get_name = date('l', strtotime($date));
                $day_name = substr($get_name, 0, 3);
                if($day_name != 'Sun' && $day_name != 'Sat'){
                    $data[$month]['month'] = $month;
                    $data[$month]['nameDay'] = $day_name;
                    $data[$month]['numDay'] = $i;
                }
            }
        }
        return $data;
    }

    public function getAllPaymentDays()
    {
        $paymentDays = $this->getPaymentDays();
        return $paymentDays;
    }
}
