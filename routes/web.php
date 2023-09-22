<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReactController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Str;

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


Route::get('/test', function () {
    return json_encode([
        [
            'docnum' => '17264',
            'counterpartyname' => 'АВИКА',
            'counterpartyinn' => '4825005381',
            'counterpartykpp' => '482201001',
            'numbercar' => 'В434СН',
            'numbertrailer' => 'ВР5347',
            'arrivaldate' => '18.04.2023 20:55:13',
            'notesguard' => '89117964826',
            'closingdatedelivery' => '19.04.2023 10:33:00',
            'locationcar' => 'ЗТК',
            'numberdt' => '10009/190423/3058136',
            'inningsdt' => '',
            'releasedt' => '',
            'specialistinformation' => '',
            'fitovetcontrol' => '',
            'dateappointmentinspection' => '',
            'enddateinspectionfact' => '',
            'datedeparture' => '',
            'target' => 'Импорт',
        ],
        [
            'docnum' => '17219',
            'counterpartyname' => 'Агроснабсахар ООО',
            'counterpartyinn' => '4826050108',
            'counterpartykpp' => '482101001',
            'numbercar' => 'М635МЕ',
            'numbertrailer' => 'АК6159',
            'arrivaldate' => '19.04.2023 2:13:32',
            'notesguard' => '89108761172',
            'closingdatedelivery' => '19.04.2023 9:50:00',
            'locationcar' => 'ЗТК',
            'numberdt' => '',
            'inningsdt' => '',
            'releasedt' => '',
            'specialistinformation' => '',
            'fitovetcontrol' => '',
            'dateappointmentinspection' => '',
            'enddateinspectionfact' => '',
            'datedeparture' => '',
            'target' => 'Импорт',
        ],
        [
            'docnum' => '17220',
            'counterpartyname' => 'Центр-Полимер ООО ПО',
            'counterpartyinn' => '3663131437',
            'counterpartykpp' => '366201001',
            'numbercar' => 'АХ3327 7',
            'numbertrailer' => 'TF BYJ001',
            'arrivaldate' => '19.04.2023 5:17:47',
            'notesguard' => '89101150231',
            'closingdatedelivery' => '19.04.2023 10:10:00',
            'locationcar' => 'ЗТК',
            'numberdt' => '10131010/190423/3137599',
            'inningsdt' => '19.04.2023 14:00:00',
            'releasedt' => '',
            'specialistinformation' => 'Гришаева',
            'fitovetcontrol' => '',
            'dateappointmentinspection' => '',
            'enddateinspectionfact' => '',
            'datedeparture' => '',
            'target' => 'Импорт',
        ],
    ]);
});

Route::post('/signin', [LoginController::class, 'authenticate']);

# Роутинг осуществляется React приложением
Route::get('/{path?}', [ReactController::class, 'show'])
    ->where(['path' => '.*']);
