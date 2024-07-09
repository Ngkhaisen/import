<?php

namespace App\Imports;

use App\Models\TenantedPropertyListing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Str;
class TenantedPropertyListingImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
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
    public function model(array $row)
    {
        return new TenantedPropertyListing([
            'file_id' => $row['file_ref'] ?? null,
            'uuid' => (string) Str::uuid(),
            'year' => $row['year'],
            'landlord' => $row['landlord'],
            'company' => $row['company'],
            'type' => $row['type'],
            'details' => $row['property_details'],
            'address_1' => $row['address_1'],
            'address_2' => $row['address_2'] ?? null,
            'address_3' => $row['address_3'] ?? null,
            'postcode' => $row['postcode'],
            'city' => $row['city'],
            'state' => $row['state'],
            'date_commencement' => Date::excelToDateTimeObject($row['date_of_commencement']),
            'date_expired' => Date::excelToDateTimeObject($row['date_of_expiry']),
            'tenure_year' => $row['tenure_year'],
            'rental_payment' => $row['rental_payment'],
            'purpose' => $row['purpose'] ?? null,
            'remarks' => $row['remarks'] ?? null,
            'property_type_id' => $this->propertyTypeMap[$row['type']] ?? null, 
            'created_by' => 'eden', 
            'updated_by' => 'eden',
            'created_at' => now(),
            'updated_at' => now(),
            'is_personal' => $row['is_personal'] == 0 ? false : true,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.file_ref' => ['nullable', 'string'],
            '*.year' => ['required', 'integer'],
            '*.landlord' => ['required', 'string'],
            '*.company' => ['required', 'string'],
            '*.type' => ['required', 'string'],
            '*.property_details' => ['required', 'string'],
            '*.address_1' => ['required', 'string'],
            '*.address_2' => ['nullable', 'string'],
            '*.address_3' => ['nullable', 'string'],
            '*.postcode' => ['required', 'integer'],
            '*.city' => ['required', 'string'],
            '*.state' => ['required', 'string'],
            '*.date_of_commencement' => ['required', 'integer'],
            '*.date_of_expiry' => ['required', 'integer'],
            '*.tenure_year' => ['required', 'integer'],
            '*.rental_payment' => ['required', 'numeric'],
            '*.purpose' => ['nullable', 'string'],
            '*.remarks' => ['nullable', 'string'],
        ];
    }

    public function chunkSize(): int
    {
        return 100;
    }
}

