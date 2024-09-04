<a href="{{ route('student.playlist', $content->course->id) }}" class="inline-btn">view playlist</a>

@if ($isUserReacted)
    <!--show this button if user liked video before-->
    <button id='unlike_btn'><i class="fas fa-heart"></i><span>liked</span></button>
@else
    <!--show this button if user not liked video before-->
    <button id='like_btn'><i class="far fa-heart"></i><span>like</span></button>
@endif
