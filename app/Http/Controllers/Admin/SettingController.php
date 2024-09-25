<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * @var string
     */
    private $view = 'admin.settings.';
    /**
     * @var SettingService
     */
    private $settingService;

    /**
     * SettingController constructor.
     * @param SettingService $settingService
     */
    public function __construct(
        SettingService $settingService
    )
    {
        $this->settingService = $settingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = $this->settingService->query()->first();

        return view($this->view . 'index', compact('setting'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $setting = $this->settingService->find($id);

        return view($this->view.'edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, string $id)
    {
        $setting = $this->settingService->find($id);
        $settingData = $request->all();
        if($request->hasFile('logo')) {
            if (!is_null($setting->logo) && Storage::exists($setting->logo)) {
                Storage::delete($setting->logo);
            }

            $path = Storage::putFile('logo', $request->file('logo'));
            $settingData['logo'] = $path;
        }

        $setting->update($settingData);

        return $this->settingService->redirect('admin.setting.index', 'success', 'Setting updated successfully');
    }
}
