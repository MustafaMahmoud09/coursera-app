<footer class="footer">

    &copy; copyright @ <?= date('Y') ?> by <span>React Team</span>.

</footer>

<script src="{{ asset('js/admin_script.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dateInput = document.getElementById('date');
        var today = new Date();
        // Format date as YYYY-MM-DD
        var day = today.getDate();
        var month = today.getMonth() + 1; // Months are zero-based
        var year = today.getFullYear();

        if (day < 10) {
            day = '0' + day;
        }

        if (month < 10) {
            month = '0' + month;
        }

        var minDate = year + '-' + month + '-' + (day + 1);
        dateInput.setAttribute('min', minDate);
    });

    document.addEventListener('DOMContentLoaded', function() {
        var selectedValue = document.getElementById('type').value;
        var video = document.getElementById('video');
        var assignment = document.getElementById('assignment');
        var video_p = document.getElementById('video_p');
        var assignment_p = document.getElementById('assignment_p');
        var date_p = document.getElementById('date_p');
        var date = document.getElementById('date');
        var lesson_p = document.getElementById('lesson_p');
        var lesson = document.getElementById('lesson');

        if (selectedValue === '1') {
            video.style.display = 'block';
            video_p.style.display = 'block';
            assignment.style.display = 'none';
            assignment_p.style.display = 'none';
            date.style.display = 'none';
            date_p.style.display = 'none';
            lesson_p.style.display = 'none';
            lesson.style.display = 'none';
        } else if (selectedValue === '2') {
            video.style.display = 'none';
            video_p.style.display = 'none';
            assignment.style.display = 'block';
            assignment_p.style.display = 'block';
            date.style.display = 'block';
            date_p.style.display = 'block';
            lesson_p.style.display = 'none';
            lesson.style.display = 'none';
        } else if (selectedValue === '3') {
            video.style.display = 'none';
            video_p.style.display = 'none';
            assignment.style.display = 'none';
            assignment_p.style.display = 'none';
            date.style.display = 'none';
            date_p.style.display = 'none';
            lesson_p.style.display = 'block';
            lesson.style.display = 'block';
        } else {
            video.style.display = 'none';
            video_p.style.display = 'none';
            assignment.style.display = 'none';
            assignment_p.style.display = 'none';
            date.style.display = 'none';
            date_p.style.display = 'none';
            lesson_p.style.display = 'none';
            lesson.style.display = 'none';
        }
    });

    document.getElementById('type').addEventListener('change', function() {
        var selectedValue = this.value;
        var video = document.getElementById('video');
        var assignment = document.getElementById('assignment');
        var video_p = document.getElementById('video_p');
        var assignment_p = document.getElementById('assignment_p');
        var date_p = document.getElementById('date_p');
        var date = document.getElementById('date');
        var lesson_p = document.getElementById('lesson_p');
        var lesson = document.getElementById('lesson');

        if (selectedValue === '1') {
            video.style.display = 'block';
            video_p.style.display = 'block';
            assignment.style.display = 'none';
            assignment_p.style.display = 'none';
            date.style.display = 'none';
            date_p.style.display = 'none';
            lesson_p.style.display = 'none';
            lesson.style.display = 'none';
        } else if (selectedValue === '2') {
            video.style.display = 'none';
            video_p.style.display = 'none';
            assignment.style.display = 'block';
            assignment_p.style.display = 'block';
            date.style.display = 'block';
            date_p.style.display = 'block';
            lesson_p.style.display = 'none';
            lesson.style.display = 'none';
        } else if (selectedValue === '3') {
            video.style.display = 'none';
            video_p.style.display = 'none';
            assignment.style.display = 'none';
            assignment_p.style.display = 'none';
            date.style.display = 'none';
            date_p.style.display = 'none';
            lesson_p.style.display = 'block';
            lesson.style.display = 'block';
        } else {
            video.style.display = 'none';
            video_p.style.display = 'none';
            assignment.style.display = 'none';
            assignment_p.style.display = 'none';
            date.style.display = 'none';
            date_p.style.display = 'none';
            lesson_p.style.display = 'none';
            lesson.style.display = 'none';
        }
    });
</script>

<script>
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    }, false);

    document.getElementById('video').setAttribute('controlsList', 'nodownload');
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
