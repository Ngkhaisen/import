<?php

namespace App\Http\Controllers;

use App\Imports\LetPropertyListingImport;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class LetPropertyListingController extends Controller
{
    public function import()
    {
        $filePath = "C:\Users\Ng Khai Sen\Documents\let_property_listing.xlsx"; 

        try {
            Excel::import(new LetPropertyListingImport, $filePath);
            return response()->json(['success' => 'Data imported successfully!'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error importing data: ' . $e->getMessage()], 500);
        }
    }
}


