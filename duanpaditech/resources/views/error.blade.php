@extends('admin.layouts.master')

@section('title', 'Forbidden')

@section('content')
<div class="error-content" style="margin-top: 250px">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="error-text">
                    <h1 class="error">403 Forbidden</h1>
                    <div class="im-sheep">
                        <div class="top">
                            <div class="body"></div>
                            <div class="head">
                                <div class="im-eye one"></div>
                                <div class="im-eye two"></div>
                                <div class="im-ear one"></div>
                                <div class="im-ear two"></div>
                            </div>
                        </div>
                        <div class="im-legs">
                            <div class="im-leg"></div>
                            <div class="im-leg"></div>
                            <div class="im-leg"></div>
                            <div class="im-leg"></div>
                        </div>
                    </div>
                    <p>You are not allowed to view this page! </p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-round">Go to homepage</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
