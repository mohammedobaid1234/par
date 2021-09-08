<x-main-layout title="اضافة مجلس">

    <div class="container-fluid">
        <form action="{{ route('councils.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form-input name="name" label="اسم المجلس"  />
            <button type="submit" class="btn btn-primary">اضافة</button>
        </form>
    </div>

</x-main-layout>