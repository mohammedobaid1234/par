<x-main-layout :title="$title" >
    <x-form-new-button label='اضافة مقال جديد' action='newspapers.create' />
    @if ($newspapers->count() == 0)
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
                @foreach ($newspapers as $newspaper)       
                    <tr>
                    <th scope="row">{{$loop->first? 'الأول' : ($loop->last? 'الأخير' : $loop->iteration)}}</th>
                    <td style="width: 80%">
                        <div class="shap">
                            <div >
                                <img style="width:200px; heigh:200px" src="{{$newspaper->image_path}}" alt="صورة" >
                                قبل  {{$newspaper->created_at->diffForHumans()}} 
                            </div>
                            <div>
                                <h6>{{$newspaper->title}} </h6>
                                <p>
                                    <a href="{{$newspaper->article_url}}">{{$newspaper->article_url}} </a>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href='{{route('newspapers.edit', [$newspaper->id])}}'><button type="button" class="btn btn-primary"><i class="far fa-edit" style="margin-right:5px"></i> تعديل</button></a>
                    </td>
                    <form action="{{route('newspapers.destroy',[$newspaper->id])}}" method="POST">
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