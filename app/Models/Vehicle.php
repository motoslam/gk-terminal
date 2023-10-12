<?php

namespace App\Models;

use App\Traits\Filterable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{

    use SoftDeletes, HasFactory, Filterable;

    protected $fillable = [
        'company_id',                  # ID компании
        'docnum',                      # Номер документа
        'numbercar',                   # Номер машины
        'numbertrailer',               # Номер прицепа
        'arrivaldate',                 # Дата прибытия ТС
        'notesguard',                  # Примечание охранника
        'closingdatedelivery',         # Дата и время закрытия доставки
        'locationcar',                 # Местонахождение ТС
        'numberdt',                    # Номер ДТ
        'inningsdt',                   # Дата и время подачи ДТ
        'releasedt',                   # Дата и время выпуска ДТ
        'specialistinformation',       # Информация о специалисте ТО
        'fitovetcontrol',              # Информация о Фито- Вет- контроле
        'dateappointmentinspection',   # Дата и время назначения проведения таможенного досмотра
        'enddateinspectionfact',       # Дата и время назначения окончания таможенного досмотра
        'datedeparture',               # Дата и время убытия ТС
        'target'                       # Цель въезда (импорт/экспорт)
    ];

    protected $casts = [
        'arrivaldate' => 'datetime',
        'closingdatedelivery' => 'datetime',
        'inningsdt' => 'datetime',
        'releasedt' => 'datetime',
        'dateappointmentinspection' => 'datetime',
        'enddateinspectionfact' => 'datetime',
        'datedeparture' => 'datetime',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

}
