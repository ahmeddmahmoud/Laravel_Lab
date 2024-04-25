@extends("layouts.app")
@section('content')
    <div class="container">
        <div class="text-center">
            @if($post->photo)
                <img style="width:300px; height:300px" src="{{ Storage::url($post->photo) }}" alt="Post Photo">
            @endif
        </div>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Body</th>
                <th>Posted By</th>
            </tr>
            <tr>
                <td>{{$post['id']}}</td>
                <td>{{$post['title']}}</td>
                <td>{{$post['body']}}</td>
                <td>{{$post['user']->name}}</td>
            </tr>
        </table>
        <div class="card mt-3">
                <div class="card-header">
                    Comments
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($post->comments as $comment)
                        <li class="list-group-item">{{$comment['pivot']['content']}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    Write a Comment
                </div>
                <div class="card-body">
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="form-group">
                            <label for="content">Comment:</label>
                            <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
    </div>

@endsection



