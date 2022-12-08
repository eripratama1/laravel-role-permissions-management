@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Set Permission') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('set-permission', $role) }}" method="POST">
                            {{-- 
                                action route set-permission untuk menambahkan permission pada role tertentu 
                                method yang digunakan hampir sama pada views assign-role 
                                --}}
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $role->name }}" class="form-control"
                                    id="">
                            </div>
                         
                            <div class="form-group mb-3">
                                {{-- 
                                looping data permission dari tabel permission
                                dan looping data role untuk mengetahui apakah role tersebut
                                sudah memiliki permission atau belum 

                                dan menampilkan data permission dalam checkbox
                                
                                --}}
                                @foreach ($permission as $item)
                                    <div class="form-check"> 
                                        <input class="form-check-input"
                                        @foreach ($roles as $itemRoles)
                                            {{ $itemRoles->id }}
                                            @checked($itemRoles->id == $item->id)
                                        @endforeach
                                        
                                        name="permission[]"
                                        type="checkbox" 
                                        value="{{ $item->id }}" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-info btn-sm">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
