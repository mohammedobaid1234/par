<x-main-layout :title="$title">
    <form enctype="multipart/form-data" action="{{route('videos.update', [$video->id])}}" method="POST" style="width:80%" >
        @csrf
      @method('put')
      <x-form-image type="file" name="image" label="" value="{{$video->image_path}}"  />
        <x-form-textarea name="title" label="عنوان الفيديو " value="{{$video->title}}"/>
      <x-form-input name="video_url" label="رابط الفيديو" value="{{$video->video_url}}"/>    
      <button style="padding: 10px" class="btn btn-primary">تعديل</button>
    </form>
</x-main-layout>