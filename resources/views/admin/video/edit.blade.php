<x-main-layout :title="$title">
    <form enctype="multipart/form-data" action="{{route('videos.update', [$video->id])}}" method="POST" style="width:80%" >
        @csrf
      @method('put')
      <x-form-image type="file" name="image" label="" value="{{$video->image_path}}"  />
      <x-form-input name="title" label="عنوان الخبر" value="{{$video->title}}"/>
      <x-form-textarea name="body" label="محتوى الخبر" value="{{$video->body}}"/>
      <button style="padding: 10px" class="btn btn-primary">تعديل</button>
    </form>
</x-main-layout>