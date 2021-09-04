<x-main-layout :title="$title">
    <x-form-new-button label='اضافة مقطع فيديو جديد' action='videos.create' />

    @if ($videos->count() == 0)
                <div class="alert alert-danger">عذرا لا يوجد مقاطع فيديو</div>
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">الأخبار</th>
                <th scope="col"></th>
                
            </tr>
            </thead>
            <tbody>
                @foreach ($videos as $video)       
                    <tr>
                    <th scope="row">{{$loop->first? 'الأول' : ($loop->last? 'الأخير' : $loop->iteration)}}</th>
                    <td><a href="{{$video->video_url}}">{{$video->video_url}}</a></td>
                    <td>
                        <a href='{{route('videos.edit', [$video->id])}}'><button type="button" class="btn btn-primary"><i class="far fa-edit" style="margin-right:5px"></i> تعديل</button></a>
                    </td>
                    <form action="{{route('videos.destroy',[$video->id])}}" method="POST">
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