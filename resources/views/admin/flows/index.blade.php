@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('admin.layouts.messages')
            <div class="card">
                <div class="card-header">{{ __('Flows') }}</div>

                <div class="card-body">
                    <div class="clearfix">
                        <div class="row float-right ">
                            <div class="form-group col-md-12">
                                <a href="{{ url('admin/flows/create') }}" class="btn btn-primary">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatable ">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Layout</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @isset($flows)
                                @foreach ($flows as $flow)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $flow->name }}</td>
                                        <td>{{ $flow->description }}</td>
                                        <td>{{ $flow->layout }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                              <a href="{{ url('admin/flows/' . $flow->id . '/edit/is_flow_active') }}" class="btn btn-primary">Edit</a>
                                              <button type="button" data-id="{{ $flow->id }}" class="btn btn-danger btn-flow-delete">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                              @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="flow_delete_form" data-current_url="{{ url('admin/flows') }}" method="POST" action="">
    @csrf
    @method('delete')
</form>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/admin/flows/index.js') }}"></script>
@endpush
