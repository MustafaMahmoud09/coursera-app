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
