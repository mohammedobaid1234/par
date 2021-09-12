<x-main-layout :title="$title" >
    @if(Session::has('success'))
    <div class="alert alert-info">{{ Session::get('success') }}</div>
    @endif
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
                    <td style="width: 80%">
                        <div class="shap">
                            <div >
                                <img style="width:200px; heigh:200px" src="{{$article->image_path}}" alt="صورة" >
                                قبل  {{$article->created_at->diffForHumans()}} 
                            </div>
                            <div>
                                <h6>{{$article->title}} </h6>
                                <p>
                                    <a href="http://{{$article->article_url}}">{{$article->article_url}} </a>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href='{{route('articles.edit', [$article->id])}}'><button type="button" class="btn btn-primary"><i class="far fa-edit" style="margin-right:5px"></i> تعديل</button></a>
                    </td>
                    <form class="delet-element" action="{{route('articles.destroy',[$article->id])}}" method="POST">
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
        {{$articles->withQueryString()->links()}}

    @endif
</x-main-layout>