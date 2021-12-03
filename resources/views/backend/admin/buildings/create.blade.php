@extends('backend.layouts.app')

@section('title', 'New Building')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('New Building') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.buildings.index') }}">{{ __('Building List') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('includes.error')
                        <form method="post" action="{{ route('admin.buildings.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Name') }}</label>
                                                <input type="text" name="name" placeholder="{{ __('Name') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ old('name') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Floor') }}</label>
                                                <input type="number" name="floor" placeholder="{{ __('Floor') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ old('floor') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Unit') }}</label>
                                                <input type="number" name="unit" placeholder="{{ __('Unit') }}"
                                                    class="form-control" autocomplete="off" value="{{ old('unit') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 mb-xl-0 mb-2">
                                            <label for="t-text">{{ __('Guard') }}</label>
                                            <select class="form-control" name="guard" required="">
                                                <option value="1" @if (old('guard') == 1)
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Available') }}</option>

                                                <option value="0" @if (old('guard') == 0)
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Not Available') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-4 mb-xl-0 mb-2">
                                            <label for="t-text">{{ __('CCTV') }}</label>
                                            <select class="form-control" name="cctv" required="">
                                                <option value="1" @if (old('cctv') == 1)
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Available') }}</option>

                                                <option value="0" @if (old('cctv') == 0)
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Not Available') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-4 mb-xl-0 mb-2">
                                            <label for="t-text">{{ __('Parking') }}</label>
                                            <select class="form-control" name="parking" required="">
                                                <option value="1" @if (old('parking') == 1)
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Available') }}</option>

                                                <option value="0" @if (old('parking') == 0)
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Not Available') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mx-auto mb-2">
                                            <div class="form-group">
                                                <label for="address">{{ __('Address') }}</label>
                                                <textarea class="form-control" placeholder="{{ __('Address') }}"
                                                    rows="3" name="address"
                                                    autocomplete="off">{{ old('address') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 layout-top-spacing">
                                    <div class="education layout-spacing ">
                                        <div class="widget-content widget-content-area">
                                            <h3 class="">{{ __('Building Photo') }}</h3>
                                            <div class="text-center user-info">
                                                <img src="//placehold.it/100x100" alt="avatar" id="building-photo">
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
                                            type="submit">{{ __('Save') }}</button>
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
