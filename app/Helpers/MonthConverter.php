<?php
namespace App\Helpers;

class MonthConverter {

    /**
     * @param int $number of month
     * 
     * @return string 
     * 
     */

    public static function monthToString($number) {
        switch ($number) {
            case '01':
                $month = 'Janvier' ;
                break;
            case '02':
                $month = 'Février' ;
                break;
            case '03':
                $month = 'Mars' ;
                break;
            case '04':
                $month = 'Avril' ;
                break;
            case '05':
                $month = 'Mai' ;
                break;
            case '06':
                $month = 'Juin' ;
                break;
            case '07':
                $month = 'Juillet' ;
                break;
            case '08':
                $month = 'Août' ;
                break;
            case '09':
                $month = 'Septembre' ;
                break;
            case '10':
                $month = 'Octobre' ;
                break;
            case '11':
                $month = 'Novembre' ;
                break;
            case '12':
                $month = 'Décembre' ;
                break;
            default:
                $month = "Unknow" ;
                break;
        }

        return $month ;
    }


    public static function stringToMonth($string) {
        switch ($string) {
            case 'Janvier':
                $month = '01' ;
                break;
            case 'Février':
                $month = '02' ;
                break;
            case 'Mars':
                $month = '03' ;
                break;
            case 'Avril':
                $month = '04' ;
                break;
            case 'Mai':
                $month = '05' ;
                break;
            case 'Juin':
                $month = '06' ;
                break;
            case 'Juillet':
                $month = '07' ;
                break;
            case 'Août':
                $month = '08' ;
                break;
            case 'Septembre':
                $month = '09' ;
                break;
            case 'Octobre':
                $month = '10' ;
                break;
            case 'Novembre':
                $month = '11' ;
                break;
            case 'Décembre':
                $month = '12' ;
                break;
            default:
                $month = "00" ;
                break;
        }

        return $month ;
    }
}