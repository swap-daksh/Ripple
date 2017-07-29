<?php

namespace GitLab\Ripple\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * Description of Settings
 *
 * @author Yash Pal
 */
trait Settings {

    public function hasSettings() {
        return DB::table('settings')->get();
    }

    private function saveSetting() {
        if (self::hasSetting(request('setting-key'))):
            session()->flash('setting-warning', 'Oops! Setting "' . request('setting-key') . '" already exists!!');
            return false;
        else:
            DB::table('settings')->insert(["key" => request('setting-key'), "display_name" => request('setting-name'), "value" => "", "options" => self::settingOptions(request('option-name'), request('option-value')), "type" => request('setting-type'), "created_at" => date('Y-m-d h:i:s'), "updated_at" => date('Y-m-d h:i:s')]);
            session()->flash('setting-success', 'Setting "' . request('setting-key') . '"  saved!!');
        endif;
    }

    private static function updateSetting() {
        foreach (request()->all() as $setting_name => $setting_value):
            DB::table('settings')->where('key', $setting_name)->update(['value' => self::settingFile($setting_name)]);
        endforeach;
        session()->flash('setting-success', 'Success! Settings are saved!');
    }

    private static function deleteSetting() {
        if (DB::table('settings')
                        ->where('key', request('key'))
                        ->where('id', request('id'))
                        ->delete()):
            session()->flash('setting-success', 'Success! Setting "' . request('key') . '" deleted!!');
            return response()->json(["status" => "ok"]);
        endif;
    }

    private static function settingFile($settingFile) {
        if (request()->hasFile($settingFile)):
            return storeFileAs($settingFile, 'setting_' . $settingFile);
        else:
            return request($settingFile);
        endif;
    }

    private function hasSetting($hasSetting) {
        return DB::table('settings')->where('key', $hasSetting)->exists();
    }

    private function settingOptions($option_name, $option_value) {
        if (is_array($option_name)):
            foreach ($option_name as $name_index => $name):
                $option_json[$name] = $option_value[$name_index];
            endforeach;
            return json_encode($option_json);
        endif;
    }

}
