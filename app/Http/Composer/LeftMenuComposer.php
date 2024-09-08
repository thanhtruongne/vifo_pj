<?php
 
namespace App\Http\Composer;

use App\Models\User;
use Illuminate\View\View;
 
class LeftMenuComposer
{
    protected $leftSideMenu;
    /**
     * Create a new profile composer.
     */
    public function __construct() {
        $this->getLeftMenu();
    }
 
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('leftMenuBackend', $this->leftSideMenu);
    }

    public function getLeftMenu(){
        $item = [
            
            'Thống kê' => [
                'id' => '1',
                'name' => trans('vifo.summary'),
                'url' => '',
                'icon' => 'fa fa-dashboard',
                // 'permission' => User::isRoleManager(),
                'url_name' => 'dashboard',
                'url_child' => [],
            ],
            'management_product_family' => [
                'id' => 2,
                'name' => trans('vifo.manager_product_family'),
                'url' => '',
                'icon' => 'fa fa-folder',
                // 'permission' => ,
                'url_item_child' => ['product_family_info', 'product_family_create'],
                'item_childs' => [
                    [
                        'name' => trans('vifo.manager_product_family_info'),
                        'url' =>'',
                        'icon' => 'fa fa-archive',
                        // 'permission' => User::canPermissionCompetencyReport(),
                    ],
                ],
            ],
            'management_products' => [
                'id' => 4,
                'name' => trans('vifo.manager_products'),
                'url' => '',
                'icon' => 'fa fa-folder',
                // 'permission' => ,
                'url_item_child' => ['product_family_info', 'product_family_create'],
                'item_childs' => [
                    [
                        'name' => trans('vifo.manager_products_info'),
                        'url' =>'',
                        'icon' => 'fa fa-archive',
                        // 'permission' => User::canPermissionCompetencyReport(),
                    ],
                ],
            ],
            'management_providers' => [
                'id' => 3,
                'name' => trans('vifo.manager_provider'),
                'url' => '',
                'icon' => 'fa fa-folder',
                // 'permission' => ,
                'url_item_child' => ['product_family_info', 'product_family_create'],
                'item_childs' => [
                    [
                        'name' => trans('vifo.manger_provider_info'),
                        'url' =>'',
                        'icon' => 'fa fa-archive',
                        // 'permission' => User::canPermissionCompetencyReport(),
                    ],
                ],
            ],
            'management_saleman' => [
                'id' => 4,
                'name' => trans('vifo.manager_sale_man'),
                'url' => '',
                'icon' => 'fa fa-folder',
                // 'permission' => ,
                'url_item_child' => ['product_family_info', 'product_family_create'],
                'item_childs' => [
                    [
                        'name' => trans('vifo.manager_sale_man_info'),
                        'url' =>'',
                        'icon' => 'fa fa-archive',
                        // 'permission' => User::canPermissionCompetencyReport(),
                    ],
                ],
            ],
        ];
        $this->leftSideMenu = $item;
        
        return $this->leftSideMenu;

    }
}