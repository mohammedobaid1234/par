<x-main-layout title="اضافة مجلس">
    
    <div class="container-fluid">
        <form action="{{ route('councils.update', $council->idx) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
                <x-form-input name="name" label="اسم المجلس" value="{{$council->name}}" />
                <button type="submit" class="btn btn-primary">تعديل</button>
            </form>
        </div>
    
</x-main-layout>