<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ruta al archivo Excel/ODS
        $filePath = storage_path('app/Cursos1.xlsx'); 

         // Establecer un límite de memoria más alto solo para este script
        ini_set('memory_limit', '2G');

        // Cargar el archivo Excel usando PhpSpreadsheet
        $spreadsheet = IOFactory::load($filePath);

        // Seleccionar la primera hoja del Excel
        $sheet = $spreadsheet->getActiveSheet();

        // Iterar sobre cada fila de la hoja
        foreach ($sheet->getRowIterator(1) as $row) { // Comienza desde la fila 2 para omitir encabezados
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // Incluye celdas vacías

            $nameCourse = null;
            $categoryName = null;
            $descriptionCourse = null;
            $acronym = null;
            $currentColumnIndex = 1; // Contador para identificar la columna

            // Iterar sobre las celdas de la fila actual
            foreach ($cellIterator as $cell) {
                switch ($currentColumnIndex) {
                    case 2: // columna B para la categoría
                        $categoryName = $cell->getValue();
                        break;
                    case 4: // columna D para el curso
                        $nameCourse = $cell->getValue();
                        break;
                    case 5: // columna E para la descripción
                        $descriptionCourse = $cell->getValue();
                        break;
                    case 6: // columna E para la acronimo
                        $acronym = $cell->getValue();
                }
                $currentColumnIndex++;
            }

            // Solo insertar si nameCourse y categoryName no son nulos o vacíos
            if (!empty($nameCourse) && !empty($categoryName)) {
                // Obtener el ID de la categoría
                $categoryId = DB::table('categories')
                    ->where('name_category', $categoryName)
                    ->value('id_category'); // Suponemos que el campo de ID en la tabla 'categories' es 'id_category'

                // Si se encontró la categoría
                if ($categoryId) {
                    DB::table('courses')->updateOrInsert(
                        ['name_course' => $nameCourse], // Verifica si el curso ya existe
                        [
                            'description_course' => $descriptionCourse ?? 'Sin descripción', // Obtener la descripción desde el Excel o asignar valor predeterminado
                            'acronym' => $acronym ?? 'sin acronimo', // obtener acronimo en el excel
                            'category_id' => $categoryId, // Asignar el ID de la categoría correcta
                        ]
                    );
                }
            }
        }
    }
}
