<x-main-layout title="اضافة عضو في {{$name}}">
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
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form-input name='name' label='اسم العضو' />
            <x-form-input name='phone_number' label='رقم الجوال' />
            @if ($children->count() > 0)  
            <div class="form-group">
                <label for="name">اختر {{$type}}</label>
                <select id="select1" name="parent_id" class="form-control">
                    @foreach($children as $key => $value)
                    <option class="form-group" value={{$key}}>{{$value}}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div style="padding-top: 10px" class="form-group">
                <x-form-input type='hidden' name='type' label='' value='عضو مجلس' />

                <button type="submit" class="btn btn-primary">تسجيل عضو</button>
            </div>
        </form>
    </div>

</x-main-layout>