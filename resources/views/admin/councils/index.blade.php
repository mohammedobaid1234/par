<x-main-layout title="كل المجالس">
    @if(Session::has('success'))
    <div class="alert alert-danger">{{ Session::get('success') }}</div>
    @endif
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">اسم المجلس</th>
                    <th scope="col">
                        التعديل
                    </th>
                    <th scope="col">
                        الحذف
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($councils as $council)
                <tr>
                    <th scope="row">{{ $council->name }}</th>
                    <td>
                        <a class="btn btn-sm btn-success" href="{{ route('councils.edit', $council->id) }}">تعديل</a>
                    </td>
                    <td>
                        <form action="{{ route('councils.destroy', $council->id) }}" method="POST">
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