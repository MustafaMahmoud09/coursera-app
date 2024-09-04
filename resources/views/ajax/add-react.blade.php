<script>
    function addReactEventListeners() {
        const likeButton = document.getElementById('like_btn');
        const unlikeButton = document.getElementById('unlike_btn');

        if (likeButton) {
            likeButton.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the default form submission

                let formData = {
                    _token: '{{ csrf_token() }}',
                    type: '0',
                };

                $.ajax({
                    url: '{{ route('student.content.react.store', $content->id) }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        reactCount = response.data.reactCount;
                        $('#react_container').html(response.data.view);
                        document.getElementById('react_count_id').innerText = reactCount;
                        addReactEventListeners(); // Re-add event listeners after DOM update
                    },
                    error: function(xhr) {
                        console.error('Failed to update react:', xhr);
                    }
                });
            });
        }

        if (unlikeButton) {
            unlikeButton.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the default form submission

                let formData = {
                    _token: '{{ csrf_token() }}',
                    type: '1',
                };

                $.ajax({
                    url: '{{ route('student.content.react.store', $content->id) }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        reactCount = response.data.reactCount;
                        $('#react_container').html(response.data.view);
                        document.getElementById('react_count_id').innerText = reactCount;
                        addReactEventListeners(); // Re-add event listeners after DOM update
                    },
                    error: function(xhr) {
                        console.error('Failed to update react:', xhr);
                    }
                });
            });
        }
    }

    // Call the function to add the initial event listeners
    addReactEventListeners();
</script>
