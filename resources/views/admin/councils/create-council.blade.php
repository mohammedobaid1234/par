<x-main-layout title="اضافة مجلس">

    <div class="container-fluid">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('councils.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">اسم المجلس</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="ادخل اسم المجلس">
            </div>

            <button type="submit" class="btn btn-primary">اضافة</button>
        </form>
    </div>

</x-main-layout>