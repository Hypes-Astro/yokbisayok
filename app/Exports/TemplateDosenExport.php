<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class TemplateDosenExport implements WithHeadings
{
    public function headings(): array
    {
        return [
            'npp',
            'nama',
            'bidang_kajian', // Should match 'RPLD' or 'SC'
            'kuota',
            'email',
            'telp',
        ];
    }
}
