<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class TemplateMahasiswaExport implements WithHeadings
{
    public function headings(): array
    {
        return [
            'nim',
            'nama',
            'email',
            'status_kp'
        ];
    }
}
