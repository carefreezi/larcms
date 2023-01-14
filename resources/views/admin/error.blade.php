@extends('admin.public')
@section('content')
<style>
    td span.status {
        font-size: 10px;
        font-weight: 300;
        position: absolute;
        bottom: 2px;
        width: 100%;
        transform: translate(-50%, 0);
    }

    .table td, .table th{
        border-top: 0;
        position: relative;

    }

    td .mr-2{
        padding: 5px;
        margin-bottom: 0 !important;
    }
</style>
<div class="main-content-container container-fluid px-4">
    <div class="error">
        <div class="error__content">
            <h2>{$msg}</h2>
            <h3>Something went wrong!</h3>
            <p>There was a problem on our end. Please try again later.</p>
        </div>
        <!-- / .error_content -->
    </div>
</div>
@endsection

