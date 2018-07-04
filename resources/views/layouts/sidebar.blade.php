<div class="sidebar">
<label for="label">Sort By</label><br><br>
    <a href="/myday" class="label">My day</a><br><br>
    <a href="/time" class="label">Time</a><br><br>
    <a href="/myorder" class="label">My order</a><br><br>
    <hr><br>
    <label for="label">Labels&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/label/edit">Edit</a></label><br><br>
        @foreach ($labels as $label)
            <a href="/labels/{{$label->id}}" class="label"><img src="/uploads/labels/{{$label->id}}" width="30" height="30" >{{$label->label}}</a><br><br>
        @endforeach
    <a href="/{{Auth::user()->id}}/label/create" class="label"><img src="images/image1.png" class="ml-auto" width="30" height="30" >&nbsp;&nbsp;&nbsp;Create new label</a>
    <hr><br>
    <a href="/archives" class="label">Archive</a><br><br>
    <a href="/bin" class="label">Bin</a><br><br>
</div>