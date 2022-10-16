<?php

namespace App\Helpers;


class FormatNumberToLetter{

    public static function convertorNumberToLetterOrder($number){
        switch ($number) {
            case 1:
                return 'Premier';
                break;
            case 2:
                return 'Deuxième';
                break;
            case 3:
                return 'Troisième';
                break;
            case 4:
                return 'Quatrième';
                break;
            case 5:
                return 'Cinquième';
                break;
            case 6:
                return 'Sixième';
                break;
            case 7:
                return 'Septième';
                break;
            case 8:
                return 'Huitième';
                break;
            case 9:
                return 'Neuvième';
                break;
            case 10:
                return 'Dixième';
                break;
            default:
                return 'Autre';
                break;
        }
    }

    public static function convertorNumberToString($number){

        $formatter = \NumberFormatter::create('fr_FR', \NumberFormatter::SPELLOUT);
        $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
        $formatter->setAttribute(\NumberFormatter::ROUNDING_MODE, \NumberFormatter::ROUND_HALFUP);
        $montant_lettre = $formatter->format($number);

        return $montant_lettre;
    }

    public static function formatNumber($number){
        return number_format( $number , 0 , '' , ' ');
    } 
}