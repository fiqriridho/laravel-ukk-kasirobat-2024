@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <marquee behavior="left" direction="left">
                            <h3>Selamat Datang | Silahkan Pilih Menu Diatas</h3>
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
