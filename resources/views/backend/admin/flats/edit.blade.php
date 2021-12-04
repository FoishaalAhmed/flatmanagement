@extends('backend.layouts.app')

@section('title', 'Update Flat')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('Update Flat') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.flats.index') }}">{{ __('Flat List') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('includes.error')
                        <form method="post" action="{{ route('admin.flats.update', $flat->id) }}" method="POST"
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
                                                        <option value="{{ $item->id }}" @if ($flat->building_id == $item->id) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Floor') }}</label>
                                                <select class="form-control form-small tagging" name="floor_id" required
                                                    id="floor_id">
                                                    @foreach ($floors as $item)
                                                        <option value="{{ $item->id }}" @if ($flat->floor_id == $item->id) {{ 'selected' }} @endif>
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
                                                    value="{{ $flat->name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Area') }} <small
                                                        class="text-danger">{{ __('(*In Square Feet)') }}</small>
                                                </label>
                                                <input type="number" name="area" placeholder="{{ __('Area') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ $flat->area }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Room') }}</label>
                                                <input type="number" name="room" placeholder="{{ __('Room') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ $flat->room }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Washroom') }}</label>
                                                <input type="number" name="washroom" placeholder="{{ __('Washroom') }}"
                                                    class="form-control" autocomplete="off"
                                                    value="{{ $flat->washroom }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Balcony') }}</label>
                                                <input type="number" name="balcony" placeholder="{{ __('Balcony') }}"
                                                    class="form-control" autocomplete="off"
                                                    value="{{ $flat->balcony }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Kitchen') }}</label>
                                                <input type="number" name="kitchen" placeholder="{{ __('Kitchen') }}"
                                                    class="form-control" autocomplete="off"
                                                    value="{{ $flat->kitchen }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 mb-xl-0 mb-2">
                                            <label for="t-text">{{ __('Drawing & Dining') }}</label>
                                            <select class="form-control" name="drawing_dining" required="">
                                                <option value="Combine" @if ($flat->drawing_dining == 'Combine')
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Combine') }}</option>

                                                <option value="Separated" @if ($flat->drawing_dining == 'Separated')
                                                    {{ 'selected' }}

                                                    @endif>{{ __('Separated') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mx-auto mb-2">
                                            <div class="form-group">
                                                <label for="description">{{ __('Description') }}</label>
                                                <textarea class="form-control" placeholder="{{ __('Description') }}"
                                                    rows="3" name="description"
                                                    autocomplete="off">{{ $flat->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 layout-top-spacing">
                                    <div class="education layout-spacing ">
                                        <div class="widget-content widget-content-area">
                                            <h3 class="">{{ __('Flat Photo') }}</h3>
                                            <div class="text-center user-info">
                                                <img src="{{ asset($flat->photo) }}" alt="avatar" id="flat-photo" style="width: 100px; height: 100px;">
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
                    $('#flat-photo')
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
    </script>

@endsection
