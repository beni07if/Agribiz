<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ConsolidationController;
use App\Http\Controllers\ShareholderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SraController;
use App\Http\Controllers\Scraper;
use App\Http\Middleware\CheckUserLevel;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\TermConditionController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\WebViewController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

// Website corporate profile
Route::get('/', [WebViewController::class, 'index'])->name('corporateProfileEn');
// Route::get('/lpd', [ProfileController::class, 'lpd'])->name('lpd');
// // Route::get('/corporate-profile-en', [CorporateProfileController::class, 'index'])->name('corporateProfileEn');
// // Route::get('/corporate-profile-index', [CorporateProfileController::class, 'index'])->name('index');
// Route::post('/corporate-profile-group-show', [CorporateProfileController::class, 'groupShow'])->name('groupShow');
Route::post('/corporate-profile-subsidiary-show', [WebViewController::class, 'subsidiaryShow'])->name('subsidiaryShow');
// Route::post('/corporate-profile-other-company-show', [CorporateProfileController::class, 'otherCompanyShow'])->name('otherCompanyShow');
Route::post('/corporate-profile-sra-show', [WebViewController::class, 'sraShow'])->name('sraShow');
// // Route::post('/corporate-profile-shareholder-show', [CorporateProfileController::class, 'shareholderShow'])->name('shareholderShow');
// // Route::post('/corporate-profile-group2-show', [GroupController::class, 'group2Show'])->name('group2Show');

Route::match(['get', 'post'], '/corporate-profile-group2-show', [GroupController::class, 'group2Show'])->name('group2Show');
// Route::match(['get', 'post'], '/corporate-profile-group-structure', [GroupController::class, 'group2ShowStructure'])->name('group2ShowStructure');
// Route::match(['get', 'post'], '/corporate-profile-subsidiary-notary-deed', [CorporateProfileController::class, 'subsidiaryShowNotarialDeed'])->name('subsidiaryShowNotarialDeed');
Route::match(['get', 'post'], '/corporate-profile-shareholder-show', [WebViewController::class, 'shareholderShow'])->name('shareholderShow');
// Route::match(['get', 'post'], '/corporate-profile-shareholder-shows', [CorporateProfileController::class, 'shareholderShowByCompany'])->name('shareholderShowByCompany');

// Route::get('/search-quick-group', [FeatureController::class, 'searchFunctionQuickGroup'])->name('searchFunctionQuickGroup');
// Route::get('/search-quick-subsidiary', [FeatureController::class, 'searchFunctionQuickSubsidiary'])->name('searchFunctionQuickSubsidiary');
// Route::get('/search-quick-shareholder', [FeatureController::class, 'searchFunctionQuickShareholder'])->name('searchFunctionQuickShareholder');

Route::get('/search-groups', [WebViewController::class, 'searchFunctionGroup'])->name('searchFunctionGroup');
Route::get('/search-subsidiaries', [WebViewController::class, 'searchFunctionSubsidiary'])->name('searchFunctionSubsidiary');
Route::get('/search-other-companies', [WebViewController::class, 'searchFunctionOtherCompany'])->name('searchFunctionOtherCompany');
Route::get('/search-shareholders', [WebViewController::class, 'searchFunctionShareholder'])->name('searchFunctionShareholder');
Route::get('/search-sra', [WebViewController::class, 'searchFunctionSRA'])->name('searchFunctionSRA');

// Route::get('/features', [ProfileController::class, 'feature'])->name('feature');
Route::get('/group-feature', [WebViewController::class, 'groupFeature'])->name('groupFeature');
Route::get('/subsidiary-feature', [WebViewController::class, 'subsidiaryFeature'])->name('subsidiaryFeature');
Route::get('/shareholder-feature', [WebViewController::class, 'shareholderFeature'])->name('shareholderFeature');
Route::get('/sra-feature', [WebViewController::class, 'sraFeature'])->name('sraFeature');
// Route::get('/serve-pdf/{filename}', [CorporateProfileController::class, 'servePDF'])->name('serve.pdf');


// Route::get('/term-and-condition', [ProfileController::class, 'termAndCondition'])->name('termAndCondition');
// Route::get('/privacy-and-policy', [ProfileController::class, 'privacyPolicy'])->name('privacyPolicy');
// Route::get('/user-guide', [CorporateProfileController::class, 'userGuide'])->name('userGuide');
// Route::get('/faqs', [FaqController::class, 'faq'])->name('faq');

// // End website corporate profile

// Route::get('/search', [CorporateProfileController::class, 'search'])->name('search');
// Route::get('/maps', [CorporateProfileController::class, 'maps'])->name('maps');
// Route::post('/maps', [CorporateProfileController::class, 'maps'])->name('maps');
// Route::get('/scraping', [CorporateProfileController::class, 'scrapingLatLong'])->name('scrapingLatLong');
// Route::get('/wef', [CorporateProfileController::class, 'wef'])->name('wef');

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// // Role 
// // Route untuk user 1 (admin) yang harus login untuk mengakses dashboard
// Route::middleware('auth')->group(function () {
//     // Tambahkan route untuk mengelola dashboard dan konten lainnya di sini
// });

// // Route untuk user 2 yang tidak perlu login
// Route::get('/halaman-tertentu', function () {
//     // Logika untuk halaman dengan batasan tertentu
//     return "User";
// });


// // Route untuk user 1 yang login sebagai admin dan dapat mengelola dashboard
// Route::middleware(['auth', CheckUserLevel::class . ':Admin'])->group(function () {
//     // Tambahkan route untuk mengelola dashboard dan konten lainnya di sini
// });

// // Route untuk user 3 yang login level 1
// Route::middleware(['auth', CheckUserLevel::class . ':Standard'])->group(function () {
//     // Tambahkan route untuk fitur tertentu yang hanya bisa diakses oleh user 3
// });

// // Route untuk user 4 yang login level 2
// Route::middleware(['auth', CheckUserLevel::class . ':Premium'])->group(function () {
//     // Tambahkan route untuk fitur tertentu yang hanya bisa diakses oleh user 4
// });

// // Route untuk user 2 yang tidak perlu login tapi memiliki akses terbatas
// Route::middleware([CheckUserLevel::class . ':Basic'])->group(function () {
//     Route::get('/limited-access', function () {
//         return 'Hello user with limited access!';
//     });
// });

// Route::get('/subsidiary', [CorporateProfileController::class, 'subsidiaryList']);
// Route::get('/subsidiary/{id}', [CorporateProfileController::class, 'subsidiaryShow']);
// Route::get('/auth/google/callback', [CorporateProfileController::class, 'handleCallback']);

// Route::middleware('auth:admin')->group(function () {
//     // Your admin routes here
// });
// Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
// Route::get('/dashboard-inbox', [AdminController::class, 'inbox'])->name('inbox');

// // Contoh menggunakan Controller sebagai parameter
// Route::resources([
//     'groups' => GroupController::class,
// ]);
// Route::resources([
//     'consolidations' => ConsolidationController::class,
// ]);
// Route::resources([
//     'shareholders' => ShareholderController::class,
// ]);
// Route::resources([
//     'sras' => SraController::class,
// ]);
// Route::resources([
//     'faq' => FaqController::class,
// ]);
// Route::resources([
//     'policy' => PrivacyPolicyController::class,
// ]);
// Route::resources([
//     'term-and-conditions' => TermConditionController::class,
// ]);
// Route::resources([
//     'landing-page' => LandingPageController::class,
// ]);
// Route::resources([
//     'messages' => MessageController::class,
// ]);
// Route::post('/toggle-maintenance', [CorporateProfileController::class, 'toggleMaintenance']);
// Route::get('/maintenance-mode', [CorporateProfileController::class, 'showMaintenanceMode'])->name('maintenance.mode');
// Route::get('/test', [CorporateProfileController::class, 'showIndex'])->name('showIndex');