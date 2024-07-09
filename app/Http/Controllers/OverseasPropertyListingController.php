<?php

namespace App\Http\Controllers;

use App\Imports\OverseasPropertyListingImport;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class OverseasPropertyListingController extends Controller
{

    public function import()
    {
        $filePath = "C:\Users\Ng Khai Sen\Documents\oversea_property_listing.xlsx"; // Specify your file path here

        try {
            Excel::import(new OverseasPropertyListingImport, $filePath);
            return response()->json(['success' => 'Data imported successfully!'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error importing data: ' . $e->getMessage()], 500);
        }
    }
}


