<?php

namespace App\Exports;

use App\Models\Schooling;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SchoolingExport implements WithMultipleSheets
{
    private $start_date;
    private $end_date;

    public function __construct(string $start_date , string $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date   = $end_date;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets_name = ["RECAPITULATIF" , "SOLDE" , "NON SOLDE"  ,"STATISTIQUES"];

        foreach ($sheets_name as $key => $sheet_name) {
            $sheets[] = new SchoolingSheet($sheet_name , $this->start_date , $this->end_date);
        }

        return $sheets;
    }
}
