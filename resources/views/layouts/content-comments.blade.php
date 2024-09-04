@if (count($comments) > 0)

    @foreach ($comments as $comment)
        <div class="box" style="order:-1">
            <div class="user">
                <img src="{{ asset('storage/' . $comment->student->image_path) }}" alt="">
                <div>
                    <h3>
                        {{ $comment->student->name }}
                    </h3>
                    <span>
                        {{ formatDate($comment->created_at) }}
                    </span>
                </div>
            </div>
            <p class="text">
                {{ $comment->comment }}
            </p>


            @if (auth()->guard(getStudentGaurd())->user()->id == $comment->student_id)
                <form class="flex-btn">
                    <a type="" id="edit_button_{{ $comment->id }}" class="inline-option-btn">edit
                        comment</a>
                    <input type="hidden" id="type" value="0" />
                    <button type="button" class="inline-delete-btn" id='delete_comment_{{ $comment->id }}'>delete
                        comment</button>
                </form>
            @endif
        </div>

        <script>
            document.getElementById('delete_comment_{{ $comment->id }}').addEventListener('click', function(e) {
                event.preventDefault(); // Prevent the default form submission
                if (confirm('Are you sure you want to delete this comment?')) {

                    let formData = {
                        _token: '{{ csrf_token() }}',
                        type: $('#type').val().trim()
                    };

                    $.ajax({
                        url: '{{ route('student.content.comment.delete', $comment->id) }}',
                        type: 'DELETE',
                        data: formData,
                        success: function(response) {
                            $('#comments-container').html(response);
                            alert('Comment added successfully!');
                        },
                        error: function(xhr) {
                            console.error('Failed to delete comment:', xhr);
                        }
                    });
                }
            });
        </script>

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
