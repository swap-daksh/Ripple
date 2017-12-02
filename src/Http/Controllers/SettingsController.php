<?php

namespace GitLab\Ripple\Http\Controllers;

use GitLab\Ripple\Models\Setting;
use GitLab\Ripple\Support\Traits\Settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use GitLab\Ripple\Support\Facades\Ripple;

class SettingsController extends Controller
{

    use Settings;

// General Settings
    public function settings()
    {
        if (request()->has('setting-create')):
            self::saveSetting();

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

    // General Settings
    public function createSetting()
    {
        if (request()->has('setting-create')):
            self::saveSetting();

            return redirect()->route('Ripple::adminSettings');
        endif;

        return view('Ripple::settings.create-setting');
    }

}
