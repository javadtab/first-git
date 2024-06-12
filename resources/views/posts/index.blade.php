@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="titlebar">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <h1>Posts list</h1>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('posts.create') }}">Add Post</a>
                            </li>
                        </ul>
                        <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                            @csrf
                            @method ('Delete')
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </nav>

        </div>
        <hr>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @foreach ($posts as $post)
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                        </div>
                        <div>
                            <h3>{{ $post->title }}</h3>
                        </div>
                    </div>
                    <p>{{ $post->description }}</p>

                    <img class="img-fluid" style="max-width:50%;" src="{{ $post->getFirstMediaUrl('images')}}"
                        /width="150px">
                    <br>

                    <h6 class="float-end">Written By:{{ $post->user->name }}</h6>

                    <a href="{{ url('/posts/' . $post->id . '/edit') }}" class="btn btn-success" role="button">Edit</a>

                    <form method="POST" action="{{ url('/posts/' . $post->id . '/delete') }}">
                     @method('Delete')
                      @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                    <hr>
                    <hr>
                </div>
            </div>
        @endforeach
    </div>
@endsection


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Posts List</h1>
        <div class="d-flex p-2 bd-highlight mb-3">
            <a href="{{ route('posts.create') }}" class="btn btn-dark">Add</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Writer</th>
                    <th width="30%">Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $key => $post)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            <img src="{{ asset('images/'.Session::get('image')) }}" />

                        <td>
                            <a href="{{ url('/posts/' . $post->id . '/edit') }}" class="btn btn-success"
                                role="button">Edit</a>
                                @method ('Delete')
                            <a href="{{ url('/posts/delete') }}" class="btn btn-danger"
                                role="button">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>



<img class="img-fluid" style="max-width:50%;" src="{{ $post->getFirstMediaUrl('images') }}"
                                /width ="150px" ></td>
