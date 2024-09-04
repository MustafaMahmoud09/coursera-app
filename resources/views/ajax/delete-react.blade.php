<script>
    document.getElementById('delete_react_{{ $react->id }}').addEventListener('click', function(e) {
        event.preventDefault(); // Prevent the default form submission
        if (confirm('Are you sure you want to delete this react?')) {

            let formData = {
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: '{{ route('student.content.like.delete', $react->id) }}',
                type: 'DELETE',
                data: formData,
                success: function(response) {
                    $('#react_container').html(response);
                    //alert('Comment added successfully!');
                },
                error: function(xhr) {
                    console.error('Failed to delete comment:', xhr);
                }
            });
        }
    });
</script>
