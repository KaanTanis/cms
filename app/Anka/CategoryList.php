<?php
namespace App\Anka;

class CategoryList {

    public static $name = 'Kategori Listesi';

    public static $description = 'Post Description';

    public static $table = true;

    public static function fields()
    {
        // Todo Text::make();
        return ['Title', 'Content', 'Status'];
    }

}
