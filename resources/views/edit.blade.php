@extends('master.layout')

@section('title')
    Modifier {{$post->title}}
@endsection

@section('content')
    <div class="row my-4 mx-auto">
        <div class="col-md-8">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Modifier {{$post->title}}
                    </h3>
                    <div class="card-body">
                        <form action="{{route('posts.update' , $post->slug)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">titre</label>
                                    <input type="text" class="form-control" value="{{$post->title}}"
                                           name="title" placeholder="titre">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">image</label>
                                    <input type="file" class="form-control" name="image" placeholder="image">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Déscription</label>
                                    <textarea class="form-control" name="body"  rows="3" placeholder="description">
                                    {{$post->body}}  </textarea>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary">
                                        Valider
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
