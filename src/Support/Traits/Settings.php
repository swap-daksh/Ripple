<?php

namespace YPC\Ripple\Support\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

trait Settings
{

    /**
     * Check if the settings group has settings or not
     * 
     * @param string $type
     * @return object
     */
    public function hasSettings($type)
    {
        return DB::table('rpl_settings')->where('group', $type)->orderBy('id')->get();
    }


    /**
     * It saves the settings but first it checks for the settings already registered if there is no any setting
     * exists corresponding to the setting key it saves the setting otherwise return and error message.
     * 
     * @return mixed
     */
    private function saveSetting()
    {
        if (self::hasSetting(request('setting-key'))) :
            session()->flash('setting-warning', 'Oops! Setting "' . request('setting-key') . '" already exists!!');
        return false;
        else :
            DB::table('rpl_settings')->insert(['key' => request('setting-key'), 'display_name' => request('setting-name'), 'value' => '', 'options' => self::settingOptions(request('option-name'), request('option-value')), 'type' => request('setting-type'), 'group' => request('group'), 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')]);
        session()->flash('setting-success', 'Setting "' . request('setting-key') . '"  saved!!');
        endif;
    }


    /**
     * It updates all modified settings.
     * 
     * @return void
     */
    private static function updateSetting()
    {
        foreach (array_keys(request()->all()) as $setting) :
            DB::table('rpl_settings')->where('key', $setting)->update(['value' => self::settingFile($setting)]);
        endforeach;
        session()->flash('setting-success', 'Success! Settings are saved!');
    }


    /**
     * Deletes setting
     * 
     * @return json
     */
    private static function deleteSetting()
    {
        if (DB::table('rpl_settings')
            ->where('key', request('key'))
            ->where('id', request('id'))
            ->delete()) :
            session()->flash('setting-success', 'Success! Setting "' . request('key') . '" deleted!!');

        return response()->json(['status' => 'ok']);
        endif;
    }


    /**
     * Each settings are being passing through this function it checks for files in settings and upload it
     * if there is any otherwise it returns the setting value.
     * 
     * @param object $settingFile
     * @return string
     */
    private static function settingFile($settingFile)
    {
        if (request()->hasFile($settingFile)) :
            return storeFileAs($settingFile, 'setting_' . $settingFile);
        else :
            return request($settingFile);
        endif;
    }


    /**
     * Checks if the setting exists in database.
     * @param string $hasSetting
     * @return boolean
     */
    private function hasSetting($hasSetting)
    {
        return DB::table('rpl_settings')->where('key', $hasSetting)->exists();
    }


    /**
     * Returns the json of setting options.
     * @param array|object $option_name
     * @param array|object $option_value
     * 
     * @return string|json
     */
    private function settingOptions($option_name, $option_value)
    {
        if (is_array($option_name)) :
            foreach ($option_name as $index => $name) :
            $option_json[$name] = $option_value[$index];
        endforeach;

        return json_encode($option_json);
        endif;
    }


}
