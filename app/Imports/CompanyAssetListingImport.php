<?php

namespace App\Imports;

use App\Models\CompanyAssetListing;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;
class CompanyAssetListingImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
{
    private $propertyTypeMap = [
        'Factory/Warehouse' => 1,
        'Terrace/Link/Townhouse' => 2,
        'Shop/Office/Retail Space' => 3,
        'Condo/Service Residence' => 4,
        'Agriculture Land' => 5,
        'Commercial Land' => 6,
        'Industrial Land' => 7,
        'Semi-D/Bungalow' => 8,
        'Commercial Shoplot' => 9,
        'Warehouse' => 10,
        'Office Space' => 11,
        'Factory Space' => 12,
        'Four Storey Shopoffice' => 13,
        'Unidentified' => 14,
        'Land' => 15,
        'Residential Land' => 16,
        'Retail Mall' => 17,
    ];

    private $propertyTenureMap =[
        'Freehold' => 1,
        'Leasehold' => 2,
        'Unidentified' => 3,
    ];

    private $propertyStatusMap =[
        'OCCUPIED' => 1,
        'SOLD' => 2,
        'TRANSFERRED' => 3,
        'VACANT' => 4,
        'RENTED' => 5,
        'LITIGATION' => 6,
        'UNIDENTIFIED' => 7,
    

    ];
    private $propertyCategoryMap=[
        'Agriculture' => 1,
        'Commercial' => 2,
        'Industrial' => 3,
        'Residential' => 4,
        'Unidentified' =>5,

    ];

    private $propertyActionMap =[
        'KEEP' => 1,
        'SALE' => 2,
        'RENT' => 3,
        'SOLD' => 4,
        'TO KIP' =>5,
        'TO PRIVATE' => 6,
        'TO SWS' => 7,
        'RENEWED'=> 8,
        'UNIDENTIFIED' => 9,

    ];

    
    public function model(array $row)
    {
        
        
        
        return new CompanyAssetListing([
            'file_id' => $row['file_id'],
            'purchase_date' => $this->transformDate($row['purchase_date']),
            'uuid' => (string) Str::uuid(),
            
            'property_type_id' => $this->propertyTypeMap[$row['type']] ?? null,
            'property_tenure_id' => $this->propertyTenureMap[$row['tenure']] ?? null,
            'property_category_id' => $this->propertyCategoryMap[$row['category_of_use']] ?? null,
            'property_status_id' => $this->propertyStatusMap[$row['status']] ?? null,
            'property_action_id' => $this->propertyActionMap[$row['action']] ?? null,
            'details' => $row['details'],
            'address_1' => $row['address_1'],
            'address_2' => $row['address_2'],
            'address_3' => $row['address_3'],
            'postcode' => $row['postcode'],
            'city' => $row['city'],
            'state' => $row['state'],
            'purchase_value_psf' => $row['purchase_value_psf'],
            'purchase_value_total' => $row['purchase_value_total'],
            'nbv_value' => $row['nbv_value'],
            'revaluation_date' => $this->transformDate($row['revaluation_date']),
            'remarks' => $row['remark'],
            'is_active' => true, 
            'created_by' => 'eden', 
            'updated_by' => 'eden',
            'created_at' => now(),
            'updated_at' => now(),
            'is_malaysia' => $row['is_malaysia'] == 1 ? true : false,
            'is_personal' => $row['is_personal'] == 0 ? false : true,
            'is_compliance' => false, 
            'compliance_remark' => null, 
            'utilize_building_size' => null,
            'utilize_land_size' => null,
            'utilize_building_size_value_type' => 0, 
            'utilize_land_size_value_type' => 1, 
            'market_value' =>  $row['sold_price_rm'], 
            'land_size' => $row['land_size_acres'], 
            'building_size' => $row['building_land_sqft'], 
            'land_size_value_type' => 1, 
            'building_size_value_type' => 0, 
            'lease_hold_expired_date' => null, 
            'hak_milik_id' => null,
            'lot_id' => null, 
            'bandar_pekan_mukim' => null, 
        ]);
    }
 /**
     * Transform the date value to Carbon instance or return null.
     *
     * @param  mixed $value
     * @return \Carbon\Carbon|null
     */
    private function transformDate($value)
    {
        return $value ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)) : null;
    }

    public function rules(): array
    {
        return [
            '*.file_id' => ['required', 'string'],
            '*.purchase_date' => ['required', 'integer'], 
            '*.company' => ['required', 'string'],
            '*.type' => ['required', 'string'],
            '*.details' => ['required', 'string'],
            '*.tenure' => ['nullable', 'string'],
            '*.category_of_use' => ['nullable', 'string'],
            '*.land_size_acres' => ['nullable', 'numeric'],
            '*.building_land_sqft' => ['nullable', 'numeric'],
            '*.purchase_value_psf' => ['nullable', 'numeric'],
            '*.purchase_value_total' => ['nullable', 'numeric'],
            '*.nbv_value' => ['nullable', 'numeric'],
            '*.revaluation_date' => ['nullable', 'integer'],
            '*.psf_revaluation_rm' => ['nullable', 'numeric'],
            '*.total_revaluation_rm' => ['nullable', 'numeric'],
            '*.sold_price_rm' => ['nullable', 'numeric'],
            '*.status' => ['required', 'string'],
            '*.action' => ['nullable', 'string'],
            '*.sold_price' => ['nullable', 'numeric'],
            '*.estimated_rental' => ['nullable', 'numeric'],
            '*.estimated_rental_per_mth_rm' => ['nullable', 'numeric'],
            '*.estimated_rental_per_yr_rm' => ['nullable', 'numeric'],
            '*.yield_percentage' => ['nullable', 'numeric'],
            '*.insurance' => ['nullable', 'string'],
            '*.lease_years' => ['nullable', 'numeric'],
            '*.remaining_lease' => ['nullable', 'numeric'],
            '*.grade' => ['nullable', 'string'],
            '*.remark' => ['nullable', 'string'],
            '*.address_1' => ['required', 'string'],
            '*.address_2' => ['nullable', 'string'],
            '*.address_3' => ['nullable', 'string'],
            '*.postcode' => ['required', 'integer'],
            '*.city' => ['required', 'string'],
            '*.state' => ['required', 'string'],
            '*.is_malaysia' => ['required', 'boolean'],
        ];
    }

    public function chunkSize(): int
    {
        return 1000; // Adjust chunk size as needed
    }
}
