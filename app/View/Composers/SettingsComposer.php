<?php


namespace App\View\Composers;


use App\Services\SettingService;
use Illuminate\View\View;

class SettingsComposer
{
    /**
     * @var SettingService
     */
    private $settingService;

    /**
     * SettingsComposer constructor.
     * @param SettingService $settingService
     */
    public function __construct(
        SettingService $settingService
    )
    {
        $this->settingService = $settingService;
    }

    public function compose(View $view) {
        $setting = $this->settingService->query()->first();

        $view->with(compact('setting'));
    }

}
