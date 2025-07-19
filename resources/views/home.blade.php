@extends('layouts.app')

@section('content')

<div class="main-content">
    <div class="row row-cols-1 row-cols-xl-4">
        <div class="col">
            <div class="card border-primary border-bottom rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-6"> Total Users </p>
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">165</h4>
                        </div>
                        <div class="col-6 text-end"> 
                            <i class="material-icons-outlined display-4 text-success">group</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-success border-bottom rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-6"> All Vehicles </p>
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">155</h4>
                        </div>
                        <div class="col-6 text-end"> 
                            <i class="material-icons-outlined display-4 text-success">group</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-danger border-bottom rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-6"> Bookings </p>
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">5</h4>
                        </div>
                        <div class="col-6 text-end"> 
                            <i class="material-icons-outlined display-4 text-success">group</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-warning border-bottom rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-6"> Brands </p>
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">10</h4>
                        </div>
                        <div class="col-6 text-end"> 
                            <i class="material-icons-outlined display-4 text-success">group</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
