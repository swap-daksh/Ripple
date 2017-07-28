<?php

namespace ETU\Ripple\Http\Controllers;

use ETU\Ripple\Traits\Settings;
use Illuminate\Http\Request;
use ETU\Ripple\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class SettingsController extends Controller {

    use Settings;

    public function settings() {
        if (request()->has('setting-create')):
            self::createSetting();
            return back();
        elseif (request()->has('setting-update')):
            self::updateSetting();
            return back();
        elseif (request()->has('setting-delete')):
            return self::deleteSetting();
        endif;
        $settings = self::hasSettings();
        return view('Ripple::settings.settings', compact('settings'));
    }

}
