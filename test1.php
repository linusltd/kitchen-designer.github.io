use ;

Route::get('/download-folder', [App\Http\Controllers\DownloadController::class, 'downloadFolder'])->name('download.folder');
