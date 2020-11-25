<?php
namespace App\Anka;

use App\Anka\Fields\Button;
use App\Anka\Fields\Card;
use App\Anka\Fields\Form;
use App\Anka\Fields\Text;
use App\Models\User;

/**
 * Class Post
 * @package App\Anka
 */
class Post {
    public static $model = Post::class;

    public static $name = 'Post';

    public static $description = 'Post Description';

    public static function fields()
    {
        return [
            Form::make([
                Card::make([
                    Text::make('Başlık', 'title')
                        ->placeholder('Lütfen başlık giriniz.'),

                    Text::make('Açıklama', 'description')
                        ->placeholder('Lütfen açıklama giriniz'),

                    Button::make('Gönder'),

                ], 'Form Bilgileri'),
            ])
        ];
    }


}
