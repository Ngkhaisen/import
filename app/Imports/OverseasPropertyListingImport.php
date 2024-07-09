<?php

namespace App\Imports;



use App\Models\OverseasPropertyListing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;

class OverseasPropertyListingImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
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
        return new OverseasPropertyListing([
            'file_id' => $row['file_no'],
            'uuid' => (string) Str::uuid(),
            'purchase_date' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject( $row['date_of_purchase'])),
            // 'company' => $row['co'],
            // 'type' => $row['type'],
            'details' => $row['property_details'],
            'address_1' => $row['address_1'],
            'address_2' => $row['address_2'],
            'address_3' => $row['address_3'],
            'city' => $row['city'],
            'state' => $row['state'],
            // 'country' => $row['country'],
            // 'tenure' => $row['tenure'],
            // 'category_of_use' => $row['category_of_use'],
            'land_size' => $row['land_size_acre'],
            'building_size' => $row['building_size_sqft'],
            'purchase_value_psf' => $row['psf_purchase_value_rm'],
            'purchase_value_total' => $row['total_purchase_value_rm'],
            'nbv_value' => $row['nbv_rm'],
            'revaluation_date' =>$this->transformDate($row['date_of_revaluation']),
            // 'revaluation_psf' => $row['psf_revaluation_rm'],
            // 'revaluation_total' => $row['total_revaluation_rm'],
            // 'sold_price' => $row['sold_price'],
            // 'status' => $row['status'],
            // 'action' => $row['action'],
            // 'remark' => $row['remark'],
            'is_malaysia' => $row['is_malaysia'] == 0 ? false : true,
            'is_personal' => $row['is_personal'] == 0 ? false : true,
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
            '*.file_no' => ['required', 'string'],
            '*.date_of_purchase' => ['required', 'integer'],
            '*.co' => ['required', 'string'],
            '*.type' => ['required', 'string'],
            '*.property_details' => ['required', 'string'],
            '*.address_1' => ['required', 'string'],
            '*.address_2' => ['nullable', 'string'],
            '*.address_3' => ['nullable', 'string'],
            '*.city' => ['required', 'string'],
            '*.state' => ['required', 'string'],
            '*.country' => ['required', 'string'],
            '*.tenure' => ['nullable', 'string'],
            '*.category_of_use' => ['nullable', 'string'],
            '*.land_size_acre' => ['nullable', 'numeric'],
            '*.building_size_sqft' => ['nullable', 'numeric'],
            '*.psf_purchase_value_rm' => ['nullable', 'numeric'],
            '*.total_purchase_value_rm' => ['nullable', 'numeric'],
            '*.nbv_rm' => ['nullable', 'numeric'],
            '*.date_of_revaluation' => ['nullable', 'date'],
            '*.psf_revaluation_rm' => ['nullable', 'numeric'],
            '*.total_revaluation_rm' => ['nullable', 'numeric'],
            '*.sold_price' => ['nullable', 'numeric'],
            '*.status' => ['required', 'string'],
            '*.action' => ['nullable', 'string'],
            '*.remark' => ['nullable', 'string'],
            '*.is_malaysia' => ['required', 'boolean'],
        ];
    }
    public function chunkSize(): int
    {
        return 100; // Define a suitable chunk size
    }
}

