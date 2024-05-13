<?php

namespace App\Exports;

use App\Models\Violation;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportViolationsQuery implements FromQuery, WithHeadings
{
    use Exportable;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        return Violation::query()->where('id', $this->id);
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
