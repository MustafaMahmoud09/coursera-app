@if (count($reacts) != 0)
    @foreach ($reacts as $react)
        <div class="box">
            <div class="tutor">
                <img src="{{ asset('storage/' . $react->content->instructor->image_path) }}" alt="not found">
                <div>
                    <h3>{{ $react->content->instructor->name }}</h3>
                    <span>{{ formatDate($react->content->created_at) }}</span>
                </div>
            </div>
            <img src="{{ asset('storage/' . $react->content->cover_path) }}" alt="not found" class="thumb">
            <h3 class="title">{{ $react->content->title }}</h3>
            <form action="{{ route('student.content.like.delete', $react->id) }}" method="post" class="flex-btn">
                <a href="{{ route('student.playlist.content', $react->content->id) }}" class="inline-btn">watch
                    video</a>
                <a id='delete_react_{{ $react->id }}'class="inline-delete-btn" name="remove">remove</a>
            </form>
        </div>
        @include('ajax.delete-react')
    @endforeach
@else
    <p class="empty">nothing added to likes yet!</p>
@endif
