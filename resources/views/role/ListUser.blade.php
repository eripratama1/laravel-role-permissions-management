@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('List User') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- @canany(['View Post'])
                        
                        Jika kode ini digunakan maka setiap role yang memiliki
                        permission "View Post" bisa menhakses halaman ini

                        Perbedaannya pada canany kita bisa menambahkan 
                        lebih dari satu permission sedangkan can hanya busa menggunakan satu permission. 
                        
                            @endcanany --}}

                        {{-- @can('View Post')
                            
                        @endcan --}}

                        {{-- Menampilkan hasil looping data user dalam bentuk tabel
                        serta menampilkan role untuk setiap user --}}
                        <table class="table table-bordered table-hovered">
                            <tr>
                                <thead>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </thead>
                                @foreach ($user as $itemUser)
                                    <tbody>
                                        <td>{{ $itemUser->name }}</td>
                                        <td>{{ $itemUser->email }}</td>
                                        <td>
                                            {{-- {{ $itemUser->roles->pluck('name')->first() }} | --}}
                                            {{ $itemUser->getRoleNames('name')->first() }}
                                        </td>
                                        <td>
                                            <form action="">
                                                {{-- route untuk menambahkan role pada user --}}
                                                <a href="{{ route('assign-role', $itemUser->id) }}"
                                                    class="btn btn-info btn-sm">Assign role</a>

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
