<x-main-layout :title="$title" >
    <x-form-new-button label='اضافة مقال جديد' action='articles.create' />
    @if ($articles->count() == 0)
                <div class="alert alert-danger">عذرا لا يوجد مقالات</div>
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">مقال</th>
                <th scope="col"></th>
                
            </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)       
                    <tr>
                    <th scope="row">{{$loop->first? 'الأول' : ($loop->last? 'الأخير' : $loop->iteration)}}</th>
                    <td><a href="{{$article->article_url}}">{{$article->article_url}}</a></td>
                    <td>
                        <a href='{{route('articles.edit', [$article->id])}}'><button type="button" class="btn btn-primary"><i class="far fa-edit" style="margin-right:5px"></i> تعديل</button></a>
                    </td>
                    <form action="{{route('articles.destroy',[$article->id])}}" method="POST">
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