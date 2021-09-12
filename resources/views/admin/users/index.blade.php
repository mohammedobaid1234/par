<x-main-layout title="{{$title}}">
    <x-form-new-button label='اضافة عضو جديد' action='users.newCreate' />

    @if(Session::has('success'))
    <div class="alert alert-info">{{ Session::get('success') }}</div>
    @endif
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">الاسم</th>
                    <th scope="col">رقم الجوال</th>
                    <th scope="col">حول</th>
                    <th scope="col">الصورة</th>
                    <th scope="col"> الاسم كامل</th>
                    <th scope="col">تاريخ الميلاد</th>
                    <th scope="col">الحالة الاجتماعية</th>
                    <th scope="col">النوع</th>
                    <th scope="col">الدائرة</th>
                    <th scope="col">
                        التعديل
                    </th>
                    <th scope="col">
                        الحذف
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->name }}</th>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->about }}</td>
                    <td><img width="50" height="50" style="border-radius: 10px;" src="{{ $user->image_path }}" alt=""></td>
                    <th>{{ $user->full_name }}</th>
                    <td>{{ $user->birthday }}</td>
                    <td>{{ $user->marital_status }}</td>
                    <td>{{ $user->type }}</td>
                    @if ($user->type == "عضو مجلس")    
                    <td>
                      
                        @if ($user->council->parent == null)
                           {{ $user->council->name }}
                        @else
                        {{ $user->council->parent->name }}[{{$user->council->name}}]
                        @endif
                    </td>
                    @else
                    <td></td>
                    @endif
                    <td>
                        <a class="btn btn-sm btn-success" href="{{ route('users.edit', $user->id) }}">تعديل</a>
                    </td>
                    <td>
                        <form  id="{{$user->id}}" class="delet-element" action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger dangerDelete"  >حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        @if($users instanceof \Illuminate\Pagination\AbstractPaginator)

        {{$users->withQueryString()->links()}}
     

        @endif

    </div>
</x-main-layout>