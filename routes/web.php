<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AgencyIncomeController;
use App\http\Controllers\AgencyExpController;
use App\Http\Controllers\HomeExpController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\DealershipController;
use App\Http\Controllers\ProjectManagementController;
use App\Http\Controllers\ProjectConstructionController;
use App\Http\Controllers\DealedPropertyPaymentController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\ProjectExpensesController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\ProjExpenseReportController;
use App\Http\Controllers\DisplayDebtsController;
use App\Http\Controllers\DisplayClaimsController;
use App\Http\Controllers\AltDebtsController;
use App\Http\Controllers\AltClaimsController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\EmployeesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;
use App\Models\AgencyIncome;
use App\Models\AltClaims;
use App\Models\ProjectExpenses;
use App\Models\Properties;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function(){
    return view('welcome');
});



    Route::group(array('middleware' => 'auth'), function() {
        Route::resource('agencies', AgencyController::class);
        Route::resource('agenciesIncome', AgencyIncomeController::class);
        Route::resource('agenciesExp', AgencyExpController::class);
        Route::resource('HomeExp', HomeExpController::class);
        Route::resource('properties', PropertiesController::class);
        Route::get     ('dealer/{id}', [DealershipController::class, 'index']);
        Route::resource('dealership', DealershipController::class);
        Route::resource('projectmanagement', ProjectManagementController::class);
        Route::get     ('dealedproppayment/{id}', [DealedPropertyPaymentController::class, 'index']);
        Route::resource('dealedpropertypayment', DealedPropertyPaymentController::class);
        Route::get     ('projectconst/{id}', [ProjectConstructionController::class, 'index']);
        Route::resource('projectconstruction', ProjectConstructionController::class);
        Route::get     ('projectExp/{id}', [ProjectExpensesController::class, 'index']);
        Route::resource('projectExpenses', ProjectExpensesController::class);
        Route::resource('companies', CompaniesController::class);
        Route::resource('notes', NotesController::class);
        Route::resource('toDocs', DocumentsController::class);
        Route::resource('toProjExpenseReport', ProjExpenseReportController::class);
        Route::get     ('toDebts', [DisplayDebtsController::class,'index']);
        Route::get     ('toClaim', [DisplayClaimsController::class,'index']);
        Route::resource('toAltDebts', AltDebtsController::class);
        Route::resource('toAltClaims', AltClaimsController::class);
        Route::resource('toPartnersReg', PartnersController::class);
        Route::resource('toEmployees', EmployeesController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('dashboard', DashboardController::class);
        Route::get     ('data',[AgencyController::class, 'fetchagencies']);
        Route::get     ('AgencyExpenses',[AgencyExpController::class, 'expense']);
        Route::get     ('AgencyIncomes', [AgencyIncomeController::class, 'income']);
        Route::get     ('getcompanies', [CompaniesController::class, 'company']);
        Route::get     ('getClaims', [AltClaimsController::class, 'claims']);
        Route::get     ('getDebts', [AltDebtsController::class, 'debts']);
        Route::get     ('getEmployees', [EmployeesController::class, 'employees']);
        Route::get     ('getNotes', [NotesController::class, 'notes']);
        Route::get     ('getPartners', [PartnersController::class, 'partners']);
        Route::get     ('getPersonalExp', [HomeExpController::class, 'homeExp']);
        Route::get     ('getDocs', [DocumentsController::class, 'documents']);
        Route::get     ('getProperties', [PropertiesController::class, 'properties']);
        Route::get     ('getDeals', [DealershipController::class, 'Deals']);
        Route::get     ('getDealPropPay', [DealedPropertyPaymentController::class, 'payment']);
        Route::get     ('getprojects', [ProjectManagementController::class, 'projects']);
        Route::get     ('getprojectConst', [ProjectConstructionController::class, 'projectsConst']);
        Route::get     ('getprojectExp', [ProjectExpensesController::class, 'projectsExp']);
        Route::get     ('getprojectExpReport', [ProjExpenseReportController::class, 'projectsExpReport']);
        
    });

    // Route::middleware(['auth:sanctum', 'verified'])->get('/agencies', function () {
        
    // })->name('agencies');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboar', function () {
    return redirect()->route('dashboard');
})->name('dashboard');
