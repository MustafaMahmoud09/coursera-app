@if (count($comments) != 0)
    @foreach ($comments as $comment)
        <div class="box" style="order:-1">
            <div class="content"><span>{{ formatDate($comment->created_at) }}</span>
                <p> - {{ $comment->content->instructor->name }} - </p><a
                    href="{{ route('student.playlist.content', $comment->content->id) }}">view
                    content</a>
            </div>
            <p class="text">{{ $comment->comment }}</p>

            <form class="flex-btn">
                <a type="" id="edit_button_{{ $comment->id }}" class="inline-option-btn">edit
                    comment</a>
                <input type="hidden" id="type" value="1" />
                <button type="button" class="inline-delete-btn" id='delete_comment_{{ $comment->id }}'>delete
                    comment</button>
            </form>
        </div>

        @include('ajax.delete-comment')

        <script>
            document.getElementById('edit_button_{{ $comment->id }}').addEventListener('click', function() {
                var edit = document.getElementById('edit');
                edit.style.display = 'block';
                document.getElementById('comment_update_id').value = {{ $comment->id }}
                document.getElementById('comment_update').value = @json($comment->comment);
                window.scroll({
                    top: 0,
                    behavior: 'smooth' // لجعل التمرير سلسًا
                });
            });
        </script>
    @endforeach
@else
    <!--show this not comments exist -->
    <p class="empty">no comments added yet!</p>
@endif
