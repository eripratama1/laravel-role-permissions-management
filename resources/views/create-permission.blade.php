@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Create Permission') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('store-permission') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Permission Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
