<?php

namespace App\Imports;

use App\Models\App;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class StoresImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return ['name', 'address'];
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (isset(Auth::guard('admin')->user()->app_id)) {
            return Store::updateOrCreate([
                'name' => $row['name'],
                'app_id' => Auth::guard('admin')->user()->app_id,
                'address' => $row['address'],
            ]);
        }
        return Store::updateOrCreate([
            'name' => $row['name'],
            'app_id' => App::where('name', $row['app_name'])->firstOrFail()->id,
            'address' => $row['address'],
        ]);
    }
}
