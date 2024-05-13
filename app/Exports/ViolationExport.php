<?php

namespace App\Exports;

use App\Models\Violation;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ViolationExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Violation::withTrashed()->get();
    }
    // titles
    public function headings(): array
    {
        return [
            'id',
            'name',
            'type',
            'description',
            'penalty_type',
            'submission_status',
        ];
    }
}
