<footer class="footer">

    &copy; copyright @
    <?= date('Y') ?> by <span>React Team</span>.

</footer>

<!-- custom js file link  -->
<script src="{{ asset('js/script.js') }}"></script>

<script>
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    }, false);

    document.getElementById('video').setAttribute('controlsList', 'nodownload');
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    document.getElementById('cancel_button').addEventListener('click', function() {
        var edit = document.getElementById('edit');
        edit.style.display = 'none';
    });
</script>
