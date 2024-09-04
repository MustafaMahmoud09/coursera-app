<script>
    document.getElementById('update_comment_btn').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default form submission

        let comment = $('#comment_update').val().trim(); // Get comment and trim whitespace

        // Validate the comment length
        if (comment.length < 1 || comment.length > 500) {
            alert('The comment must be between 1 and 500 characters.');
            return; // Stop the process if comment is not valid
        }

        let formData = {
            _token: '{{ csrf_token() }}',
            comment: comment,
            id: $('#comment_update_id').val().trim(),
            type: $('#update_type').val().trim(),
        };

        $.ajax({
            url: '{{ route('student.content.comment.update') }}',
            type: 'PUT',
            data: formData,
            success: function(response) {
                // Update the comments section or handle response here
                $('#comments-container').html(response);
                alert('Comment updated successfully!');
            },
            error: function(xhr) {
                console.error('Failed to update comment:', xhr);
            }
        });
    });
</script>
