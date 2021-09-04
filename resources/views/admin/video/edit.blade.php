<x-main-layout :title="$title">
    <form enctype="multipart/form-data" action="{{route('videos.update', [$video->id])}}" method="POST" style="width:80%" >
        @csrf
      @method('put')
      <x-form-input name="title" label="رابط الفيديو" value="{{$video->video_url}}"/>    
      <button style="padding: 10px" class="btn btn-primary">تعديل</button>
    </form>
</x-main-layout>