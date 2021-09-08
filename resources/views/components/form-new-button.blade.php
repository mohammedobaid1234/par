{{-- <div style="margin-bottom: 10px; dir:rtl" >
    <form action="{{route("$action", $id ?? '')}}" method="GET">
        <button class="btn btn-primary" >{{$label}}</button>
      </form>
</div> --}}

<div  style="margin-bottom: 10px; dir:rtl">
  <a class="btn btn-primary" href="{{route("$action", $id ?? '')}}">{{$label}}</a>
</div>