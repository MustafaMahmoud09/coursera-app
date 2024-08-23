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

        if (selectedValue === '1') {
            video.style.display = 'block';
            video_p.style.display = 'block';
            assignment.style.display = 'none';
            assignment_p.style.display = 'none';
            date.style.display = 'none';
            date_p.style.display = 'none';
        } else if (selectedValue === '2') {
            video.style.display = 'none';
            video_p.style.display = 'none';
            assignment.style.display = 'block';
            assignment_p.style.display = 'block';
            date.style.display = 'block';
            date_p.style.display = 'block';
        } else {
            video.style.display = 'none';
            video_p.style.display = 'none';
            assignment.style.display = 'none';
            assignment_p.style.display = 'none';
            date.style.display = 'none';
            date_p.style.display = 'none';
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

        if (selectedValue === '1') {
            video.style.display = 'block';
            video_p.style.display = 'block';
            assignment.style.display = 'none';
            assignment_p.style.display = 'none';
            date.style.display = 'none';
            date_p.style.display = 'none';
        } else if (selectedValue === '2') {
            video.style.display = 'none';
            video_p.style.display = 'none';
            assignment.style.display = 'block';
            assignment_p.style.display = 'block';
            date.style.display = 'block';
            date_p.style.display = 'block';
        } else {
            video.style.display = 'none';
            video_p.style.display = 'none';
            assignment.style.display = 'none';
            assignment_p.style.display = 'none';
            date.style.display = 'none';
            date_p.style.display = 'none';
        }
    });
</script>

<!-- JavaScript -->
<!--<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = location.href;

        // تحديث الحالة الحالية أو استبدالها إذا كانت موجودة من قبل
        if (window.history.state === null || window.history.state.url !== currentUrl) {
            window.history.replaceState({
                url: currentUrl
            }, document.title, currentUrl);
        }

        // التعامل مع الرجوع للصفحة السابقة
        window.onpopstate = function(event) {
            if (event.state && event.state.url === currentUrl) {
                window.history.go(-1);
            }
        };
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = location.href;

        // تحديث الحالة الحالية في الـ history stack
        history.replaceState({
            page: currentUrl
        }, document.title, currentUrl);

        // التعامل مع الرجوع للصفحة السابقة
        window.onpopstate = function(event) {
            if (event.state && event.state.page === currentUrl) {
                // إذا كانت الصفحة الحالية موجودة في الـ back stack، قم بحذفها
                history.go(-1);
            }
        };
    });
</script>-->
