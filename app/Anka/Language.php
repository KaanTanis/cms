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
class Language {
    public static $model = \App\Models\Language::class;
    public static $name = 'Language';
    public static $nameIndex = 'Languages';
    public static $slug = 'languages';

    // data-feather
    public static $icon = 'globe';

    public static $description = 'Site languages';

    public static $translatable = false;

    public static $withoutTable = false;
    public static $hideFromSidebar = false;

    public static function fields()
    {
        return [
            Card::make([
                Form::make([
                    Input::make('Display name', 'display_name'),
                    Input::make('Lang code', 'lang_code')
                        ->placeholder('Eg: en'),
                    Input::make('Flag code', 'flag_code')
                        ->placeholder('Eg: gb'),

                    Button::make('Create')
                        ->onEdit('Update'),

                ]),
            ], 'Form Bilgileri'),
        ];

    }


}
