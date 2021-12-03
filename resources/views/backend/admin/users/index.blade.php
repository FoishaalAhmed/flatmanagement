@extends('backend.layouts.app')

@section('title', 'All Admin')
@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <table id="multi-column-ordering" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5%">{{ __('Sl') }}</th>
                                <th width="15%">{{ __('Name') }}</th>
                                <th width="20%">{{ __('E-mail') }}</th>
                                <th width="15%">{{ __('Phone') }}</th>
                                <th width="25%">{{ __('Address') }}</th>
                                <th width="10%">{{ __('Photo') }}</th>
                                <th width="10%">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)

                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="usr-img-frame mr-2 rounded-circle">
                                                <img alt="avatar" class="img-fluid rounded-circle"
                                                    src="{{ asset($item->photo) }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-primary mb-2"
                                            href="{{ route('admin.users.edit', $item->id) }}" title="Edit"><i
                                                class="far fa-edit"></i></a>
                                        <a class="btn btn-sm btn-outline-danger mb-2" title="Delete" href=""
                                            onclick="if(confirm('Are You Sure To Delete?')){ event.preventDefault(); getElementById('delete-form-{{ $item->id }}').submit(); } else { event.preventDefault(); }"><i
                                                class="far fa-times-circle"></i></a>
                                        <form action="{{ route('admin.users.destroy', [$item->id]) }}" method="post"
                                            style="display: none;" id="delete-form-{{ $item->id }}">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
