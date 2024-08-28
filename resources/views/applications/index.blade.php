@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <!-- left side should contain title while right side should have a button to add an application-->
                    <span class="float-start">{{ __('Applications') }}</span>
                    <a data-bs-toggle="modal" data-bs-target="#applicationModal" class="btn btn-link btn-primary float-end">Add Application</a>
                </div>

                <div class="card-body">
                    <table></table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>
</div>
@endsection