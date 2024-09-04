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
                    //alert('Comment added successfully!');
                },
                error: function(xhr) {
                    console.error('Failed to delete comment:', xhr);
                }
            });
        }
    });
</script>
