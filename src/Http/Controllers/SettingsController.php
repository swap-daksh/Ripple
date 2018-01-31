<?php

namespace YPC\Ripple\Http\Controllers;

use YPC\Ripple\Models\Setting;
use YPC\Ripple\Support\Traits\Settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use YPC\Ripple\Support\Facades\Ripple;

class SettingsController extends Controller {

    use Settings;

// General Settings
    public function settings($type) {
        if (request()->has('setting-create')) :
            self::saveSetting();

            return back();
        elseif (request()->has('setting-update')) :
            self::updateSetting();

            return back();
        elseif (request()->has('setting-delete')) :
            return self::deleteSetting();
        endif;
        $settings = self::hasSettings($type);
        if (view()->exists("Ripple::settings.beta-{$type}-settings")) {
            return view("Ripple::settings.beta-{$type}-settings", compact('settings'));
        } else {
            abort(404);
        }
    }

    // General Settings
    public function createSetting() {
        if (request()->has('setting-create')) :
            self::saveSetting();

            return redirect()->route('Ripple::adminSettings');
        endif;

        return view('Ripple::settings.create-setting');
    }

}
