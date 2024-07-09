<?php

namespace App\Imports;

use App\Models\personalpropertylisting;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
class personalpropertylistingImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
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
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new personalpropertylisting([
            'file_id' => $row['file_no'],
            'uuid' => (string) Str::uuid(),
            'purchase_date' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject( $row['date_of_purchase'])),
            
            'details' => $row['property_details'],
            'address_1' => $row['address_1'],
            'address_2' => $row['address_2'],
            'address_3' => $row['address_3'],
            'postcode' => $row['postcode'],
            'city' => $row['city'],
            'state' => $row['state'],
            
            
            'land_size' => $row['land_size'],
            'building_size' => $row['building_size'],
            'purchase_value_psf' => $row['psf_purchase_value'],
            'purchase_value_total' => $row['total_purchase_value'],
            'nbv_value' => $row['total_nbv'],
            
            
            
            
            
            
            
            'is_malaysia' => $row['is_malaysia'] == 0 ? false : true,
            'is_personal' => $row['is_personal'] == 1 ? true : false,
            'property_type_id' => $this->propertyTypeMap[$row['type']] ?? null, 
            'property_tenure_id' => $this->propertyTenureMap[$row['tenure']] ?? null, 
            'property_category_id' => $this->propertyCategoryMap[$row['category_of_use']] ?? null,
            'property_status_id' => $this->propertyStatusMap[$row['status']] ?? null, 
            'property_action_id' => $this->propertyActionMap[$row['action']] ?? null, 
            'created_by' => 'eden', 
            'updated_by' => 'eden',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function rules(): array
    {
        return [
            '*.file_no' => ['nullable', 'string'],
            '*.date_of_purchase' => ['nullable', 'integer'],
            '*.type' => ['nullable', 'string'],
            '*.property_details' => ['nullable', 'string'],
            '*.address_1' => ['nullable', 'string'],
            '*.address_2' => ['nullable', 'string'],
            '*.address_3' => ['nullable', 'string'],
            '*.postcode' => ['nullable', 'integer'],
            '*.city' => ['nullable', 'string'],
            '*.state' => ['nullable', 'string'],
            '*.tenure' => ['nullable', 'string'],
            '*.category_of_use' => ['nullable', 'string'],
            '*.land_size' => ['nullable', 'numeric'],
            '*.building_size' => ['nullable', 'integer'],
            '*.psf_purchase_value' => ['nullable', 'numeric'],
            '*.total_purchase_value' => ['nullable', 'numeric'],
            '*.total_nbv' => ['nullable', 'numeric'],
            '*.on_date' => ['nullable', 'date'],
            '*.psf_revaluation' => ['nullable', 'numeric'],
            '*.total_revaluation' => ['nullable', 'numeric'],
            '*.sold_price' => ['nullable', 'numeric'],
            '*.status' => ['nullable', 'string'],
            '*.action' => ['nullable', 'string'],
            '*.remark' => ['nullable', 'string']
        ];
    }
    public function chunkSize(): int
    {
        return 100; // Define a suitable chunk size
    }
    
}
