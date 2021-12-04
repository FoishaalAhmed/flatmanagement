<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id', 'floor_id', 'flat_id', 'tenant_id', 'invoice', 'date', 'rent', 'month', 'year', 'water_bill', 'gas_bill', 'electricity_bill', 'security_bill', 'utility_bill', 'service_bill', 'other_bill', 'total_rent', 'paid', 'status',
    ];

    public function getRents()
    {
        $rents = $this->join('buildings', 'rents.building_id', '=', 'buildings.id')
            ->join('flats', 'rents.flat_id', '=', 'flats.id')
            ->join('tenants', 'rents.tenant_id', '=', 'tenants.id')
            ->orderBy('rents.date', 'desc')
            ->orderBy('buildings.name', 'asc')
            ->orderBy('flats.name', 'asc')
            ->select('rents.*', 'buildings.name as building', 'flats.name as flat', 'tenants.name as tenant')
            ->get();
        return $rents;
    }

    public function storeRent(Object $request)
    {
        $count = Rent::where('date', date('Y-m-d'))->count();
        $invoice = date('Ymd') . $count;
        $this->building_id = $request->building_id;
        $this->floor_id = $request->floor_id;
        $this->flat_id = $request->flat_id;
        $this->tenant_id = $request->tenant_id;
        $this->invoice = $invoice;
        $this->date = $request->date;
        $this->rent = $request->rent;
        $this->month = $request->month;
        $this->year = $request->year;
        $this->water_bill = $request->water_bill;
        $this->gas_bill = $request->gas_bill;
        $this->electricity_bill = $request->electricity_bill;
        $this->security_bill = $request->security_bill;
        $this->utility_bill = $request->utility_bill;
        $this->service_bill = $request->service_bill;
        $this->other_bill = $request->other_bill;
        $this->total_rent = $request->total_rent;
        $this->paid = $request->paid;
        $storeRent = $this->save();

        $storeRent
            ? session()->flash('success', 'Rent Collected Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }

    public function destroyRent(Object $rent)
    {
        $destroyRent = $rent->save();

        $destroyRent
            ? session()->flash('success', 'Rent Collection Deleted Successfully!')
            : session()->flash('error', 'Something Went Wrong!');
    }
}
