<x-main-layout :title="$title">
    <x-form-new-button label="اضافة أقسام" action='sections.create' :id="$link" />

    @if ($sections->count() == 0)
                <div class="alert alert-danger">عذرا لا يوجد  أقسام</div>
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">أقسام</th>
                <th scope="col"></th>       
            </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)       
                    <tr>
                    <th scope="row">{{$loop->first? 'الأول' : ($loop->last? 'الأخير' : $loop->iteration)}}</th>
                    <td><a href="{{route('council.checkChildren', $section->id)}}">{{$section->name}}</a></td>
                    <td>
                        <a href='{{route('sections.edit', [$section->id])}}'><button type="button" class="btn btn-primary"><i class="far fa-edit" style="margin-right:5px"></i> تعديل</button></a>
                    </td>
                    <form action="{{route('sections.destroy',[$section->id])}}" method="POST">
                        @method('delete')
                        @csrf
                        <td>
                            <button type="submit" class="btn btn-dark"> <i class="far fa-trash-alt" style="margin-right:5px"></i> حذف</button>
                        </td>
                    </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-main-layout>