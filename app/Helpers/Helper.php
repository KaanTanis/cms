<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\Language;
use App\Models\Option;
use App\Models\Translation;

/**
 * Class Helper
 * @package App\Helpers
 */
class Helper
{
    /**
     * @param $fields
     * @return array
     */
    public static function getFieldNames($fields)
    {
        $names = [];
        foreach ($fields as $field) {
            foreach ($field['form'] as $form) {
                foreach ($form['fields'] as $formField) {
                    if ($formField->hideFromIndex != true) {
                        $names[] = $formField->name;
                    }
                }
            }
        }
        return $names;
    }

    public static function getAllFieldNames($fields)
    {
        $names = [];
        foreach ($fields as $field) {
            foreach ($field['form'] as $form) {
                foreach ($form['fields'] as $formField) {
                    if ($formField->name != null) {
                        $names[] = $formField->name;
                    }
                }
            }
        }
        return $names;
    }

    /**
     * @param $fields
     * @return array
     */
    public static function getFieldLabels($fields)
    {
        $labels = [];
        foreach ($fields as $field) {
            foreach ($field['form'] as $form) {
                foreach ($form['fields'] as $formField) {
                    if ($formField->hideFromIndex != true) {
                        $labels[] = $formField->label;
                    }
                }
            }
        }
        return $labels;
    }

    /**
     * @param $key
     * @return |null
     */
    public static function option($key)
    {
        try {
            return Option::where('key', $key)->first()->value;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @return mixed
     */
    public static function getDefaultLangName()
    {
        $langId = Option::where('key', 'default_lang')->first()->value;

        return Language::find($langId)->display_name;
    }

    /**
     * @param $lang lang_code
     * @return mixed
     */
    public static function langId($lang)
    {
        return Language::where('lang_code', $lang)->first()->id;
    }

    public static function getValueLang($modelTableName, $name, $id, $lang)
    {
        try {
            return Translation::where('table_name', $modelTableName)
                ->where('column_name', $name)
                ->where('foreign_id', $id)
                ->where('locale', Helper::langId($lang))
                ->select('value')
                ->first()->value;
        } catch (\Exception $e) {
            return null;
        }
    }
}
