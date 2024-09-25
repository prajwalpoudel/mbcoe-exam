<?php


namespace App\Services;


use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;

class SettingService extends BaseService
{

    public function model()
    {
        return Setting::class;
    }
}
