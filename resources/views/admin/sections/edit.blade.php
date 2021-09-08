<x-main-layout title="{{ $title  }}">

    <div class="container-fluid">
        <form action="{{route('councils.update', $section->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <x-form-input name="name" label="اسم {{$type}}" :value="$section->name"/>
            <button type="submit" class="btn btn-primary">تعديل</button>
        </form>
    </div>

</x-main-layout>