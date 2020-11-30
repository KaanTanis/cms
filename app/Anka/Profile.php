<?php
namespace App\Anka;

use App\Anka\Fields\Button;
use App\Anka\Fields\Card;
use App\Anka\Fields\Form;
use App\Anka\Fields\Input;
use App\Http\Controllers\ProfileController;

/**
 * Class Post
 * @package App\Anka
 */
class Profile {
    public static $model = \App\Models\User::class;

    public static $name = 'Profil';
    public static $nameIndex = 'Profil';
    public static $slug = 'edit-profile';

    // data-feather icons
    public static $icon = 'home';

    public static $description = 'The page description';

    public static $translatable = false;

    public static $customController = true;
    public static $withoutTable = false;
    public static $hideFromSidebar = true;

    public static function fields()
    {
        return [
            Card::make([
                Form::make([
                    Input::make('E-posta Adresi', 'email'),
                    Input::make('Şifre', 'password')->hideFromIndex(),
                    Button::make('Güncelle')
                ]),
            ], 'Form'),
        ];

    }
}
