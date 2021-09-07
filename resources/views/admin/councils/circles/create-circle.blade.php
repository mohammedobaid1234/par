<x-main-layout title="{{ $title }}">

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
                <label for="name">اسم الدائرة</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="ادخل اسم الدائرة">
            </div>
            <div class="form-group">
                <label for="name">اختر المجلس</label>
                <select name="parent_id" class="form-control">
                    @foreach($councils as $key => $value)
                    <option class="form-group" value={{$key}}>{{$value}}</option>
                    @endforeach

                </select>
            </div>
            <button type="submit" class="btn btn-primary">اضافة</button>
        </form>
    </div>

</x-main-layout>