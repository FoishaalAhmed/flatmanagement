@extends('backend.layouts.app')

@section('title', 'Update Owner')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('Update Owner') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.owners.index') }}">{{ __('Owner List') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('includes.error')
                        <form method="post" action="{{ route('admin.owners.update', $owner->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Name') }}</label>
                                                <input type="text" name="name" placeholder="{{ __('Name') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ $owner->name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('E-mail') }}</label>
                                                <input type="email" name="email" placeholder="{{ __('E-mail') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ $owner->email }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Phone') }}</label>
                                                <input type="text" name="phone" placeholder="{{ __('Phone') }}"
                                                    class="form-control" autocomplete="off"
                                                    value="{{ $owner->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Buildings') }}</label>
                                                <select class="form-control form-small tagging" name="building_id" required
                                                    onchange="getBuildingFlats(this.value)" id="building_id">
                                                    <option value="">{{ __('Select One Building') }}</option>
                                                    @foreach ($buildings as $item)
                                                        <option value="{{ $item->id }}" @if ($owner->building_id == $item->id) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Flats') }}</label>
                                                <select class="form-control form-small tagging" multiple="multiple"
                                                    name="flat_id[]" id="flat_id" required>
                                                    @foreach ($flats as $item)
                                                        <option value="{{ $item->id }}" @if (in_array($item->id, $flatOwners)) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="present_address">{{ __('Present Address') }}</label>
                                                <textarea class="form-control"
                                                    placeholder="{{ __('Present Address') }}" rows="3"
                                                    name="present_address"
                                                    autocomplete="off">{{ $owner->present_address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="permanent_address">{{ __('Permanent Address') }}</label>
                                                <textarea class="form-control"
                                                    placeholder="{{ __('Permanent Address') }}" rows="3"
                                                    name="permanent_address"
                                                    autocomplete="off">{{ $owner->permanent_address }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 layout-top-spacing">
                                    <div class="education layout-spacing ">
                                        <div class="widget-content widget-content-area">
                                            <h3 class="">{{ __('Owner Photo') }}</h3>
                                            <div class="text-center user-info">
                                                <img src="{{ asset($owner->photo) }}" alt="avatar" id="owner-photo">
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
                    $('#owner-photo')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function getBuildingFlats(building_id) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }
            });

            $.ajax({

                url: '{{ route('admin.get.building.flats') }}',
                method: 'POST',
                data: {
                    'building_id': building_id,
                },
                success: function(data2) {
                    let data = JSON.parse(data2);

                    $('#flat_id').find('option').remove().end();

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
    </script>

@endsection
