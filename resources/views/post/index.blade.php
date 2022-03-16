<table>
    @foreach($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->active == 1 ? 'active' : 'not-active' }}</td>
            <td>{{ $post->title }}</td>
        </tr>
    @endforeach
</table>

{{  $posts->appends(request()->input())->links() }}
