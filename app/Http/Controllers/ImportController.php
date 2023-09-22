<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\RespondsWithHttpStatus;
use Carbon\Carbon;

class ImportController extends Controller
{
    use RespondsWithHttpStatus;

    protected $vehiclesToUpdate;

    # Импорт транспортных средств
    public function make(Request $request)
    {
        $vehicles = $request->json()->all();

        if (empty($vehicles)) {
            $this->failure('Incorrect data');
        }

        $data = [];

        foreach ($vehicles as $vehicle) {

            $company = Company::firstOrCreate(
                ['inn' => $vehicle['counterpartyinn']],
                [
                    'name' => $vehicle['counterpartyname'],
                    'kpp' => $vehicle['counterpartykpp']
                ]
            );

            try {

                $docnum = trim(preg_replace('/[^0-9]/', '', $vehicle['docnum']));

                $model = Vehicle::updateOrCreate(
                    ['docnum' => $docnum],
                    [
                        'company_id' => $company->id,
                        'numbercar' => $vehicle['numbercar'],
                        'numbertrailer' => $vehicle['numbertrailer'],
                        'arrivaldate' => parse_date($vehicle['arrivaldate']),
                        'notesguard' => $vehicle['notesguard'],
                        'closingdatedelivery' => parse_date($vehicle['closingdatedelivery']),
                        'locationcar' => $vehicle['locationcar'],
                        'numberdt' => $vehicle['numberdt'],
                        'inningsdt' => parse_date($vehicle['inningsdt']),
                        'releasedt' => parse_date($vehicle['releasedt']),
                        'specialistinformation' => $vehicle['specialistinformation'],
                        'fitovetcontrol' => $vehicle['fitovetcontrol'],
                        'dateappointmentinspection' => parse_date($vehicle['dateappointmentinspection']),
                        'enddateinspectionfact' => parse_date($vehicle['enddateinspectionfact']),
                        'datedeparture' => parse_date($vehicle['datedeparture']),
                        'target' => $vehicle['target'],
                    ]
                );

                if ($model) {
                    $data['docnum_' . $vehicle['docnum']] = [
                        'success' => true,
                        'message' => ''
                    ];
                } else {
                    $data['docnum_' . $vehicle['docnum']] = [
                        'success' => false,
                        'message' => ''
                    ];
                }

            } catch (\Exception $exception) {
                $data[$vehicle['docnum']] = [
                    'success' => false,
                    'message' => $exception->getMessage(),
                ];
            }

        }

        //terminal_db
        //terminal_user
        //H7f9T6x1

        return $this->success(
            'Completed.',
            $data
        );

    }

}
