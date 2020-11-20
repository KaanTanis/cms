<?php
namespace App\Anka;

use App\Anka\Fields\Text;

/**
 * Class Post
 * @package App\Anka
 */
class Post {

    public static $name = 'Post';

    public static $description = 'Post Description';

    public static $table = true;

    protected $placeholder;

    public static function fields()
    {
        return [
            Text::make('Başlık')
                ->placeholder('Başlık Giriniz'),

            Text::make('Açıklama')
        ];
    }


}
