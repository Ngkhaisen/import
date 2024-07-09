<?php
namespace App\Http\Controllers;

use App\Imports\CompanyAssetListingImport;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class CompanyAssetListingController extends Controller
{
    

    public function import()
    {
        $filePath = "C:\Users\Ng Khai Sen\Documents\malaysia_property_listing.xlsx"; 

        try {
            Excel::import(new CompanyAssetListingImport, $filePath);
            return response()->json(['success' => 'Data imported successfully!'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error importing data: ' . $e->getMessage()], 500);
        }
    }
}

