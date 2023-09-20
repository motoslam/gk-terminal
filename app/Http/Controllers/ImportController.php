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

        foreach ($vehicles as $vehicle) {

            $company = Company::firstOrCreate(
                ['inn' => $vehicle['counterpartyinn']],
                [
                    'name' => $vehicle['counterpartyname'],
                    'kpp' => $vehicle['counterpartykpp']
                ]
            );

            $this->vehiclesToUpdate[] = [
                'docnum' => $vehicle['docnum'],
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
            ];

        }

        if (count($this->vehiclesToUpdate) > 0) {
            try {
                Vehicle::upsert(
                    $this->vehiclesToUpdate,
                    array('docnum'),
                    array_diff(array_keys($this->vehiclesToUpdate[0]), array('docnum'))
                );
            } catch (\Exception $exception) {
                $this->failure(
                    $exception->getMessage(),
                    $exception->getCode()
                );
            }
        }

        return $this->success(
            'Completed.',
            ['count' => count($this->vehiclesToUpdate)]
        );

    }

}
