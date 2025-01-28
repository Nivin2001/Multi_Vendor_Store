@extends('layouts.dashboard')
@section('title', 'Page Title')
{{-- // بعمل ال yield ,section
//للاشياء المتغيرة بالمحتوى --}}

@section('breadcrumb')
@parent
<li class="breadcrump-item-active">Starter Page </li>
@endsection


@push('styles')
<link rel="stylesheet" href="{{ asset('cms/dist/css/style.css') }}">
@endpush
@push('styles')
<link rel="stylesheet" href="{{ asset('cms/dist/css/style2.css') }}">
@endpush
@push('scripts')
<script src={{ asset('cms/build/js/Dropdown.js')}}
@endpush
