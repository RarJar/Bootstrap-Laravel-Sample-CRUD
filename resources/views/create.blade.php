@extends('./master')

@section('content')

<div class="container">
    <div class="row mt-5">
        <div class="col-lg-5">
            {{-- Create Toast --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>{{session('success')}}</p>
                    <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form class="p-3" action="{{route('post#create')}}" method="post" enctype="multipart/form-data">

                @csrf
                <div class="text-group d-flex flex-column mb-3">
                    <label class="mb-2">Upload image</label>
                    <input type="file" class="form-control" name="postImage">
                    @error('postImage')
                        <small class="text-danger mt-2">{{ $message }}</small>
                    @enderror

                    <label class="my-2">Post Title</label>

                    <input type="text" name="postTitle" class="form-control @error('postTitle') is-invalid @enderror" value="{{ old('postTitle')}}" placeholder="Enter post title. . .">

                    @error('postTitle')
                        <small class="text-danger mt-2">{{ $message }}</small>
                    @enderror
                </div>
                <div class="text-group d-flex flex-column mb-3">
                    <label class="mb-2">Description</label>

                    <textarea name="postDescription" id="" class="form-control @error('postDescription') is-invalid @enderror" cols="30" rows="10" placeholder="Enter post description. . .">{{ old('postDescription')}}</textarea>

                    @error('postDescription')
                        <small class="text-danger mt-2">{{ $message }}</small>
                    @enderror

                </div>
                <input type="submit" class="btn btn-danger" value="Create">
            </form>
        </div>
        <div class="col-lg-7">

            <h3 class="mb-4 text-success">Total posts - {{ $posts->total() }}</h3>

            <form action="{{ route('post#home')}}" method="get" class="input-group mb-3">
                <input type="text" class="form-control" name="searchKey" value="{{ request('searchKey') }}" placeholder="Search posts">
                <button class="btn btn-dark" type="submit">Search</button>
            </form>

            @if (count($posts) == 0 )
                <div class="col-lg-12 d-flex justify-content-center align-items-center" id="no_post_height">
                    <p class="text-danger fs-5">There is no post !</p>
                </div>
            @else

                @foreach ($posts as $item)
                    <div class="bg-white shadow-sm p-2 mb-3">
                        <h4>{{ $item['title'] }}</h4>
                        <img src="{{asset('storage/' . $item['image'])}}" class="rounded my-2" style="height: 100px">
                        <p>{{ Str::words($item['description'], 30, ' . . . ') }}</p>
                        
                        <div class="d-flex justify-content-end align-items-center">

                            <div>
                                <a href="{{ route('post#delete',$item['id']) }}" class="text-decoration-none">
                                    <i class="fa-solid fa-trash-can text-danger me-2 fs-5"></i>
                                </a>

                                <a href="{{route('post#read',$item['id'])}}" class="text-decoration-none">
                                    <i class="fa-solid fa-angles-right text-success me-2 fs-5"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach

            @endif

            {{-- Pagination --}}
            {{$posts->appends(request()->query())->links()}}

        </div>
    </div>
</div>

@endsection
