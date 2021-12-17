@extends('backend.layouts.app')

@section('title', 'Update Cost')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('Update Cost') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.costs.index') }}">{{ __('Cost List') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('includes.error')
                        <form method="post" action="{{ route('admin.costs.update', $cost->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Type') }}</label>
                                        <select class="form-control form-small tagging" name="type" id="type" required
                                            onchange="showHideBuildingFloorAndFlat(this.value)">
                                            <option value="Building" @if ($cost->type == 'Building') {{ 'selected' }} @endif>{{ __('Building') }}
                                            </option>
                                            <option value="Floor" @if ($cost->type == 'Floor') {{ 'selected' }} @endif>{{ __('Floor') }}</option>
                                            <option value="Flat" @if ($cost->type == 'Flat') {{ 'selected' }} @endif>{{ __('Flat') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Building') }}</label>
                                        <select class="form-control form-small tagging" name="building_id" id="building_id"
                                            required onchange="getBuildingFloors(this.value)">
                                            <option value="">{{ __('Select One Building') }}</option>
                                            @foreach ($buildings as $item)
                                                <option value="{{ $item->id }}" @if ($item->id == $cost->building_id) {{ 'selected' }} @endif>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto" id="Floor" style="display:@if($cost->type != 'Floor' || $cost->type != 'Flat') {{ 'none' }} @endif;">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Floor') }}</label>
                                        <select class="form-control form-small tagging" name="floor_id" id="floor_id"
                                            required onchange="getBuildingFlats(this.value)">
                                            @foreach ($floors as $item)
                                                <option value="{{ $item->id }}" @if ($item->id == $cost->floor_id) {{ 'selected' }} @endif>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto" id="Flat" style="display:@if($cost->type != 'Flat') {{ 'none' }} @endif;">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Flat') }}</label>
                                        <select class="form-control form-small tagging" name="flat_id" id="flat_id"
                                            required>
                                            @foreach ($flats as $item)
                                                <option value="{{ $item->id }}" @if ($item->id == $cost->flat_id) {{ 'selected' }} @endif>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Date') }}</label>
                                        <input type="text" name="date" placeholder="{{ __('Date') }}"
                                            class="form-control" required autocomplete="off" value="{{ $cost->date }}"
                                            id="date">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Cause') }}</label>
                                        <input type="text" name="cause" placeholder="{{ __('cause') }}"
                                            class="form-control" autocomplete="off" value="{{ $cost->cause }}"
                                            id="cause">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Amount') }}</label>
                                        <input type="number" name="amount" placeholder="{{ __('Amount') }}"
                                            class="form-control" autocomplete="off" value="{{ $cost->amount }}"
                                            id="amount">
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

        function showHideBuildingFloorAndFlat(type) {

            if (type == 'Building') {
                $('#Floor').hide();
                $('#Flat').hide();
            } else if (type == 'Floor') {
                $('#Floor').show();
                $('#Flat').hide();
            } else {
                $('#Floor').show();
                $('#Flat').show();
            }
        }
    </script>

@endsection
