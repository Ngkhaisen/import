<?php

namespace App\Http\Controllers;

use App\Imports\HextarUserDatasetImport;
use Maatwebsite\Excel\Facades\Excel;
use Exception;


class HextarDatasheetController extends Controller
{
    public function import()
    {
        $filePath = "C:\Users\Ng Khai Sen\Documents\hextar_dataset_combine.xlsx";

        try {
            Excel::import(new HextarUserDatasetImport, $filePath);
            return response()->json(['success' => 'Data imported successfully!'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error importing data: ' . $e->getMessage()], 500);
        }
    }
}

