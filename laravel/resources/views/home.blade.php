@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('update-icon') }}" method="post" enctype="multipart/form-data">

                      @csrf
                      @method('post')

                      <input class="form-control mb-3" type="file" name="icon" value="">

                      <input class="btn btn-primary" type="submit" name="" value="Update Icon">

                      <a href="{{ route('clear-icon') }}" class="btn btn-danger">Delete</a>

                    </form>


                </div>
            </div>

            @if (Auth::user() -> icon)

              <div class="card">

                  <div class="card-header">{{ __('Icon') }}</div>

                  <img src="{{ asset('storage/icon/' . Auth::user() -> icon) }}" width="100%">

              </div>

            @endif


        </div>
    </div>
</div>
@endsection
