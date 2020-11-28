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
class AboutUs {

    public static $model = \App\Models\Post::class;

    public static $name = 'Hakkımızda';

    public static $nameIndex = 'Hakkımızda Bölümü';

    public static $slug = 'hakkimizda-bolumu';

    public static $icon = 'copy';

    public static $description = 'Post Description';

    public static $translatable = true;

    public static function fields()
    {
        // todo: tarihleri indexte göstermek için tanımlama
        return [
            Card::make([
                Form::make([
                    Input::make('Başlık', 'title')
                        ->placeholder('Lütfen başlık giriniz.'),

                    Textarea::make('Açıklama', 'description')
                        ->rows('3')
                        ->placeholder('Lütfen açıklama giriniz'),

                    Button::make('Gönder'),

                ]),
            ], 'Form Bilgileri'),
        ];

    }


}
