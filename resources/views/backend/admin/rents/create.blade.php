@extends('backend.layouts.app')

@section('title', 'New Rent')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('New Rent') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.rents.index') }}">{{ __('Rent List') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('includes.error')
                        <form method="post" action="{{ route('admin.rents.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Building') }}</label>
                                        <select class="form-control form-small tagging" name="building_id" id="building_id"
                                            required onchange="getBuildingFloors(this.value)">
                                            <option value="">{{ __('Select One Building') }}</option>
                                            @foreach ($buildings as $item)
                                                <option value="{{ $item->id }}" @if ($item->id == old('building_id')) {{ 'selected' }} @endif>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Floor') }}</label>
                                        <select class="form-control form-small tagging" name="floor_id" id="floor_id"
                                            required onchange="getBuildingFlats(this.value)">
                                            <option value="">{{ __('Select Building First') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Flat') }}</label>
                                        <select class="form-control form-small tagging" name="flat_id" id="flat_id" required
                                            onchange="getFlatTenants(this.value)">
                                            <option value="">{{ __('Select Floor First') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Tenant') }}</label>
                                        <select class="form-control form-small tagging" name="tenant_id" id="tenant_id"
                                            required>
                                            <option value="">{{ __('Select Flat First') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Date') }}</label>
                                        <input type="number" name="date" placeholder="{{ __('Date') }}"
                                            class="form-control" required autocomplete="off" value="{{ old('date') }}"
                                            id="date">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Rent') }}</label>
                                        <input type="number" name="rent" placeholder="{{ __('Rent') }}"
                                            class="form-control" autocomplete="off" value="{{ old('rent') }}"
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
                                                <option value="{{ $item->name }}" @if (old('month') == $item->name)
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
                                                <option value="{{ $i }}" @if (old('year') == $i) {{ 'selected' }} @endif>
                                                    {{ $i }}</option>
                                            @endfor

                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Water Bill') }}</label>
                                        <input type="number" name="water_bill" placeholder="{{ __('Water Bill') }}"
                                            class="form-control" autocomplete="off" value="{{ old('water_bill', 0) }}"
                                            id="water_bill" onclick="select()" onkeyup="calculateTotalRent()">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Gas Bill') }}</label>
                                        <input type="number" name="gas_bill" placeholder="{{ __('Gas Bill') }}"
                                            class="form-control" autocomplete="off" value="{{ old('gas_bill', 0) }}"
                                            id="gas_bill" onclick="select()" onkeyup="calculateTotalRent()">
                                    </div>
                                </div>
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Electricity Bill') }}</label>
                                        <input type="number" name="electricity_bill"
                                            placeholder="{{ __('Electricity Bill') }}" class="form-control"
                                            autocomplete="off" value="{{ old('electricity_bill', 0) }}"
                                            id="electricity_bill" onclick="select()" onkeyup="calculateTotalRent()">
                                    </div>
                                </div>
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Security Bill') }}</label>
                                        <input type="number" name="security_bill" placeholder="{{ __('Security Bill') }}"
                                            class="form-control" autocomplete="off"
                                            value="{{ old('security_bill', 0) }}" id="security_bill" onclick="select()"
                                            onkeyup="calculateTotalRent()">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Utility Bill') }}</label>
                                        <input type="number" name="utility_bill" placeholder="{{ __('Utility Bill') }}"
                                            class="form-control" autocomplete="off"
                                            value="{{ old('utility_bill', 0) }}" id="utility_bill" onclick="select()"
                                            onkeyup="calculateTotalRent()">
                                    </div>
                                </div>
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Service Bill') }}</label>
                                        <input type="number" name="service_bill" placeholder="{{ __('Service Bill') }}"
                                            class="form-control" autocomplete="off"
                                            value="{{ old('service_bill', 0) }}" id="service_bill" onclick="select()"
                                            onkeyup="calculateTotalRent()">
                                    </div>
                                </div>
                                <div class="col-xl-4 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Other Bill') }}</label>
                                        <input type="number" name="other_bill" placeholder="{{ __('Other Bill') }}"
                                            class="form-control" autocomplete="off" value="{{ old('other_bill', 0) }}"
                                            id="other_bill" onclick="select()" onkeyup="calculateTotalRent()">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Total rent') }}</label>
                                        <input type="number" name="total_rent" placeholder="{{ __('Total rent') }}"
                                            class="form-control" autocomplete="off" value="{{ old('total_rent', 0) }}"
                                            id="total_rent">
                                    </div>
                                </div>
                                <div class="col-xl-6 mb-xl-0 mb-2">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Paid') }}</label>
                                        <input type="number" name="paid" placeholder="{{ __('Paid') }}"
                                            class="form-control" autocomplete="off" value="{{ old('paid', 0) }}"
                                            id="paid" onclick="select()">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <center>
                                    <button class="btn btn-outline-danger mb-2" type="reset">{{ __('Reset') }}</button>
                                    <button class="btn btn-outline-primary mb-2" type="submit">{{ __('Save') }}</button>
                                </center>
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

        function getBuildingFloors(building_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }
            });

            let building = $('#building_id option:selected').text();

            $.ajax({

                url: '{{ route('admin.get.floor') }}',
                method: 'POST',
                data: {
                    'building_id': building_id,
                },
                success: function(data2) {

                    let data = JSON.parse(data2);

                    $('#floor_id').find('option').remove().end().append("<option value=''>Select " + building +
                        "\'s Floor</option>");

                    $.each(data, function(i, item) {
                        $("#floor_id").append($('<option>', {
                            value: this.id,
                            text: this.name,
                        }));
                    });
                },

                error: function(error) {
                    console.log(error);
                }
            });
        }

        function getBuildingFlats(floor_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }
            });

            let building_id = $('#building_id').val();
            let floor = $('#floor_id option:selected').text();

            $.ajax({

                url: '{{ route('admin.get.flats') }}',
                method: 'POST',
                data: {
                    'building_id': building_id,
                    'floor_id': floor_id,
                },
                success: function(data2) {

                    let data = JSON.parse(data2);

                    $('#flat_id').find('option').remove().end().append("<option value=''>Select " + floor +
                        "\'s Flat</option>");

                    $.each(data, function(i, item) {
                        $("#flat_id").append($('<option>', {
                            value: this.id,
                            text: this.name,
                        }));
                    });
                },

                error: function(error) {
                    console.log(error);
                }
            });
        }

        function getFlatTenants(flat_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }
            });

            let flat = $('#flat_id option:selected').text();

            $.ajax({

                url: '{{ route('admin.get.tenant') }}',
                method: 'POST',
                data: {
                    'flat_id': flat_id,
                },
                success: function(data2) {

                    let data = JSON.parse(data2);

                    $('#tenant_id').find('option').remove().end().append("<option value=''>Select " + flat +
                        "\'s Tenant</option>");

                    $.each(data, function(i, item) {
                        $("#tenant_id").append($('<option>', {
                            value: this.id,
                            text: this.name,
                        }).attr('data-rent', this.rent));
                    });
                },

                error: function(error) {
                    console.log(error);
                }
            });
        }

        $('#tenant_id').change(function() {
            var rent = $(this).find(':selected').attr('data-rent');
            $('#rent').val(rent);
        });

        function calculateTotalRent() {
            let rent = $('#rent').val();
            let water_bill = $('#water_bill').val();
            let gas_bill = $('#gas_bill').val();
            let electricity_bill = $('#electricity_bill').val();
            let security_bill = $('#security_bill').val();
            let utility_bill = $('#utility_bill').val();
            let service_bill = $('#service_bill').val();
            let other_bill = $('#other_bill').val();
            let total_rent = parseInt(rent) + parseInt(water_bill) + parseInt(gas_bill) + parseInt(electricity_bill) +
                parseInt(security_bill) + parseInt(utility_bill) + parseInt(service_bill) +
                parseInt(other_bill);
            $('#total_rent').val(total_rent);
        }
    </script>

@endsection
