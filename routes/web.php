<?php

use App\Livewire\AssignAssetEmployee;
use App\Livewire\Dashboard;
use App\Livewire\EmployeeAssetList;
use App\Livewire\ItAddMember;
use App\Livewire\ItLogin;
use App\Livewire\ItMembers;
use App\Livewire\OldItMembers;
use App\Livewire\PasswordResetComponent;
use App\Livewire\RequestProcess;
use App\Livewire\TestPurpose;
use App\Livewire\VendorAssets;
use App\Livewire\Vendors;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['checkauth'])->group(function () {
    Route::get('/itlogin', ItLogin::class)->name('itlogin');
});

Route::middleware(['auth:it', 'handleSession'])->group(function () {
    // Root route, protected by auth:it middleware
    Route::get('/', Dashboard::class)->name('dashboard');

    // Group routes under the 'it' prefix
    Route::prefix('it')->group(function () {

        // Super Admin Routes (accessible only to super_admin)
        Route::middleware(['role:super_admin'])->group(function () {
            Route::get('/itrequest', RequestProcess::class)->name('requests');
            Route::get('/itMembers', ItAddMember::class)->name('itMembers');
            Route::get('/oldItMembers', OldItMembers::class)->name('oldItMembers');
        });

        // Admin Routes (accessible to both admin and super_admin)
        Route::middleware(['role:admin|super_admin'])->group(function () {
            Route::get('/vendorAssets', VendorAssets::class)->name('vendorAssets');
            Route::get('/employeeAssetList', AssignAssetEmployee::class)->name('employeeAssetList');
        });

        // User Routes (accessible to all roles: user, admin, and super_admin)
        Route::middleware(['role:user|admin|super_admin'])->group(function () {
            Route::get('/vendor', Vendors::class)->name('vendor');
        });
    });
});




Route::get('password/reset/{token}', PasswordResetComponent::class)->name('password.reset');

Route::get('/clear', function () {
    // Clear the contents of all log files
    $logFiles = File::glob(storage_path('logs/*.log'));
    foreach ($logFiles as $file) {
        File::put($file, ''); // This will empty the file without deleting it
    }

    // Perform other Artisan commands
    Artisan::call('optimize:clear');
    Artisan::call('optimize');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('auth:clear-resets');

    return 'Log contents cleared, and caches have been cleared and optimized!';
});
