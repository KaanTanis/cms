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
class Post {

    public static $model = \App\Models\Post::class;

    public static $name = 'Post';

    public static $description = 'Post Description';

    public static function fields()
    {
        return [
            // form ve card yer değiş
            Form::make([
                Card::make([
                    Input::make('Başlık', 'title')
                        ->placeholder('Lütfen başlık giriniz.'),

                    Textarea::make('Açıklama', 'description')
                        ->rows('3')
                        ->placeholder('Lütfen açıklama giriniz'),

                    Button::make('Gönder'),

                ], 'Form Bilgileri'),
            ])
        ];

    }


}
