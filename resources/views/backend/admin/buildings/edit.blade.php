@extends('backend.layouts.app')

@section('title', 'Update Building')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('Update Building') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.buildings.index') }}">{{ __('Building List') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('includes.error')
                        <form method="post" action="{{ route('admin.buildings.update', $building->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Name') }}</label>
                                                <input type="text" name="name" placeholder="{{ __('Name') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ $building->name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Floor') }}</label>
                                                <input type="number" name="floor" placeholder="{{ __('Floor') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ $building->floor }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Flat') }}</label>
                                                <input type="number" name="flat" placeholder="{{ __('Flat') }}"
                                                    class="form-control" autocomplete="off"
                                                    value="{{ $building->flat }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 mb-xl-0 mb-2">
                                            <label for="t-text">{{ __('Guard') }}</label>
                                            <select class="form-control" name="guard" required="">
                                                <option value="1" @if ($building->guard == 1)
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Available') }}</option>

                                                <option value="0" @if ($building->guard == 0)
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Not Available') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-4 mb-xl-0 mb-2">
                                            <label for="t-text">{{ __('CCTV') }}</label>
                                            <select class="form-control" name="cctv" required="">
                                                <option value="1" @if ($building->cctv == 1)
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Available') }}</option>

                                                <option value="0" @if ($building->cctv == 0)
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Not Available') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-4 mb-xl-0 mb-2">
                                            <label for="t-text">{{ __('Parking') }}</label>
                                            <select class="form-control" name="parking" required="">
                                                <option value="1" @if ($building->parking == 1)
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Available') }}</option>

                                                <option value="0" @if ($building->parking == 0)
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Not Available') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 mb-xl-0 mb-2">
                                            <label for="t-text">{{ __('Lift') }}</label>
                                            <select class="form-control" name="lift" required="">
                                                <option value="1" @if ($building->lift == 1)
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Available') }}</option>

                                                <option value="0" @if ($building->lift == 0)
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Not Available') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-4 mb-xl-0 mb-2">
                                            <label for="t-text">{{ __('Water') }}</label>
                                            <select class="form-control" name="water" required="">
                                                <option value="24 Hour" @if ($building->water == '24 Hour')
                                                    {{ 'selected' }}

                                                    @endif>{{ __('24 Hour') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-4 mb-xl-0 mb-2">
                                            <label for="t-text">{{ __('Gas') }}</label>
                                            <select class="form-control" name="gas" required="">
                                                <option value="Supply" @if ($building->gas == 'Supply')
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Supply') }}</option>

                                                <option value="Cylinder" @if ($building->gas == 'Cylinder')
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Cylinder') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mx-auto mb-2">
                                            <div class="form-group">
                                                <label for="address">{{ __('Address') }}</label>
                                                <textarea class="form-control" placeholder="{{ __('Address') }}"
                                                    rows="3" name="address"
                                                    autocomplete="off">{{ $building->address }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 layout-top-spacing">
                                    <div class="education layout-spacing ">
                                        <div class="widget-content widget-content-area">
                                            <h3 class="">{{ __('Building Photo') }}</h3>
                                            <div class="text-center user-info">
                                                <img src="{{ asset($building->photo) }}" alt="avatar" id="building-photo"
                                                    style="width: 100px; height: 100px;">
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
                    $('#building-photo')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
