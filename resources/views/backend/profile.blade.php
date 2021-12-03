@extends('backend.layouts.app')
@section('title', 'Profile')
@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-spacing">

            <!-- Content -->
            <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

                <div class="education layout-spacing ">
                    <div class="widget-content widget-content-area">
                        <h3 class="">{{ __('Profile') }}</h3>
                        <div class="text-center user-info">
                            <img src="{{ asset(auth()->user()->photo) }}" alt="avatar" id="profile-photo">
                            <p class="">{{ auth()->user()->name }}</p>
                            <form action="{{ route('profile.photo') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="upload mt-4 pr-md-4">
                                    <input type="file" id="input-file-max-fs" class="dropify" name="photo"
                                        onchange="readPicture(this)" />
                                </div>
                                <br />
                                <button class="btn btn-outline-primary mb-2" type="submit">{{ __('Update') }}</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="education layout-spacing ">
                    <form id="work-experience" class="section work-experience" action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        <div class="info">
                            <h5 class="">{{ __('Password') }}</h5>
                            <div class="row">
                                <div class="col-md-11 mx-auto">

                                    <div class="work-section">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="degree2">{{ __('Old Password') }}</label>
                                                    <input type="text" class="form-control mb-4" id="old_password"
                                                        placeholder="{{ __('Old Password') }}" name="old_password" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="degree2">{{ __('New Password') }}</label>
                                                            <input type="text" class="form-control mb-4"
                                                                id="new_password" placeholder="{{ __('New Password') }}"
                                                                name="password" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="degree2">{{ __('Confirm Password') }}</label>
                                                            <input type="text" class="form-control mb-4"
                                                                id="confirm_password"
                                                                placeholder="{{ __('Confirm Password') }}"
                                                                name="password_confirmation" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-outline-primary mb-2"
                                                    type="submit">{{ __('Update') }}</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">
                <div class="skills layout-spacing ">
                    @include('includes.error')
                    <form id="contact" class="section contact" action="{{ route('profile.info') }}" method="POST">
                        @csrf
                        <div class="info">
                            <h5 class="">Info</h5>
                            <div class="row">
                                <div class="col-md-11 mx-auto">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">{{ __('Name') }}</label>
                                                <input type="text" class="form-control mb-4" id="name"
                                                    placeholder="{{ __('Name') }}" name="name"
                                                    value="{{ auth()->user()->name }}" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="phone">{{ __('Phone') }}</label>
                                                <input type="text" class="form-control mb-4" id="phone"
                                                    placeholder="{{ __('Write your phone number here') }}"
                                                    value="{{ auth()->user()->phone }}" name="phone" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email">{{ __('E-mail') }}</label>
                                                <input type="text" class="form-control mb-4" id="email" name="email"
                                                    placeholder="{{ __('Write your email here') }}"
                                                    value="{{ auth()->user()->email }}" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">{{ __('Address') }}</label>
                                                <textarea class="form-control" placeholder="{{ __('Address') }}"
                                                    rows="3" name="address" autocomplete="off">{{ auth()->user()->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-outline-primary mb-2"
                                                type="submit">{{ __('Update') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                    $('#profile-photo')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
