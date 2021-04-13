@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-10 mx-auto">
            <div class="alert alert-warning" role="alert">
                <div class="d-flex justify-content-between align-items-center">
                    Fields in the csv file must be separated by `;`
                    <i class="fas fa-info-circle"></i>
                </div>
            </div>
            <import-file-component></import-file-component>
        </div>
    </div>
@endsection

