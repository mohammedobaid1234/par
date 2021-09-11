<x-main-layout :title="$title">
    <div class="container-fluid">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form-input name='name' label='اسم العضو' />
            <x-form-input name='phone_number' label='رقم الجوال' />
            @if ($children->count() > 0)  
            <div class="form-group">
                <label for="name">اختر {{$type}}</label>
                <select id="select1" name="council_id" class="form-control">
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