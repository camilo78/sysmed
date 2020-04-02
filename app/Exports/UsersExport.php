<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')->select('name', 'email','phone', 'address','date')->get();
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Email',
            'Teléfono',
            'Dirección',
            'Fecha de Nacimiento'
        ];
    }

     // ...

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
