<?php
namespace App\Anka;

use App\Anka\Fields\Button;
use App\Anka\Fields\Card;
use App\Anka\Fields\File;
use App\Anka\Fields\Form;
use App\Anka\Fields\Input;
use App\Anka\Fields\Textarea;
use App\Anka\Fields\Tinymce;

/**
 * Class Post
 * @package App\Anka
 */
class Post {
    public static $model = \App\Models\Post::class;

    public static $name = 'Post';
    public static $nameIndex = 'Posts';
    public static $slug = 'post-bolumu';

    // data-feather
    public static $icon = 'home';

    public static $description = 'Post Description';

    public static $translatable = true;

    public static $customController = false;
    public static $withoutTable = false;
    public static $hideFromSidebar = false;

    public static function fields()
    {
        return [
            Card::make([
                Form::make([
                    Input::make('Başlık', 'title')
                        ->placeholder('Lütfen başlık giriniz.'),

                    Tinymce::make('Açıklama', 'description')
                        ->rows('3')
                        ->placeholder('Lütfen açıklama giriniz'),

                    File::make('Kapak', 'cover'),

                    Button::make('Gönder'),

                ]),
            ], 'Form Bilgileri'),
        ];

    }


}
