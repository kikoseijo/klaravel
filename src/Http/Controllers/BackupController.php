<?php
namespace Ksoft\Klaravel\Http\Controllers;

use Artisan;
use Storage;

class BackupController extends Controller
{
    public function index()
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => humanReadableSize($disk->size($f)),
                    'last_modified' => createFromTimestamp($disk->lastModified($f)),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);
        $routeName = config('ksoft.modules.backup.route_name', 'backup');
        return view("klaravel::admin.backups")->with(compact('backups', 'routeName'));
    }

    public function create()
    {
        try {
            Artisan::call('backup:run', config('ksoft.modules.backup.extra_arguments', ['--only-db' => 'true']));
            return back()->with('flash_success', 'Backup created succesfully');
        } catch (Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }

    public function dbBackup()
    {
        try {
            Artisan::call('backup:run', ['--only-db' => 'true']);
            return back()->with('flash_success', 'DB Backup created succesfully');
        } catch (Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }

    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);
            return back();
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
}
