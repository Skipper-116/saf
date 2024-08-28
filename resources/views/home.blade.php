@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- loop through the stats array -->
        @foreach ($stats as $stat)
            <div class="col-md-4 mb-5">
                <div class="card">
                    <div class="card-header text-center">{{ $stat['name'] }}</div>

                    <div class="card-body">
                        <h1 class="text-center text-primary">{{ $stat['count'] }}</h1>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
