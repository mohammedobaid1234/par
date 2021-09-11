<x-main-layout title="كل المجالس">
    <x-form-new-button label='اضافة قسم تابع لمجلس' action='sections.before' />
    

    @if(Session::has('success'))
    <div class="alert alert-info">{{ Session::get('success') }}</div>
    @endif
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">اسم المجلس</th>
                    <td></td>
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
                    <th scope="row"><a href="{{route('council.checkChildren', $council->id)}}">{{ $council->name }}</a></th>
                    {{-- @if ($council->id == 5)
                        <td><x-form-new-button label='اضافة نادي' action="users.newCreate"  /></td>
                    @elseif($council->id == 3 )   
                        <td><x-form-new-button label='اضافة  عضو' action="users.newCreate"  /></td>
                           
                    @else
                         <td><x-form-new-button label='اضافة  {{$council->type}}' action="sections.create" :id="$council->id" /></td>
                    @endif --}}
                    <td>
                        <a href="{{route('users.create', $council->id)}}" class="btn btn-primary">اضافة عضو</a>
                    </td>
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
        {{$councils->withQueryString()->links()}}

    </div>
</x-main-layout>