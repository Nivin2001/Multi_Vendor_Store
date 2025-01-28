@extends('layouts.dashboard')
@section('title', 'Edit Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrump-item-active">Categories </li> <br>
    <li class="breadcrump-item-active">/Edit Categories </li>
@endsection

@section('content')
    <form action="{{ route('dashboard.categories.update',$category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
       @include('dashboard.categories._form',[
        'button_label' =>'update'
       ])



    </form>




@endsection
