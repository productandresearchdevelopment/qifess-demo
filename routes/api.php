<?php
use App\Http\Controllers\Main;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Owners\Owner;
use App\Models\Vendors\Vendor;
use App\Models\WorkOrders\Masters\Activity;
use App\Models\WorkOrders\Masters\Service;
use App\Models\WorkOrders\Masters\Status;
use App\SystemModels\Auth\User;
use Illuminate\Http\Request;

Main::deployRoutes();
LoginController::routeMobile();

Route::get('/', function (Request $request){
    return 'Server Running...'.$request->header('token');
});
Route::get('/file/{id?}', '\Main@fileUpload');

// MOBILE API ----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => ['mobileRoles'] ], function() {
    // GLOBAL DATA -------------------------------------------------------------------------------
    Route::group(['prefix' => 'profile'], function(){
        Route::post('/edit', '\App\Http\Controllers\Main@profileEdit')->name('api.profile.edit');
        Route::post('/password', '\App\Http\Controllers\Main@profilePassword')->name('api.profile.password');
        Route::post('/upload/photo', '\App\Http\Controllers\Main@uploadPhoto')->name('api.profile.upload');
    });

    // GLOBAL DATA -------------------------------------------------------------------------------
    Route::group(['prefix' => 'global'], function (){
        Route::get('/data', function (Request $request){
            $user = $request->user();
            return [
                'user' => User::with('role')->find($user->id),
                'activities' => $user->activities ? Activity::whereIn('id', $user->activities)->get() : Activity::all(),
                'owners' => $user->owners ? Owner::whereIn('id', $user->owners)->get() : Owner::all(),
                'vendors' => $user->vendor_id ? Vendor::where('id', $user->vendor_id)->get() : Vendor::all(),
                'services' => Service::all(),
                'status' => Status::with('details.options')->get(),
                'part_types' => ['SPAREPART', 'EQUIPMENT'],
            ];
        })->name('api.global.data');
    });

    // WO ROUTE ----------------------------------------------------------------------------------
    Route::group(['prefix' => 'wo'], function (){
        Route::get('/get/{id?}', 'WorkOrders\WorkOrder@get')->name('api.wo.get');
        Route::get('/data', 'WorkOrders\WorkOrder@data')->name('api.wo.data');
        Route::get('/data/archive', 'WorkOrders\WorkOrder@dataArchive')->name('api.wo.data.archive');
        Route::get('/data/site', 'WorkOrders\WorkOrder@dataSite')->name('api.wo.data.site');
        Route::get('/data/fieldtech', 'WorkOrders\WorkOrder@dataFieldtech')->name('api.wo.data.fieldtech');
        Route::post('/push/action/{wo?}/{status?}', 'WorkOrders\WorkOrder@pushAction')->name('api.wo.push.action');
        Route::post('/push/part/{id?}', 'WorkOrders\WorkOrder@pushPart')->name('api.wo.push.part');
        Route::post('/delete/part', 'WorkOrders\WorkOrder@deletePart')->name('api.wo.delete.part');
    });

    // REPORT & EXPORT ----------------------------------------------------------------------
    Route::group(['prefix' => 'export'], function (){
        Route::get('/wo/pdf/{id?}', 'Reports\Report@woPdf')->name('api.report.wo.pdf');
        Route::get('/bast/pdf/{id?}', 'Reports\Report@bastPdf')->name('api.report.bast.pdf');
    });
});

// PUBLIC API ----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => ['publicApiRoles'] ], function() {
    Route::group(['prefix' => 'public'], function (){
        Route::get('/', function (Request $request){
            return 'Server Is Running...';
        });

        Route::get('master', function (Request $request){
            $activities = Activity::all();
            foreach ($activities AS $activity){
                $status = Status::where('activities', 'LIKE', "%$activity->id%")->where('type', 0)->first();
                $details = $status->details()->where('type', 'text')->select('id', 'type', 'name')->get();
                $activity->properties = $details;
            }

            $data = [
                'activities' => $activities, //Activity::all(),
                'owners' => Owner::all(),
                'services' => Service::all(),
            ];
            return $data;
        })->name('api.public.master');

        // CLIENT ------------------------------------------------------------------------------------------------------
        Route::group(['prefix' => 'client'], function (){
            Route::get('/data', 'Clients\Client@dataPublic')->name('api.public.client.data');
            Route::get('/get/{id?}', 'Clients\Client@get')->name('api.public.client.get');
            Route::post('/push', 'Clients\Client@push')->name('api.public.client.push');
        });

        // SITE --------------------------------------------------------------------------------------------------------
        Route::group(['prefix' => 'site'], function (){
            Route::get('/data', 'Sites\Site@dataPublic')->name('api.public.site.data');
            Route::get('/get/{id?}', 'Sites\Site@get')->name('api.public.site.get');
            Route::post('/push', 'Sites\Site@push')->name('api.public.site.push');
        });

        // WORKORDER ---------------------------------------------------------------------------------------------------
        Route::group(['prefix' => 'wo'], function (){
            Route::get('/get/{id?}', 'WorkOrders\WorkOrder@getPublic')->name('api.public.wo.get');
            Route::post('/push', 'WorkOrders\WorkOrder@push')->name('api.public.wo.push');
        });
    });
});


