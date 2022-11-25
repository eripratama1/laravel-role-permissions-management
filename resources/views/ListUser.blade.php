@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-bordered table-hovered">
                            <tr>
                                <thead>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </thead>
                                @foreach ($user as $itemUser)
                                    <tbody>
                                        <td>{{ $itemUser->name }}</td>
                                        <td>{{ $itemUser->email }}</td>
                                        <td>
                                            {{ $itemUser->roles->pluck('name')->first() }} |
                                            {{ $itemUser->getRoleNames('name')->first() }}
                                            
                                        </td>
                                        <td>
                                            <form action="">
                                                <a href="{{ route('assign-role') }}" class="btn btn-info btn-sm">Assign role & permission</a>
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
