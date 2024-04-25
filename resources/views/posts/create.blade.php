@extends("layouts.app")
@section('content')
    <div class="container mt-5">
        <h1 class="text-center">ADD FORM</h1>
      <form method="post" action="/posts" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label class="form-label">Title</label>
          <input type="text" name="title" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label class="form-label">Body</label>
          <input type="text" name="body" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label class="form-label">Photo</label>
          <input type="file" name="photo" class="form-control" aria-describedby="emailHelp">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>
@endsection
