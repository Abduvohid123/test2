<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

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
    Route::resource('users', 'UsersController');

    // Fan
    Route::delete('fans/destroy', 'FanController@massDestroy')->name('fans.massDestroy');
    Route::resource('fans', 'FanController');

    // Groups
    Route::delete('groups/destroy', 'GroupsController@massDestroy')->name('groups.massDestroy');
    Route::resource('groups', 'GroupsController');

    // Rooms
    Route::delete('rooms/destroy', 'RoomsController@massDestroy')->name('rooms.massDestroy');
    Route::resource('rooms', 'RoomsController');

    // Positions
    Route::delete('positions/destroy', 'PositionsController@massDestroy')->name('positions.massDestroy');
    Route::resource('positions', 'PositionsController');

    // Workers
    Route::delete('workers/destroy', 'WorkersController@massDestroy')->name('workers.massDestroy');
    Route::post('workers/media', 'WorkersController@storeMedia')->name('workers.storeMedia');
    Route::post('workers/ckmedia', 'WorkersController@storeCKEditorImages')->name('workers.storeCKEditorImages');
    Route::resource('workers', 'WorkersController');

    // Week
    Route::delete('weeks/destroy', 'WeekController@massDestroy')->name('weeks.massDestroy');
    Route::resource('weeks', 'WeekController');

    // Students
    Route::delete('students/destroy', 'StudentsController@massDestroy')->name('students.massDestroy');
    Route::post('students/media', 'StudentsController@storeMedia')->name('students.storeMedia');
    Route::post('students/ckmedia', 'StudentsController@storeCKEditorImages')->name('students.storeCKEditorImages');
    Route::resource('students', 'StudentsController');

    // Months
    Route::delete('months/destroy', 'MonthsController@massDestroy')->name('months.massDestroy');
    Route::resource('months', 'MonthsController');

    // Tolovlar
    Route::delete('tolovlars/destroy', 'TolovlarController@massDestroy')->name('tolovlars.massDestroy');
    Route::resource('tolovlars', 'TolovlarController');

    // Qoshima Chiqimlar
    Route::delete('qoshima-chiqimlars/destroy', 'QoshimaChiqimlarController@massDestroy')->name('qoshima-chiqimlars.massDestroy');
    Route::resource('qoshima-chiqimlars', 'QoshimaChiqimlarController');

    // Boshqa Ishchilar Maoshlari
    Route::delete('boshqa-ishchilar-maoshlaris/destroy', 'BoshqaIshchilarMaoshlariController@massDestroy')->name('boshqa-ishchilar-maoshlaris.massDestroy');
    Route::resource('boshqa-ishchilar-maoshlaris', 'BoshqaIshchilarMaoshlariController');

    // Add Teache To Group
    Route::delete('add-teache-to-groups/destroy', 'AddTeacheToGroupController@massDestroy')->name('add-teache-to-groups.massDestroy');
    Route::resource('add-teache-to-groups', 'AddTeacheToGroupController');

    // Progol System
    Route::delete('progol-systems/destroy', 'ProgolSystemController@massDestroy')->name('progol-systems.massDestroy');
    Route::resource('progol-systems', 'ProgolSystemController');

    // Kashalok
    Route::delete('kashaloks/destroy', 'KashalokController@massDestroy')->name('kashaloks.massDestroy');
    Route::resource('kashaloks', 'KashalokController');

    // Reklama
    Route::delete('reklamas/destroy', 'ReklamaController@massDestroy')->name('reklamas.massDestroy');
    Route::resource('reklamas', 'ReklamaController');

    // Ota Ona
    Route::delete('ota-onas/destroy', 'OtaOnaController@massDestroy')->name('ota-onas.massDestroy');
    Route::resource('ota-onas', 'OtaOnaController');

    // Viloyatlar
    Route::delete('viloyatlars/destroy', 'ViloyatlarController@massDestroy')->name('viloyatlars.massDestroy');
    Route::resource('viloyatlars', 'ViloyatlarController');

    // Tumanlar
    Route::delete('tumanlars/destroy', 'TumanlarController@massDestroy')->name('tumanlars.massDestroy');
    Route::resource('tumanlars', 'TumanlarController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Sorovnoma
    Route::delete('sorovnomas/destroy', 'SorovnomaController@massDestroy')->name('sorovnomas.massDestroy');
    Route::resource('sorovnomas', 'SorovnomaController');

    // Savol Type
    Route::delete('savol-types/destroy', 'SavolTypeController@massDestroy')->name('savol-types.massDestroy');
    Route::resource('savol-types', 'SavolTypeController');

    // Javoblar
    Route::delete('javoblars/destroy', 'JavoblarController@massDestroy')->name('javoblars.massDestroy');
    Route::post('javoblars/media', 'JavoblarController@storeMedia')->name('javoblars.storeMedia');
    Route::post('javoblars/ckmedia', 'JavoblarController@storeCKEditorImages')->name('javoblars.storeCKEditorImages');
    Route::resource('javoblars', 'JavoblarController');

    // Savollar
    Route::delete('savollars/destroy', 'SavollarController@massDestroy')->name('savollars.massDestroy');
    Route::post('savollars/media', 'SavollarController@storeMedia')->name('savollars.storeMedia');
    Route::post('savollars/ckmedia', 'SavollarController@storeCKEditorImages')->name('savollars.storeCKEditorImages');
    Route::resource('savollars', 'SavollarController');

    // Filial
    Route::delete('filials/destroy', 'FilialController@massDestroy')->name('filials.massDestroy');
    Route::resource('filials', 'FilialController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
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
