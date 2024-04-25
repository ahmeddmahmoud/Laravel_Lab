@extends("layouts.app")
@section('content')

     <div class="container">
        <h1 class="text-center my-3">Posts</h1>
        <table class="table">
            <tr>
                <th>Title</th>
                <th>Photo</th>
                <th>Body</th>
                <th>Posted By</th>
                <th>Actions</th>
            </tr>
        @foreach ($posts as $post)
            <tr>
                <td>{{$post['title']}}</td>
                <td>
                @if($post->photo)
                    <img style="width:50px; height:50px" src="{{ Storage::url($post->photo) }}" alt="Post Photo">
                @endif
                </td>
                <td>{{$post['body']}}</td>
                <td>{{$post['user']->name}}</td>
                <td>
                    <a  href="/posts/{{$post['id']}}" class="btn btn-info">View</a>
                    <a  href="/posts/{{$post['id']}}/edit" class="btn btn-primary">edit</a>
                    <form  method="post" action="/posts/{{$post['id']}}" class='d-inline'>
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger" >Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </table>
        {{ $posts->links('pagination::bootstrap-4') }}
        <a href='/posts/create' class="btn btn-success">Create</a>
    </div>

@endsection
