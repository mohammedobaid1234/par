<x-main-layout title="كل الأعضاء">
    @if(Session::has('success'))
    <div class="alert alert-danger">{{ Session::get('success') }}</div>
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
                    <td><img width="50" height="50" style="border-radius: 10px;" src="{{ asset('uploads/' . $user->image_url) }}" alt=""></td>
                    <th>{{ $user->full_name }}</th>
                    <td>{{ $user->birthday }}</td>
                    <td>{{ $user->marital_status }}</td>
                    <td>{{ $user->type }}</td>
                    <td>{{ $user->circle_id ?? '' }}</td>
                    <td>
                        <a class="btn btn-sm btn-success" href="{{ route('users.edit', $user->id) }}">تعديل</a>
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-main-layout>