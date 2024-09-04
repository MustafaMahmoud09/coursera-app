<script>
    $(document).ready(function() {
        $('#add_comment').on('click', function(e) {
            e.preventDefault(); // منع الإجراء الافتراضي للزر

            let comment = $('#comment').val().trim(); // الحصول على التعليق وإزالة المسافات الزائدة

            // التحقق من حجم التعليق
            if (comment.length < 1 || comment.length > 500) {
                alert('The comment must be between 1 and 500 characters.');
                return; // إيقاف العملية إذا لم يكن التعليق صالحًا
            }

            let formData = {
                _token: '{{ csrf_token() }}',
                comment: comment
            };

            $.ajax({
                type: 'POST',
                url: '{{ route('student.content.comment.store', $content->id) }}', // استبدل $content->id بالمتغير المناسب في JavaScript إذا لزم الأمر
                data: formData,
                success: function(response) {

                    $('#comments-container').html(response);
                    //alert('Comment added successfully!');

                },
                error: function(xhr, status, error) {
                    // التعامل مع الأخطاء
                    alert('There was an error adding your comment.');
                }
            });
        });
    });
</script>
