<?php


namespace App\Exports\Sheets;


use App\Models\Faculty;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class FacultySheet implements FromQuery, WithTitle, WithMapping
{

    public function query()
    {
        return Faculty::query();
    }

    public function title(): string
    {
        return 'faculties';
    }

    public function map($faculty): array
    {
        return [
            $faculty->name,
            $faculty->id,
        ];
    }
}
