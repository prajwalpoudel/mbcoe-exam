<?php


namespace App\Exports\Sheets;


use App\Models\Batch;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder;
use Laravel\Scout\Builder as ScoutBuilder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class BatchSheet implements FromQuery, WithTitle, WithMapping
{

    public function query()
    {
        return Batch::query();
    }

    public function title(): string
    {
        return 'batches';
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->id,
        ];
    }
}
