<?php
namespace App\Helpers;

class DayConverter {

    /**
     * @param int $number of month
     * 
     * @return string 
     * 
     */

    public static function DayToString($number) {
        switch ($number) {
            case 1:
                $day = 'Lundi' ;
                break;
            case 2:
                $day = 'Mardi' ;
                break;
            case 3:
                $day = 'Mercredi' ;
                break;
            case 4:
                $day = 'Jeudi' ;
                break;
            case 5:
                $day = 'Vendredi' ;
                break;
            case 6:
                $day = 'Samedi' ;
                break;
            case 0:
                $day = 'Dimanche' ;
                break;
            default:
                $day = "Unknow" ;
                break;
        }

        return $day ;
    }


    public static function stringToDay($string) {
        switch ($string) {
            case 'Lundi':
                $day = 1 ;
                break;
            case 'Mardi':
                $day = 2 ;
                break;
            case 'Mercredi':
                $day = 3 ;
                break;
            case 'Jeudi':
                $day = 4 ;
                break;
            case 'Vendredi':
                $day = 5 ;
                break;
            case 'Samedi':
                $day = 6 ;
                break;
            case 'Dimanche':
                $day = 0 ;
                break;
            default:
                $day = "Unknow" ;
                break;
        }

        return $day ;
    }
}