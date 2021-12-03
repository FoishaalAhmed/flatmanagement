@extends('backend.layouts.app')

@section('title', 'New Admin')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('New Admin') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.users.index') }}">{{ __('Admin List') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">

                        <form method="post" action="{{ route('admin.users.store') }}" method="POST">
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
                                                <label for="t-text">{{ __('E-mail') }}</label>
                                                <input type="email" name="email" placeholder="{{ __('E-mail') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ old('email') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Phone') }}</label>
                                                <input type="text" name="phone" placeholder="{{ __('Phone') }}"
                                                    class="form-control" autocomplete="off" value="{{ old('phone') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Password') }}</label>
                                                <input type="text" name="password" placeholder="{{ __('Password') }}"
                                                    class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Confirm Password') }}</label>
                                                <input type="text" name="password_confirmation"
                                                    placeholder="{{ __('Confirm Password') }}" class="form-control"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12">
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
                                            <h3 class="">{{ __('Admin Photo') }}</h3>
                                            <div class="text-center user-info">
                                                <img src="//placehold.it/100x100" alt="avatar" id="user-photo">
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
                    $('#user-photo')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
