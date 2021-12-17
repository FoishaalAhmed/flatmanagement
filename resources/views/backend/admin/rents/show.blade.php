@extends('backend.layouts.app')

@section('title', 'Show Rent')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('Show Rent') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.rents.index') }}">{{ __('Rent List') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('includes.error')
                        <form method="post" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Building') }}</label>
                                        <select class="form-control form-small tagging" name="building_id" id="building_id"
                                            required>
                                            @foreach ($buildings as $item)
                                                <option value="{{ $item->id }}" @if ($item->id == $rent->building_id) {{ 'selected' }} @endif>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Floor') }}</label>
                                        <select class="form-control form-small tagging" name="floor_id" id="floor_id"
                                            required>
                                            @foreach ($floors as $item)
                                                <option value="{{ $item->id }}" @if ($item->id == $rent->floor_id) {{ 'selected' }} @endif>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Flat') }}</label>
                                        <select class="form-control form-small tagging" name="flat_id" id="flat_id"
                                            required>
                                            @foreach ($flats as $item)
                                                <option value="{{ $item->id }}" @if ($item->id == $rent->flat_id) {{ 'selected' }} @endif>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Tenant') }}</label>
                                        <select class="form-control form-small tagging" name="tenant_id" id="tenant_id"
                                            required>
                                            @foreach ($tenants as $item)
                                                <option value="{{ $item->id }}" @if ($item->id == $rent->tenant_id) {{ 'selected' }} @endif>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Date') }}</label>
                                        <input type="number" name="date" placeholder="{{ __('Date') }}"
                                            class="form-control" required autocomplete="off" value="{{ $rent->date }}"
                                            id="date">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Rent') }}</label>
                                        <input type="number" name="rent" placeholder="{{ __('Rent') }}"
                                            class="form-control" autocomplete="off" value="{{ $rent->rent }}"
                                            id="rent">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Month') }}</label>
                                        <select class="form-control form-small tagging" name="month" required="">
                                            @foreach ($months as $item)
                                                <option value="{{ $item->name }}" @if ($rent->month == $item->name)
                                                    {{ 'selected' }}
                                            @endif>{{ $item->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label>{{ __('Year') }} </label>
                                        <select name="year" id="year" class="form-control form-small tagging" required=""
                                            style="width: 100%;">
                                            @php
                                                $year = date('Y');
                                            @endphp
                                            @for ($i = $year; $i >= 1921; $i--)
                                                <option value="{{ $i }}" @if ($rent->year == $i) {{ 'selected' }} @endif>
                                                    {{ $i }}</option>
                                            @endfor

                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Water Bill') }}</label>
                                        <input type="number" name="water_bill" placeholder="{{ __('Water Bill') }}"
                                            class="form-control" autocomplete="off" value="{{ $rent->water_bill }}"
                                            id="water_bill">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Gas Bill') }}</label>
                                        <input type="number" name="gas_bill" placeholder="{{ __('Gas Bill') }}"
                                            class="form-control" autocomplete="off" value="{{ $rent->gas_bill }}"
                                            id="gas_bill">
                                    </div>
                                </div>
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Electricity Bill') }}</label>
                                        <input type="number" name="electricity_bill"
                                            placeholder="{{ __('Electricity Bill') }}" class="form-control"
                                            autocomplete="off" value="{{ $rent->electricity_bill }}"
                                            id="electricity_bill">
                                    </div>
                                </div>
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Security Bill') }}</label>
                                        <input type="number" name="security_bill" placeholder="{{ __('Security Bill') }}"
                                            class="form-control" autocomplete="off" value="{{ $rent->security_bill }}"
                                            id="security_bill">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Utility Bill') }}</label>
                                        <input type="number" name="utility_bill" placeholder="{{ __('Utility Bill') }}"
                                            class="form-control" autocomplete="off" value="{{ $rent->utility_bill }}"
                                            id="utility_bill">
                                    </div>
                                </div>
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Service Bill') }}</label>
                                        <input type="number" name="service_bill" placeholder="{{ __('Service Bill') }}"
                                            class="form-control" autocomplete="off" value="{{ $rent->service_bill }}"
                                            id="service_bill">
                                    </div>
                                </div>
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Other Bill') }}</label>
                                        <input type="number" name="other_bill" placeholder="{{ __('Other Bill') }}"
                                            class="form-control" autocomplete="off" value="{{ $rent->other_bill }}"
                                            id="other_bill">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Total rent') }}</label>
                                        <input type="number" name="total_rent" placeholder="{{ __('Total rent') }}"
                                            class="form-control" autocomplete="off" value="{{ $rent->total_rent }}"
                                            id="total_rent">
                                    </div>
                                </div>
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Paid') }}</label>
                                        <input type="number" name="paid" placeholder="{{ __('Paid') }}"
                                            class="form-control" autocomplete="off" value="{{ $rent->paid }}"
                                            id="paid">
                                    </div>
                                </div>
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <label for="t-text">{{ __('Status') }}</label>
                                    <select class="form-control" name="status" required="">
                                        <option value="0" @if ($rent->status == 0)
                                            {{ 'selected' }} @endif>{{ __('Not Confirmed') }}
                                        </option>

                                        <option value="1" @if ($rent->status == 1)
                                            {{ 'selected' }} @endif>{{ __('Confirmed') }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        var f1 = flatpickr(document.getElementById('date'));
    </script>
@endsection
