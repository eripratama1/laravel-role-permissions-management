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
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $role->name }}" class="form-control"
                                    id="">
                            </div>
                            {{-- <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $user->email }}"
                                    id="">
                            </div> --}}

                            {{-- <div class="form-group mb-3">
                                <label for="">Role Sekarang : {{ $user->roles->pluck('name')->first() }}</label>
                                <select name="role" id="" class="form-control">
                                    @foreach ($role as $itemRole)
                                        <option value="{{ $itemRole->id }}"
                                            @selected($itemRole->id == $user->roles->pluck('id')->first())
                                            >{{ $itemRole->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            {{-- <div class="form-group mb-3">
                                <select class="form-select" multiple aria-label="multiple select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div> --}}

                            <div class="form-group mb-3">

                                @foreach ($roles as $itemRoles)
                                    <label for="">{{ $itemRoles->name }}</label>
                                @endforeach
                                {{-- {{  $role->permissions->collect()  }} --}}

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
