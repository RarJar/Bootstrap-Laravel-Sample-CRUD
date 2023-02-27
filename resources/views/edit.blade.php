@extends('./master')

@section('content')
    <form class="container bg-white p-3 shadow-sm mt-5" action="{{route('post#update',$posts['id'])}}" method="post" enctype="multipart/form-data">
        @csrf
        <h5 class="mb-2">Edit image</h5>

        <img src="{{ asset('storage/' . $posts['image']) }}" class="rounded" style="height: 200px">

        <input type="file" class="form-control mt-3" name="postImage">

        <h5 class="my-2">Post Title</h5>
        <input type="hidden" name="postId" value="{{$posts['id']}}">

        <input type="text" name="postTitle" class="form-control" value="{{ $posts['title'] }}">

        @error('postTitle')
            <small class="text-danger mt-2">{{ $message }}</small>
        @enderror

        <h5 class="my-2">Post Description</h5>
        <textarea name="postDescription" id="" cols="30" rows="10" class="my-3 form-control">{{ $posts['description'] }}</textarea>

        @error('postDescription')
            <small class="text-danger mt-2">{{ $message }}</small>
        @enderror

        <div class="d-flex justify-content-end me-2 mb-2">
            <input type="submit" class="btn btn-success" value="Update">
        </div>
    </form>
@endsection
