<!--IF FIND ERRORS WHILE STUDENT REGISTERATION-->
@if ($errors->any())

    @foreach ($errors->all() as $error)
        <div class="message">
            <span>{{ $error }}</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
    @endforeach

@endif
