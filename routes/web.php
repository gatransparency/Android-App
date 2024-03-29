<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Getting Started
    Route::delete('getting-starteds/destroy', 'GettingStartedController@massDestroy')->name('getting-starteds.massDestroy');
    Route::resource('getting-starteds', 'GettingStartedController');

    // Investigating Government
    Route::delete('investigating-governments/destroy', 'InvestigatingGovernmentController@massDestroy')->name('investigating-governments.massDestroy');
    Route::resource('investigating-governments', 'InvestigatingGovernmentController');

    // Open Records Info
    Route::delete('open-records-infos/destroy', 'OpenRecordsInfoController@massDestroy')->name('open-records-infos.massDestroy');
    Route::resource('open-records-infos', 'OpenRecordsInfoController');

    // Forms
    Route::delete('forms/destroy', 'FormsController@massDestroy')->name('forms.massDestroy');
    Route::post('forms/media', 'FormsController@storeMedia')->name('forms.storeMedia');
    Route::post('forms/ckmedia', 'FormsController@storeCKEditorImages')->name('forms.storeCKEditorImages');
    Route::post('forms/parse-csv-import', 'FormsController@parseCsvImport')->name('forms.parseCsvImport');
    Route::post('forms/process-csv-import', 'FormsController@processCsvImport')->name('forms.processCsvImport');
    Route::resource('forms', 'FormsController');

    // Case Law
    Route::delete('case-laws/destroy', 'CaseLawController@massDestroy')->name('case-laws.massDestroy');
    Route::post('case-laws/media', 'CaseLawController@storeMedia')->name('case-laws.storeMedia');
    Route::post('case-laws/ckmedia', 'CaseLawController@storeCKEditorImages')->name('case-laws.storeCKEditorImages');
    Route::post('case-laws/parse-csv-import', 'CaseLawController@parseCsvImport')->name('case-laws.parseCsvImport');
    Route::post('case-laws/process-csv-import', 'CaseLawController@processCsvImport')->name('case-laws.processCsvImport');
    Route::resource('case-laws', 'CaseLawController');

    // Donations
    Route::delete('donations/destroy', 'DonationsController@massDestroy')->name('donations.massDestroy');
    Route::resource('donations', 'DonationsController');

    // Submit Record
    Route::delete('submit-records/destroy', 'SubmitRecordController@massDestroy')->name('submit-records.massDestroy');
    Route::post('submit-records/media', 'SubmitRecordController@storeMedia')->name('submit-records.storeMedia');
    Route::post('submit-records/ckmedia', 'SubmitRecordController@storeCKEditorImages')->name('submit-records.storeCKEditorImages');
    Route::post('submit-records/parse-csv-import', 'SubmitRecordController@parseCsvImport')->name('submit-records.parseCsvImport');
    Route::post('submit-records/process-csv-import', 'SubmitRecordController@processCsvImport')->name('submit-records.processCsvImport');
    Route::resource('submit-records', 'SubmitRecordController');

    // Agencies Offices
    Route::delete('agencies-offices/destroy', 'AgenciesOfficesController@massDestroy')->name('agencies-offices.massDestroy');
    Route::post('agencies-offices/media', 'AgenciesOfficesController@storeMedia')->name('agencies-offices.storeMedia');
    Route::post('agencies-offices/ckmedia', 'AgenciesOfficesController@storeCKEditorImages')->name('agencies-offices.storeCKEditorImages');
    Route::post('agencies-offices/parse-csv-import', 'AgenciesOfficesController@parseCsvImport')->name('agencies-offices.parseCsvImport');
    Route::post('agencies-offices/process-csv-import', 'AgenciesOfficesController@processCsvImport')->name('agencies-offices.processCsvImport');
    Route::resource('agencies-offices', 'AgenciesOfficesController');

    // Portal Version
    Route::delete('portal-versions/destroy', 'PortalVersionController@massDestroy')->name('portal-versions.massDestroy');
    Route::resource('portal-versions', 'PortalVersionController');

    // Bugs
    Route::delete('bugs/destroy', 'BugsController@massDestroy')->name('bugs.massDestroy');
    Route::post('bugs/parse-csv-import', 'BugsController@parseCsvImport')->name('bugs.parseCsvImport');
    Route::post('bugs/process-csv-import', 'BugsController@processCsvImport')->name('bugs.processCsvImport');
    Route::resource('bugs', 'BugsController');

    // Reportbug
    Route::delete('reportbugs/destroy', 'ReportbugController@massDestroy')->name('reportbugs.massDestroy');
    Route::resource('reportbugs', 'ReportbugController');

    // Portal Requests
    Route::delete('portal-requests/destroy', 'PortalRequestsController@massDestroy')->name('portal-requests.massDestroy');
    Route::post('portal-requests/parse-csv-import', 'PortalRequestsController@parseCsvImport')->name('portal-requests.parseCsvImport');
    Route::post('portal-requests/process-csv-import', 'PortalRequestsController@processCsvImport')->name('portal-requests.processCsvImport');
    Route::resource('portal-requests', 'PortalRequestsController');

    // Change Log
    Route::delete('change-logs/destroy', 'ChangeLogController@massDestroy')->name('change-logs.massDestroy');
    Route::post('change-logs/parse-csv-import', 'ChangeLogController@parseCsvImport')->name('change-logs.parseCsvImport');
    Route::post('change-logs/process-csv-import', 'ChangeLogController@processCsvImport')->name('change-logs.processCsvImport');
    Route::resource('change-logs', 'ChangeLogController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Public Officials
    Route::delete('public-officials/destroy', 'PublicOfficialsController@massDestroy')->name('public-officials.massDestroy');
    Route::post('public-officials/media', 'PublicOfficialsController@storeMedia')->name('public-officials.storeMedia');
    Route::post('public-officials/ckmedia', 'PublicOfficialsController@storeCKEditorImages')->name('public-officials.storeCKEditorImages');
    Route::post('public-officials/parse-csv-import', 'PublicOfficialsController@parseCsvImport')->name('public-officials.parseCsvImport');
    Route::post('public-officials/process-csv-import', 'PublicOfficialsController@processCsvImport')->name('public-officials.processCsvImport');
    Route::resource('public-officials', 'PublicOfficialsController');

    // Reports
    Route::delete('reports/destroy', 'ReportsController@massDestroy')->name('reports.massDestroy');
    Route::post('reports/parse-csv-import', 'ReportsController@parseCsvImport')->name('reports.parseCsvImport');
    Route::post('reports/process-csv-import', 'ReportsController@processCsvImport')->name('reports.processCsvImport');
    Route::resource('reports', 'ReportsController');

    // Records
    Route::delete('records/destroy', 'RecordsController@massDestroy')->name('records.massDestroy');
    Route::post('records/media', 'RecordsController@storeMedia')->name('records.storeMedia');
    Route::post('records/ckmedia', 'RecordsController@storeCKEditorImages')->name('records.storeCKEditorImages');
    Route::post('records/parse-csv-import', 'RecordsController@parseCsvImport')->name('records.parseCsvImport');
    Route::post('records/process-csv-import', 'RecordsController@processCsvImport')->name('records.processCsvImport');
    Route::resource('records', 'RecordsController');

    // Vehicles
    Route::delete('vehicles/destroy', 'VehiclesController@massDestroy')->name('vehicles.massDestroy');
    Route::post('vehicles/media', 'VehiclesController@storeMedia')->name('vehicles.storeMedia');
    Route::post('vehicles/ckmedia', 'VehiclesController@storeCKEditorImages')->name('vehicles.storeCKEditorImages');
    Route::post('vehicles/parse-csv-import', 'VehiclesController@parseCsvImport')->name('vehicles.parseCsvImport');
    Route::post('vehicles/process-csv-import', 'VehiclesController@processCsvImport')->name('vehicles.processCsvImport');
    Route::resource('vehicles', 'VehiclesController');

    // Internal Investigations
    Route::delete('internal-investigations/destroy', 'InternalInvestigationsController@massDestroy')->name('internal-investigations.massDestroy');
    Route::post('internal-investigations/media', 'InternalInvestigationsController@storeMedia')->name('internal-investigations.storeMedia');
    Route::post('internal-investigations/ckmedia', 'InternalInvestigationsController@storeCKEditorImages')->name('internal-investigations.storeCKEditorImages');
    Route::post('internal-investigations/parse-csv-import', 'InternalInvestigationsController@parseCsvImport')->name('internal-investigations.parseCsvImport');
    Route::post('internal-investigations/process-csv-import', 'InternalInvestigationsController@processCsvImport')->name('internal-investigations.processCsvImport');
    Route::resource('internal-investigations', 'InternalInvestigationsController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
