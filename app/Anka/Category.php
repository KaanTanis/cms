<?php
namespace App\Anka;

use App\Anka\Fields\Button;
use App\Anka\Fields\Card;
use App\Anka\Fields\Form;
use App\Anka\Fields\Input;

/**
 * Class Post
 * @package App\Anka
 */
class Category {
    public static $model = \App\Models\Category::class;

    public static $name = 'Category';
    public static $nameIndex = 'Category';
    public static $slug = 'category';

    // data-feather icons
    public static $icon = 'home';

    public static $description = 'The page description';

    public static $translatable = true;

    public static $customController = true;
    public static $withoutTable = true;
    public static $hideFromSidebar = false;

    public static function fields()
    {
        return [
            Card::make([
                Form::make([
                    Input::make('İsim', 'name'),
                    Button::make('Gönder')
                ]),
            ], 'Form'),
        ];

    }
}
