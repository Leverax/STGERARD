<?php

namespace App\Exports;

use App\Models\Schooling;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SchoolingSortExport implements FromView , WithStyles , WithColumnWidths
{
    private $academic_year;
    private $classrooms;
    private $classroom_name;

    public function __construct($academic_year , $classrooms , $classroom_name)
    {
        $this->academic_year = $academic_year;
        $this->classrooms = $classrooms;
        $this->classroom_name = $classroom_name;
    }
    
    public function view(): View
    {
        $classroom_arr = [];
        foreach ($this->classrooms as $key => $classroom) {
            array_push($classroom_arr , $classroom->id);
        }
        
        if (count($classroom_arr) == 1) {
            $schoolings = Schooling::where('academic_years_id' , $this->academic_year->id)->where('classrooms_id' , $classroom_arr)->get();
        }else{
            $schoolings = Schooling::where('academic_years_id' , $this->academic_year->id)->whereBetween('classrooms_id' , $classroom_arr)->get();
        }
        
        return view('exports.sortSchooling' , [
            'schoolings'     => $schoolings,
            'classroom_name' => $this->classroom_name,
            'academic_year'  => $this->academic_year,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true , 'size' => "15"]],
            3    => ['font' => ['bold' => true , 'size' => "13"]],
        ];
    }

    public function columnWidths(): array
    {
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
