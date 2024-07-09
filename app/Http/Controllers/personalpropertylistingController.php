<?php

namespace App\Http\Controllers;

use App\Imports\personalpropertylistingImport;
use Maatwebsite\Excel\Facades\Excel;
use Exception;



class PersonalPropertyListingController extends Controller
{
    

    public function import()
    {
        $filePath = "C:\Users\Ng Khai Sen\Documents\personal_property_listing.xlsx"; // Specify your file path here

        try {
            Excel::import(new personalpropertylistingImport, $filePath);
            return response()->json(['success' => 'Data imported successfully!'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error importing data: ' . $e->getMessage()], 500);
        }
    }
}
