<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ruta al archivo Excel/ODS
        $filePath = storage_path('app/Cursos1.xlsx'); 

        // Cargar el archivo Excel usando PhpSpreadsheet
        $spreadsheet = IOFactory::load($filePath);

        // Seleccionar la primera hoja del Excel
        $sheet = $spreadsheet->getActiveSheet();

        // Iterar sobre cada fila de la hoja
        foreach ($sheet->getRowIterator(1) as $row) { // Comienza desde la fila 2 para omitir encabezados
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // Incluye celdas vacías

            $nameCategory = null;
            $currentColumnIndex = 1; // Contador para identificar la columna

            // Iterar sobre las celdas de la fila actual
            foreach ($cellIterator as $cell) {
                if ($currentColumnIndex == 2) { // columna B
                    $nameCategory = $cell->getValue(); // Obtener el valor de la columna 
                    break;
                }
                $currentColumnIndex++;
            }

            // Solo insertar si nameCategory no es nulo o vacío
            if (!empty($nameCategory)) {
                DB::table('categories')->updateOrInsert(
                    ['name_category' => $nameCategory], // Verifica si la categoría ya existe
                    [
                        'description_category' => 'Descripción predeterminada', // Valor predeterminado
                    ]
                );
            }
        }
    }
}
