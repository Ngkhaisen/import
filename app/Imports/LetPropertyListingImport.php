<?php

namespace App\Imports;

use App\Models\LetPropertyListing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Illuminate\Support\Str;

class LetPropertyListingImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
{

    
    public function model(array $row)
    {
        if(isset($row['date_of_rental'])) {
            $date = $row['date_of_rental'];
        }
        else {
            $date = null;
        }
        
        return new LetPropertyListing([
            'fk_asset_id' => $row['file_no'],
            'uuid' => (string) Str::uuid(),
           'customer' => $row['company'],
            'need_reminder' => $row['need_reminder'] == 0 ? false : true,
            'reminder_date' => $this->transformDate($row['expiry_date']),
            'rental_value_psf' => $row['psf_rental_value'],
            'rental_value_total' => $row['total_rental_value'],
            'rental_size' => $row['size'],
            'rental_date' => $this->transformDate($date),
            'created_by' => 'eden', 
            'updated_by' => 'eden',
            'created_at' => now(),
            'updated_at' => now(),
            'is_active' => $row['is_active'] == 0 ? false : true,
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
            '*.file_no' => ['nullable', 'string'],
            '*.date_of_rental' => ['nullable', 'integer'],
            '*.company' => ['nullable', 'string'],
            '*.type' => ['nullable', 'string'],
            '*.property_details' => ['nullable', 'string'],
            '*.land_size' => ['nullable', 'string'],
            '*.building_size' => ['nullable', 'string'],
            '*.psf_rental_value' => ['nullable', 'numeric'],
            '*.total_rental_value' => ['nullable', 'numeric'],
            '*.tenant' => ['nullable', 'string'],
            '*.expiry_date' => ['nullable', 'integer'],
            '*.status' => ['nullable', 'string'],
            '*.action' => ['nullable', 'string'],
            '*.address1' => ['nullable', 'string'],
            '*.address2' => ['nullable', 'string'],
            '*.address3' => ['nullable', 'string'],
            '*.postcode' => ['nullable', 'integer'],
            '*.state' => ['nullable', 'string'],
            '*.city' => ['nullable', 'string'],
        ];
    }

    public function chunkSize(): int
    {
        return 100; // Define a suitable chunk size
    }
    
}

