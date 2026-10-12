<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // General Staff Access
    Route::get('/alerts', [AlertController::class, 'index'])->name('alerts.index');

    // ==========================================
    // ADMIN ONLY MODULES
    // ==========================================
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
        Route::get('/activities', [ActivityLogController::class, 'index'])->name('activities.index');
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });

    // ==========================================
    // INVENTORY MANAGEMENT MODULES (Admin & Inventory Manager)
    // ==========================================
    Route::middleware('role:admin,inventory_manager')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('suppliers', SupplierController::class);

        Route::get('/stock/update', [StockController::class, 'create'])->name('stock.create');
        Route::post('/stock/update', [StockController::class, 'store'])->name('stock.store');
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/stock-summary', [ReportController::class, 'stockSummary'])->name('reports.stock_summary');
        Route::get('/reports/transactions-summary', [ReportController::class, 'transactionsSummary'])->name('reports.transactions_summary');
        Route::get('/reports/orders-summary', [ReportController::class, 'ordersSummary'])->name('reports.orders_summary');

        // PDF Reports
        Route::get('/reports/stock-summary-pdf', [ReportController::class, 'stockSummaryPdf'])->name('reports.stock_summary_pdf');
        Route::get('/reports/transactions-pdf', [ReportController::class, 'transactionsPdf'])->name('reports.transactions_pdf');
        Route::get('/reports/orders-pdf', [ReportController::class, 'ordersPdf'])->name('reports.orders_pdf');
    });

    // Products: Lookup & CRUD
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::middleware('role:admin,inventory_manager')->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    // ==========================================
    // POINT OF SALE & ORDERS (Admin & Cashier)
    // ==========================================
    Route::middleware('role:admin,cashier')->group(function () {
        Route::resource('orders', OrderController::class)->only(['index', 'create', 'store', 'show']);
        Route::get('/orders/{order}/pdf', [OrderController::class, 'downloadPdf'])->name('orders.pdf');
    });
});

require __DIR__.'/auth.php';
