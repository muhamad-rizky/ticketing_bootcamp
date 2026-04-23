<form method="POST">
@csrf
<textarea name="comment"></textarea>
<button>Send</button>
</form>

@if(session('comment'))
    {{ session('comment') }}
@endif
