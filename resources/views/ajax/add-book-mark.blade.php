<script>
    function addBookMarkEventListeners() {
        const saveButton = document.getElementById('save_btn');
        const unsaveButton = document.getElementById('unsave_btn');

        if (saveButton) {
            saveButton.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the default form submission

                let formData = {
                    _token: '{{ csrf_token() }}',
                    type: '0',
                };

                $.ajax({
                    url: '{{ route('student.playlist.save.store', $course->id) }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#bookmark-container').html(response);
                        addBookMarkEventListeners(); // Re-add event listeners after DOM update
                    },
                    error: function(xhr) {
                        console.error('Failed to update react:', xhr);
                    }
                });
            });
        }

        if (unsaveButton) {
            unsaveButton.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the default form submission

                let formData = {
                    _token: '{{ csrf_token() }}',
                    type: '1',
                };

                $.ajax({
                    url: '{{ route('student.playlist.save.store', $course->id) }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#bookmark-container').html(response);
                        addBookMarkEventListeners(); // Re-add event listeners after DOM update
                    },
                    error: function(xhr) {
                        console.error('Failed to update react:', xhr);
                    }
                });
            });
        }
    }

    // Call the function to add the initial event listeners
    addBookMarkEventListeners();
</script>
