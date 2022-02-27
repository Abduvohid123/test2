<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Fan
    Route::apiResource('fans', 'FanApiController');

    // Groups
    Route::apiResource('groups', 'GroupsApiController');

    // Rooms
    Route::apiResource('rooms', 'RoomsApiController');

    // Positions
    Route::apiResource('positions', 'PositionsApiController');

    // Workers
    Route::post('workers/media', 'WorkersApiController@storeMedia')->name('workers.storeMedia');
    Route::apiResource('workers', 'WorkersApiController');

    // Week
    Route::apiResource('weeks', 'WeekApiController');

    // Students
    Route::post('students/media', 'StudentsApiController@storeMedia')->name('students.storeMedia');
    Route::apiResource('students', 'StudentsApiController');

    // Months
    Route::apiResource('months', 'MonthsApiController');

    // Tolovlar
    Route::apiResource('tolovlars', 'TolovlarApiController');

    // Qoshima Chiqimlar
    Route::apiResource('qoshima-chiqimlars', 'QoshimaChiqimlarApiController');

    // Boshqa Ishchilar Maoshlari
    Route::apiResource('boshqa-ishchilar-maoshlaris', 'BoshqaIshchilarMaoshlariApiController');

    // Add Teache To Group
    Route::apiResource('add-teache-to-groups', 'AddTeacheToGroupApiController');

    // Progol System
    Route::apiResource('progol-systems', 'ProgolSystemApiController');

    // Kashalok
    Route::apiResource('kashaloks', 'KashalokApiController');

    // Reklama
    Route::apiResource('reklamas', 'ReklamaApiController');

    // Ota Ona
    Route::apiResource('ota-onas', 'OtaOnaApiController');

    // Viloyatlar
    Route::apiResource('viloyatlars', 'ViloyatlarApiController');

    // Sorovnoma
    Route::apiResource('sorovnomas', 'SorovnomaApiController');

    // Savol Type
    Route::apiResource('savol-types', 'SavolTypeApiController');

    // Javoblar
    Route::post('javoblars/media', 'JavoblarApiController@storeMedia')->name('javoblars.storeMedia');
    Route::apiResource('javoblars', 'JavoblarApiController');

    // Savollar
    Route::post('savollars/media', 'SavollarApiController@storeMedia')->name('savollars.storeMedia');
    Route::apiResource('savollars', 'SavollarApiController');

    // Filial
    Route::apiResource('filials', 'FilialApiController');
});
