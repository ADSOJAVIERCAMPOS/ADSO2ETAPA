<?php

namespace App\Imports;

use App\Models\Courses;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CoursesImport implements ToCollection, WithHeadingRow
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Courses::updateOrCreate(
                ['name_course' => $row['name_course']], // Clave de búsqueda o identificación única
                [
                    'description_course' => $row['description_course'] ?? null,
                    'acronym' => $row['acronym'] ?? null,
                    'state_course' => $row['state_course'] ?? null,
                    'category_id' => $row['category_id'] ?? null
                ]
            );
        }
    }
}
