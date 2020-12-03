<?php
namespace App\Anka;

use App\Anka\Fields\Button;
use App\Anka\Fields\Card;
use App\Anka\Fields\Form;
use App\Anka\Fields\Input;
use App\Anka\Fields\Textarea;
use App\Models\User;

/**
 * Class Post
 * @package App\Anka
 */
class Option {
    public static $model = \App\Models\Option::class;

    public static $name = 'Ayar';
    public static $nameIndex = 'Ayarlar';
    public static $slug = 'ayarlar';

    // data-feather
    public static $icon = 'settings';

    public static $description = 'Ayarlar';

    public static $translatable = true;

    public static $withoutTable = false;
    public static $hideFromSidebar = false;

    public static function fields()
    {
        return [
            Card::make([
                Form::make([
                    Input::make('Ayar Adı', 'key')
                        ->placeholder('Anahtar'),

                    Input::make('Ayar Değeri', 'value')
                        ->placeholder('Değer'),


                    Button::make('Gönder'),

                ]),
            ], 'Form Bilgileri'),
        ];

    }


}
