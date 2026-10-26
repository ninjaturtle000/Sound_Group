<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $backupPath = base_path('database/sound_group_backup.sql');
        $backupSize = file_exists($backupPath) ? round(filesize($backupPath) / 1024, 2) . ' KB' : 'None';
        $backupTime = file_exists($backupPath) ? date('Y-m-d H:i:s', filemtime($backupPath)) : null;

        return view('admin.settings.index', compact('settings', 'backupSize', 'backupTime'));
    }

    public function update(Request $request)
    {
        $inputs = $request->except(['_token', '_method']);

        foreach ($inputs as $key => $val) {
            SiteSetting::set($key, $val);
        }

        return back()->with('success', 'Website information and details updated successfully!');
    }

    public function exportBackup()
    {
        Artisan::call('db:export-sql');
        return back()->with('success', 'Database backup exported successfully to sound_group_backup.sql!');
    }

    public function downloadBackup()
    {
        $file = base_path('database/sound_group_backup.sql');
        if (!file_exists($file)) {
            Artisan::call('db:export-sql');
        }
        return response()->download($file, 'sound_group_backup_' . date('Y-m-d_His') . '.sql');
    }
}
