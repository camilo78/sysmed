<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PatientsExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('patients')->select(
            'name1',
            'name2',
            'surname1',
            'surname2',
            'married_name',
            'gender',
            'birth',
            'patient_code',
            'document',
            'phone1',
            'phone2',
            'email',
            'city_town',
            'address'
        )->get();
    }
    public function headings(): array
        {
            return [
                'Primer Nombre',
                'Segundo Nombre',
                'Primer Apellido',
                'Segundo Apellido',
                'A. Casada',
                'Sexo',
                'F. Nacimiento',
                'Código Paciente',
                'Documento',
                'Teléfono 1',
                'Teléfono 2',
                'Email',
                'País',
                'Dirección'
            ];
        }

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
