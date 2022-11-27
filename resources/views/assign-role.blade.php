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
                        <form action="{{ route('set-role',$user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $user->email }}" id="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Role Sekarang : {{ $user->roles->pluck('name')->first() }}</label>
                                <select name="role" id="" class="form-control">
                                    @foreach ($role as $itemRole)
                                        <option value="{{ $itemRole->id }}"
                                            @selected($itemRole->id == $user->roles->pluck('id')->first())
                                            >{{ $itemRole->name }}</option>
                                    @endforeach
                                </select>
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
