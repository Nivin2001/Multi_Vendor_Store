@extends('layouts.dashboard')
@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrump-item-active"> Categories </li>
@endsection

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary">Create </a>
        <br>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            <br>
        @endif

        @if (session()->has('info'))
            <div class="alert alert-success">
                {{ session('info') }}
            </div>
        @endif
    </div>
    <table class="table">
        <thead>
            <tr>
                <th> </th>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Created At</th>
                <th colspan="2"> Icon </th>
            </tr>
        </thead>
        <tbody>

                @forelse ($categories as $category)
                    <tr>
                        <td> <img src="{{asset('storage/' . $category->image)}}" alt="" height="50">
                        <td>{{ $category->id }}</td>
                        <td> {{ $category->name }}</td>
                        <td>{{ $category->parent_id }}</td>
                        <td> {{ $category->created_at }}</td>
                        <td>
                            <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                class="btn btn-sm btn-outline-success"> Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                                @csrf
                                <!-- Form Method Spoofing (return the request from post to delete ) -->
                                <input type="hidden" name="_method" value="delete">
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                        </td>
                    </tr>
                @empty
        
                <tr>
                    <td colspan="7">No Categories defined </td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
