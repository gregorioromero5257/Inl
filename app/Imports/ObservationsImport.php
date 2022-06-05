<?php

namespace App\Imports;

use App\Observation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
HeadingRowFormatter::default('none');

class ObservationsImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        return new Observation([
            'state_id' => $row['estado_id'],
            'headquarter_id' => $row['sede_id'],
            'decision_id' => $row['decision_id'],
            'ambit_id' => $row['ambito_id'],
            'criterion_id' => $row['criterio_id'],
            'source_id' => $row['fuente_id'],
            'observation' => $row['Observaciones por fuente'],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
