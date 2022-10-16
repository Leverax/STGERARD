<?php

namespace App\Exports;

use App\Helpers\State;
use App\Models\Expense;
use App\Models\Recipe;
use App\Models\Schooling;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class SchoolingSheet implements  FromView, WithTitle , WithStyles , WithColumnWidths
{
    private $sheet_name;
    private $start_date;
    private $end_date;

    public function __construct(string $sheet_name , string $start_date , string $end_date)
    {
        $this->sheet_name = $sheet_name;
        $this->start_date = $start_date;
        $this->end_date   = $end_date;
    }

    public function view(): View
    {
        if ($this->sheet_name == 'SOLDE') {
            $schoolings_sold = Schooling::where('rest' , '<=' , 0)
                                    ->whereBetween('created_at' , [date('Y-m-d 00:00:00' , strtotime($this->start_date)) , date('Y-m-d 23:59:59' , strtotime($this->end_date))])
                                    ->get();
            return view('exports.schooling', [
                'schoolings_sold'   => $schoolings_sold,
                'start_date'        => $this->start_date,
                'end_date'          => $this->end_date,
            ]);
        }elseif ($this->sheet_name == 'NON SOLDE') {
            $schoolings_unsold = Schooling::where('rest' , '>' , 0)
                                    ->whereBetween('created_at' , [date('Y-m-d 00:00:00' , strtotime($this->start_date)) , date('Y-m-d 23:59:59' , strtotime($this->end_date))])
                                    ->get();
            return view('exports.schooling', [
                'schoolings_unsold' => $schoolings_unsold,
                'start_date'        => $this->start_date,
                'end_date'          => $this->end_date,
            ]);
        }elseif ($this->sheet_name == 'RECAPITULATIF') {
            $schoolings_recap = Schooling::whereBetween('created_at' , [date('Y-m-d 00:00:00' , strtotime($this->start_date)) , date('Y-m-d 23:59:59' , strtotime($this->end_date))])
                                ->get();
            return view('exports.schooling', [
                'schoolings_recap'  => $schoolings_recap,
                'start_date'        => $this->start_date,
                'end_date'          => $this->end_date,
            ]);
        
        }elseif ($this->sheet_name == 'STATISTIQUES') {
            return view('exports.statistics' , [
                'register'  => State::registerByPeriod($this->start_date , $this->end_date),
                'sold'      => State::soldByPeriod($this->start_date , $this->end_date),
                'unsold'    => State::unsoldByPeriod($this->start_date , $this->end_date),
                'backward'  => State::backwardByPeriod($this->start_date , $this->end_date),
                'amount'    => State::amountByPeriod($this->start_date , $this->end_date),
                
                'start_date'    => $this->start_date,
                'end_date'      => $this->end_date,
            ]);
        }

        
        
    }

    public function styles(Worksheet $sheet)
    {
        if ($this->sheet_name == 'STATISTIQUES') {
            return [
                // Style the first row as bold text.
                1    => ['font' => ['bold' => true , 'size' => "15"]],
                3    => ['font' => ['bold' => true , 'size' => "13"]],
                4    => ['font' => ['bold' => true , 'size' => "13"]],
            ];
        }else{
            return [
                // Style the first row as bold text.
                1    => ['font' => ['bold' => true , 'size' => "15"]],
                3    => ['font' => ['bold' => true , 'size' => "13"]],
            ];
        }
    }

    public function columnWidths(): array
    {
        if ($this->sheet_name == 'STATISTIQUES') {
            return [
                'A' => 10,
                'B' => 9,
                'C' => 13,
                'D' => 13,
                'E' => 22,
                'F' => 22,
                'G' => 22,
                'H' => 22,
                'I' => 30,
            ];
        }else{
            return [
                'A' => 5,
                'B' => 18,
                'C' => 33,
                'D' => 19,
                'E' => 19,
                'F' => 19,
                'G' => 19,
                'H' => 19,
                'I' => 8,
                'J' => 18,
                'K' => 20,
            ];
        }
        
    }
    
    public function title(): string
    {
        return $this->sheet_name;
    }
}
