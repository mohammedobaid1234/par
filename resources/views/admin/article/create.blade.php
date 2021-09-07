<x-main-layout :title="$title">
    <form enctype="multipart/form-data" action="{{route('articles.store')}}" method="POST" style="width:80%" >
        @csrf
      <x-form-image type="file" name="image" label="صورة" />
      <x-form-textarea name="title" label="عنوان المقال"/>
      <x-form-input name="article_url" label="رابط المقال" />
      <button style="padding: 10px" class="btn btn-primary">اضافة </button>
    </form>
</x-main-layout>