<div style="margin-bottom: 10px; dir:rtl" >
    <form action="{{route("$action")}}" method="GET">
        @csrf
        <button class="btn btn-primary" >{{$label}}</button>
      </form>
</div>