<?php

namespace App\Imports;

use App\Models\HextarUserDataset;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HextarUserDatasetImport implements ToModel, WithHeadingRow
{
    /**
     * Process the row and add new data if status is 1.
     *
     * @param array $row
     * @return HextarUserDataset|null
     */
    public function addNewData(array $row)
    {
        if ($row['status'] == 1) {
            return new HextarUserDataset([
                'id' => $row['id'] ?? null,
                'name' => $row['new_company'] ?? null,
                'first_name' => ucwords($row['new_first_name'] ?? null),
                'last_name' => ucwords($row['new_last_name'] ?? null),
                'email' => $row['new_email'] ?? null,
                'phone' => $row['new_phone'] ?? null,
                // 'phone_iso' => $row['new_phone_iso'] ?? null,
                // 'phone_code' => $row['new_phone_code'] ?? null,
                'is_active' => 1,
                'status_id' => $row['status'],
            ]);
        }

        return null;
    }

    /**
     * Delete data if status is 2 or 3.
     *
     * @param array $row
     * @return void
     */
    public function deleteData(array $row)
    {
        if ($row['status'] == 2 || $row['status'] == 3 || $row['status'] == 'KIV' ) {
            $existingRecord = HextarUserDataset::find($row['id']);
            if ($existingRecord) {
                $existingRecord->delete();
            }
        }
    }

    /**
     * Update existing data if status is 4, 5, 6, or 7.
     *
     * @param array $row
     * @return void
     */
    public function updateData(array $row)
    {
        $existingRecord = HextarUserDataset::find($row['id']);

        if ($existingRecord) {
            $statusCodes = explode(',', $row['status']);
            if (in_array('4', $statusCodes)) {
                $existingRecord->email = $row['new_email'];
            }
            if (in_array('5', $statusCodes)) {
                $existingRecord->phone = $row['new_phone'];
                // Optional fields
                // $existingRecord->phone_iso = $row['new_phone_iso'];
                // $existingRecord->phone_code = $row['new_phone_code'];
            }
            if (in_array('6', $statusCodes)) {
                $existingRecord->first_name = ucwords($row['new_first_name']);
                $existingRecord->last_name = ucwords($row['new_last_name']);
            }
            if (in_array('7', $statusCodes)) {
                $existingRecord->name = $row['new_company'];
            }

            $existingRecord->save();
        }
    }


    /**
     * Transform the row into a model for HextarUserDataset.
     *
     * @param array $row
     * @return HextarUserDataset|null
     */
    public function model(array $row)
    {
        
        $this->deleteData($row);

        // Add new data if status is 1
        if ($data = $this->addNewData($row)) {
            return $data;
        }

        
        $this->updateData($row);

        // Return existing data if status is not 1
        return new HextarUserDataset([
            'id' => $row['id'],
            'name' => $row['name'],
            'first_name' => ucwords($row['first_name']),
            'last_name' => ucwords($row['last_name']),
            'email' => $row['email'],
            'email_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'image' => null,
            'phone' => $row['phone'],
            'phone_backup' => null,
            'points' => null,
            'status_id' => $row['status'],
            'skype' => null,
            'zoom' => null,
            'telegram' => null,
            'member_from' => null,
            'wechat' => null,
            'QQ' => null,
            'weibo' => null,
            'twitter' => null,
            'michat' => null,
            'facebook' => null,
            'login_from' => null,
            'firebase_token' => null,
            'device_token' => null,
            'firebase_register' => null,
            'send' => null,
            'phone_verified' => null,
            'imported' => null,
            'no_show_phone' => null,
            'primary_company' => null,
            'employee_level' => null,
            'designation' => null,
            'department' => null,
            'channel_id' => null,
            'ihextar_used_id' => null,
            'profile_image' => null,
            'is_active' => $row['is_active'] == 0 ? false : true,
            'point_updated_at' => null,
            'license_accept_version' => null,
            'is_viewable' => null,
        ]);
    }
}
