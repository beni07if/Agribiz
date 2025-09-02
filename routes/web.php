<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{
    GroupController,
    ConsolidationController,
    ShareholderController,
    MessageController,
    AdminController,
    HomeController,
    FeatureController,
    ProfileController,
    FaqController,
    SraController,
    Scraper,
    PrivacyPolicyController,
    TermConditionController,
    LandingPageController,
    WebViewController,
    PrivateController,
    Auth\GoogleAuthController,
    Auth\AuthenticatedSessionController
};
use App\Http\Middleware\CheckUserLevel;
use Illuminate\Broadcasting\PrivateChannel;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [WebViewController::class, 'index'])->name('corporateProfileEn');

    // Search features public
    Route::get('/search-groups', [WebViewController::class, 'searchFunctionGroup'])->name('searchFunctionGroup');
    Route::get('/search-subsidiaries', [WebViewController::class, 'searchFunctionSubsidiary'])->name('searchFunctionSubsidiary');
    Route::get('/search-other-companies', [WebViewController::class, 'searchFunctionOtherCompany'])->name('searchFunctionOtherCompany');
    Route::get('/search-shareholders', [WebViewController::class, 'searchFunctionShareholder'])->name('searchFunctionShareholder');
    Route::get('/search-sra', [WebViewController::class, 'searchFunctionSRA'])->name('searchFunctionSRA');

    // Features public
    Route::get('/group-feature', [WebViewController::class, 'groupFeature'])->name('groupFeature');
    Route::get('/subsidiary-feature', [WebViewController::class, 'subsidiaryFeature'])->name('subsidiaryFeature');
    Route::get('/shareholder-feature', [WebViewController::class, 'shareholderFeature'])->name('shareholderFeature');
    Route::get('/sra-feature', [WebViewController::class, 'sraFeature'])->name('sraFeature');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Corporate profile (hanya bisa diakses user login)
    Route::post('/corporate-profile-subsidiary-show', [PrivateController::class, 'subsidiaryShow'])->name('subsidiaryShow');
    Route::post('/corporate-profile-sra-show', [PrivateController::class, 'sraShow'])->name('sraShow');
    Route::match(['get', 'post'], '/corporate-profile-group2-show', [PrivateController::class, 'group2Show'])->name('group2Show');
    Route::match(['get', 'post'], '/corporate-profile-shareholder-show', [PrivateController::class, 'shareholderShow'])->name('shareholderShow');

    // Default dashboard for authenticated users
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

});
Route::get('/serve-pdf/{filename}', function($filename) {
    $path = public_path('file/group-structure/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('serve.pdf');

Route::middleware('auth')->group(function () {
    Route::patch('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
});


// Change password route
Route::patch('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])
    ->name('profile.password');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    // Main dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboardAdmin'])->name('dashboard');
    Route::get('/dashboard-admin', [AdminController::class, 'dashboardAdmin'])->name('dashboard.admin');

    // Sub-dashboards
    Route::get('/dashboard-group-consolidation', [AdminController::class, 'dashboardAdmin'])->name('groupConsolidation');
    Route::get('/dashboard-data-consolidation', [AdminController::class, 'dashboardAdmin'])->name('dataConsolidation');
    Route::get('/dashboard-company-ownership', [AdminController::class, 'dashboardAdmin'])->name('companyOwnership');
    Route::get('/dashboard-sra', [AdminController::class, 'dashboardAdmin'])->name('sra');

    // Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');

    // Logout (POST sesuai best practice)
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Resource Controllers
|--------------------------------------------------------------------------
*/
Route::resources([
    // 'sra' => SraController::class,
    'faq' => FaqController::class,
    'policy' => PrivacyPolicyController::class,
    'term-and-condition' => TermConditionController::class,
    'landing-page' => LandingPageController::class,
    'feature' => FeatureController::class,
]);

Route::prefix('admin')->name('admin.')->group(function () {
    // Import / Export Excel
    Route::post('sra/import', [SraController::class, 'import'])->name('sra.import');
    Route::get('sra/export', [SraController::class, 'export'])->name('sra.export');

    // Resource SRA
    Route::resource('sra', SraController::class);
});

/*
|--------------------------------------------------------------------------
| Auth Scaffolding (Fortify/Jetstream/etc.)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Notes: Commented routes below are kept for documentation
|--------------------------------------------------------------------------
*/
// Route::get('/term-and-condition', [ProfileController::class, 'termAndCondition'])->name('termAndCondition');
// Route::get('/privacy-and-policy', [ProfileController::class, 'privacyPolicy'])->name('privacyPolicy');
// Route::get('/user-guide', [CorporateProfileController::class, 'userGuide'])->name('userGuide');
// Route::get('/faqs', [FaqController::class, 'faq'])->name('faq');
// Route::get('/search', [CorporateProfileController::class, 'search'])->name('search');
// Route::get('/maps', [CorporateProfileController::class, 'maps'])->name('maps');
// Route::post('/maps', [CorporateProfileController::class, 'maps'])->name('maps');
// Route::get('/scraping', [CorporateProfileController::class, 'scrapingLatLong'])->name('scrapingLatLong');
// Route::get('/wef', [CorporateProfileController::class, 'wef'])->name('wef');
// Route::get('/subsidiary', [CorporateProfileController::class, 'subsidiaryList']);
// Route::get('/subsidiary/{id}', [CorporateProfileController::class, 'subsidiaryShow']);
// Route::get('/auth/google/callback', [CorporateProfileController::class, 'handleCallback']);