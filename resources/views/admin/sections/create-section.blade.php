<x-main-layout title="{{ $title }}">

    <div class="container-fluid">
        <form action="{{route('sections.store', $id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form-input name="name" label="اسم {{$type}}" />
            <button type="submit" class="btn btn-primary">اضافة</button>
        </form>
    </div>

</x-main-layout>