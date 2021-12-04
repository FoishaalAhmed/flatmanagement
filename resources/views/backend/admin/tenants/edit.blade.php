@extends('backend.layouts.app')

@section('title', 'Update Tenant')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('Update Tenant') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.tenants.index') }}">{{ __('Tenant List') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('includes.error')
                        <form method="post" action="{{ route('admin.tenants.update', $tenant->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Buildings') }}</label>
                                                <select class="form-control form-small tagging" name="building_id" required
                                                    onchange="getBuildingFloors(this.value)" id="building_id">
                                                    @foreach ($buildings as $item)
                                                        <option value="{{ $item->id }}" @if ($tenant->building_id == $item->id) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Floor') }}</label>
                                                <select class="form-control form-small tagging" name="floor_id" required
                                                    id="floor_id" onchange="getBuildingFlats(this.value)">
                                                    @foreach ($floors as $item)
                                                        <option value="{{ $item->id }}" @if ($tenant->floor_id == $item->id) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Flat') }}</label>
                                                <select class="form-control form-small tagging" name="flat_id" required
                                                    id="flat_id">
                                                    @foreach ($flats as $item)
                                                        <option value="{{ $item->id }}" @if ($tenant->flat_id == $item->id) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Name') }}</label>
                                                <input type="text" name="name" placeholder="{{ __('Name') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ $tenant->name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('E-mail') }}</label>
                                                <input type="email" name="email" placeholder="{{ __('E-mail') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ $tenant->email }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Phone') }}</label>
                                                <input type="text" name="phone" placeholder="{{ __('Phone') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ $tenant->phone }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('NID') }} </label>
                                                <input type="text" name="nid" placeholder="{{ __('NID') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ $tenant->nid }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Advance Rent Payment') }}</label>
                                                <input type="number" name="advance"
                                                    placeholder="{{ __('Advance Rent Payment') }}" class="form-control"
                                                    required autocomplete="off" value="{{ $tenant->advance }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Rent Per Month') }}</label>
                                                <input type="number" name="rent" placeholder="{{ __('Rent Per Month') }}"
                                                    class="form-control" autocomplete="off"
                                                    value="{{ $tenant->rent }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group mb-0">
                                                <label for="t-text">{{ __('Issue Date') }}</label>
                                                <input type="text" name="issue_date" placeholder="{{ __('Issue Date') }}"
                                                    class="form-control flatpickr flatpickr-input active" autocomplete="off"
                                                    value="{{ $tenant->issue_date }}" id="issue_date">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 mb-xl-0 mb-2">
                                            <label for="t-text">{{ __('Issue Month') }}</label>
                                            <select class="form-control tagging" name="month" required="">
                                                @foreach ($months as $item)
                                                    <option value="{{ $item->id }}" @if ($tenant->month == $item->id) {{ 'selected' }} @endif>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-4 mb-xl-0 mb-2">
                                            <label for="t-text">{{ __('Issue Year') }}</label>
                                            <select class="form-control tagging" name="year" required="">
                                                @for ($i = date('Y'); $i >= 1921; $i--)
                                                    <option value="{{ $i }}" @if ($tenant->year == $i) {{ 'selected' }} @endif>
                                                        {{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mx-auto mb-2">
                                            <div class="form-group">
                                                <label for="permanent_address">{{ __('Permanent Address') }}</label>
                                                <textarea class="form-control"
                                                    placeholder="{{ __('Permanent Address') }}" rows="3"
                                                    name="permanent_address"
                                                    autocomplete="off">{{ $tenant->permanent_address }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 layout-top-spacing">
                                    <div class="education layout-spacing ">
                                        <div class="widget-content widget-content-area">
                                            <h3 class="">{{ __('Tenant Photo') }}</h3>
                                            <div class="text-center user-info">
                                                <img src="{{ asset($tenant->photo) }}" alt="avatar" id="tenant-photo" style="width: 100px">
                                                <p class="text-danger">
                                                    *{{ __('Photo Can Not Be Greater Than 100 KB') }}</p>
                                                <input type="file" id="input-file-max-fs" class="dropify"
                                                    name="photo" onchange="readPicture(this)" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <button class="btn btn-outline-danger mb-2"
                                            type="reset">{{ __('Reset') }}</button>
                                        <button class="btn btn-outline-primary mb-2"
                                            type="submit">{{ __('Update') }}</button>
                                    </center>
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
        function readPicture(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#tenant-photo')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

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

                url: '{{ route('admin.get.flat') }}',
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

        var f1 = flatpickr(document.getElementById('issue_date'));
    </script>

@endsection
