<?php

namespace Database\Seeders;

use App\Models\SellerApplication;
use App\Models\ShopCategory;
use Illuminate\Database\Seeder;

class ShopCategorySeeder extends Seeder
{
    /**
     * Create top level categories: Graphics, Fonts, Templates, Add-ons, Photos, Web Themes, 3D
     *
     * @return void
     */
    public function run()
    {
        $this->createCategory('3d', '3D');
        $this->createCategory('add_ons', 'Add-ons');
        $this->createCategory('fonts', 'Fonts');
        $this->createCategory('graphics', 'Graphics');
        $this->createCategory('photos', 'Photos');
        $this->createCategory('web_themes', 'Web Themes');
    }

    private function createCategory($slug, $name)
    {
        ShopCategory::create(
            [
                'slug' => $slug,
                'name' => $name,
            ]
        );
    }
}
