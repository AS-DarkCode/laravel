<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SendPayController;
use App\Http\Controllers\Admin\ReceivePayController;
use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProfileController;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Default Authentication Routes (Only accessible to non-authenticated users)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Admin-specific routes (accessible by admins only)
    Route::middleware('role:admin')->group(function () {

        Route::get('/', [AdminController::class, 'dashboard'])->name('root');

        // Admin Management Routes
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
            Route::get('manage', [AdminController::class, 'manage'])->name('dashboard.manage');
            Route::get('attendance', [AdminController::class, 'attendance'])->name('admin.attendance');
            Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
        });

        // User Management Routes
        Route::prefix('users')->group(function () {
            Route::get('manage', [UserController::class, 'manageUsers'])->name('manage_users');
            Route::get('add', [UserController::class, 'create'])->name('add_user.create');
            Route::post('store', [UserController::class, 'store'])->name('add_user.store');
            Route::get('view/{id}', [UserController::class, 'view'])->name('view_user');
            Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit_user');
            Route::post('update/{id}', [UserController::class, 'update'])->name('update_user');
            Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('delete_user');
        });

        // Send Payment Routes
        Route::prefix('sendpayments')->group(function () {
            Route::get('manage', [SendPayController::class, 'index'])->name('send.index');
            Route::get('send', [SendPayController::class, 'send'])->name('send.create');
            Route::post('store', [SendPayController::class, 'store'])->name('send.store');
            Route::get('edit/{id}', [SendPayController::class, 'edit'])->name('send.edit');
            Route::post('update/{id}', [SendPayController::class, 'update'])->name('send.update');
            Route::delete('delete/{id}', [SendPayController::class, 'destroy'])->name('send.destroy');
        });

        // Receive Payment Routes
        Route::prefix('receivepayments')->group(function () {
            Route::get('index', [ReceivePayController::class, 'index'])->name('receive.index');
            Route::get('create', [ReceivePayController::class, 'create'])->name('receive.create');
            Route::post('store', [ReceivePayController::class, 'store'])->name('receive.store');
            Route::get('edit/{id}', [ReceivePayController::class, 'edit'])->name('receive.edit');
            Route::post('update/{id}', [ReceivePayController::class, 'update'])->name('receive.update');
            Route::delete('delete/{id}', [ReceivePayController::class, 'destroy'])->name('receive.destroy');
        });

        // Site Management Routes
        Route::prefix('sites')->group(function () {
            Route::get('index', [SiteController::class, 'index'])->name('sites.index');
            Route::get('create', [SiteController::class, 'create'])->name('sites.create');
            Route::post('store', [SiteController::class, 'store'])->name('sites.store');
            Route::get('edit/{id}', [SiteController::class, 'edit'])->name('sites.edit');
            Route::post('update/{id}', [SiteController::class, 'update'])->name('sites.update');
            Route::delete('delete/{id}', [SiteController::class, 'destroy'])->name('sites.destroy');
        });

        // Expense Management Routes
        Route::prefix('expenses')->group(function () {
            Route::get('index', [ExpenseController::class, 'index'])->name('expense.index');
            Route::get('create', [ExpenseController::class, 'create'])->name('expense.create');
            Route::post('store', [ExpenseController::class, 'store'])->name('expense.store');
            Route::get('edit/{id}', [ExpenseController::class, 'edit'])->name('expense.edit');
            Route::post('update/{id}', [ExpenseController::class, 'update'])->name('expense.update');
            Route::delete('delete/{id}', [ExpenseController::class, 'destroy'])->name('expense.destroy');
        });

        // Attendance Management Routes
        Route::prefix('attendance')->group(function () {
            Route::get('overview', [AttendanceController::class, 'overview'])->name('attendance.overview');
            Route::get('index', [AttendanceController::class, 'index'])->name('attendance.index');
            Route::post('store', [AttendanceController::class, 'store'])->name('attendance.store');
            Route::get('edit/{id}', [AttendanceController::class, 'edit'])->name('attendance.edit');
            Route::post('update/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
            Route::delete('delete/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
            Route::get('view/{userId}/{selectedDate?}', [AttendanceController::class, 'view'])->name('attendance.view');
            Route::post('bulk-delete', [AttendanceController::class, 'bulkDelete'])->name('attendance.bulkDelete');
            Route::get('search', [AttendanceController::class, 'search'])->name('attendance.search');
        });

        // Report Management Routes
        Route::prefix('reports')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('reports.index');
            Route::get('show/{userId?}', [ReportController::class, 'show'])->name('reports.show'); // {userId} optional bana
            Route::get('download/{userId?}', [ReportController::class, 'download'])->name('reports.download'); // {userId} optional bana
        });

        // Profile Management Routes
        Route::prefix('admin')->group(function () {
            Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile.index');
            Route::get('profile/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
            Route::post('profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
            Route::post('profile/logout', [ProfileController::class, 'logout'])->name('admin.profile.logout');
        });
    });

    // User-specific routes (accessible by users only)
    Route::middleware('role:user')->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
        });
    });

    // Fallback for unauthorized access within authenticated routes
    Route::get('/unauthorized', function () {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'user') {
            return redirect()->route('user.dashboard');
        }
        return redirect()->route('login');
    })->name('unauthorized');
});
