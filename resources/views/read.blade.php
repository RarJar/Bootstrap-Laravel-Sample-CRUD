@extends('./master')

@section('content')
    <div class="container bg-white p-3 shadow-sm mt-5">
        <h3>{{ $posts['title'] }}</h3>
        <p class="my-3">{{ $posts['description'] }}</p>
        <img src="{{ asset('storage/' . $posts['image']) }}" class="rounded" style="height: 200px">
        <div class="d-flex justify-content-end me-2 mb-2">
            <a href="{{route('post#edit',$posts['id'])}}" class="fa-solid fa-pencil text-decoration-none"> ပြင်ဆင်ရန်</a>
        </div>
    </div>
@endsection


