<?php
namespace App\Anka;

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
            Text::make('Başlık', 'title')
                ->placeholder('Başlık Giriniz')
                ->required(),

            Text::make('Açıklama', 'description')
        ];
    }


}
