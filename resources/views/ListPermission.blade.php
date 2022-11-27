@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('List Permission & Roles') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-bordered table-hovered">
                            <a href="{{ route('create-permission') }}" class="btn btn-primary btn-sm m-1 mb-2">Create Permission</a>
                            <a href="{{ route('create-permission') }}" class="btn btn-success btn-sm m-1 mb-2">Create Role</a>
                            <tr>
                                <thead>
                                    <th>Role Name</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </thead>
                                @foreach ($role as $item)
                                    <tbody>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @foreach ($item->getAllPermissions() as $itemPermission)
                                                {{ $itemPermission->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <form action="">
                                                <a href="{{ route('assign-permission',$item->id) }}" class="btn btn-info btn-sm">Assign permission</a>
                                                <a href="" class="btn btn-warning btn-sm">Update</a>
                                                <button class="btn btn-danger btn-sm">Delete</button>    
                                            </form>                                            
                                        </td>
                                    </tbody>
                                @endforeach
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection