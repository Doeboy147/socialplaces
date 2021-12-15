@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <router-view/>
        </div>
    </div>
</div>
@endsection
