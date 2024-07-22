<?php


namespace App\View\Composers;


use App\Constants\MenuGroupConstant;
use App\Services\MenuService;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * @var MenuService
     */
    private $menuService;

    /**
     * MenuComposer constructor.
     * @param MenuService $menuService
     */
    public function __construct(
        MenuService $menuService
    )
    {
        $this->menuService = $menuService;
    }

    public function compose(View $view) {
        $menus = $this->menuService->menus(MenuGroupConstant::ADMIN_ID);

        $view->with(compact('menus'));
    }

}
