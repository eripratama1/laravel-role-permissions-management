@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <!-- Kolom List With Role Permission -->
            <div class="col-md-6 mt-2 mb-2">
                <div class="card">
                    <div class="card-header">{{ __('List Permission & Roles') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h4>List Role with Permission</h4>
                        <table class="table table-bordered table-hovered">
                            <tr>
                                <thead>
                                    <th>Role Name</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </thead>
                                {{-- 
                                    Looping data role dan juga 
                                    permission dari masing-masing role

                                    untuk membuat role bisa menggunakan seeder yang sudah ada pada folder seeders
                                    atau buat method baru pada controller yang ada
                                    --}}
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
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('assign-permission', $item->id) }}"
                                                        class="btn btn-info btn-sm">Set permission</a>
                                                    <a href="{{ route('edit-permission', $item->id) }}"
                                                        class="btn btn-warning btn-sm">Update Role</a>
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tbody>
                                @endforeach
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Kolom List With Role Permission -->

            <!-- Kolom List Permission -->
            <div class="col-md-6 mt-2 mb-2">
                <div class="card">
                    <div class="card-header">
                        {{ __('List Permission') }}

                        {{-- Route untuk menambah permission baru --}}
                        <a href="{{ route('create-permission') }}" class="btn btn-primary btn-sm float-end">
                            Create Permission
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h4>List Permission</h4>
                        <table class="table table-bordered table-hovered">
                            <tr>
                                <thead>
                                    <th>Permission Name</th>
                                    <th>Action</th>
                                </thead>
                                {{-- 
                                    Looping data permission 
                                --}}
                                @foreach ($permission as $item)
                                    <tbody>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <form action="">
                                                <a href="{{ route('edit-permission', $item->id) }}"
                                                    class="btn btn-warning btn-sm">Update</a>
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
            <!-- Kolom List Permission -->

        </div>
    </div>
@endsection