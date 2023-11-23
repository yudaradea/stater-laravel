@extends('backend.layouts.pages_layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Admin-Dashboard')
@section('content')
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col-12">
                <h2 class="page-title">
                    Dashboard
                </h2>
            </div>
        </div>
    </div>
    <hr>
@endsection

