<x-main-layout :title="$title">

    @if(Session::has('success'))
    <div class="alert alert-info">{{ Session::get('success') }}</div>
    @endif
    <x-form-new-button label='اضافة خبر جديد' action='reports.create' />

    @if ($reports->count() == 0)
                <div class="alert alert-danger">عذرا لا يوجد أخبار</div>
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
                @foreach ($reports as $report)       
                    <tr>
                    <th scope="row">{{$loop->first? 'الأول' : ($loop->last? 'الأخير' : $loop->iteration)}}</th>
                    <td style="width: 80%">
                        <div class="shap">
                            <div >
                                <img style="width:200px; heigh:200px" src="{{$report->image_path}}" alt="صورة" >
                                قبل  {{$report->created_at->diffForHumans()}} 
                            </div>
                            <div>
                                <h6>{{$report->title}} </h6>
                                <p>
                                    {{$report->body}} 
                                </p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href='{{route('reports.edit', [$report->id])}}'><button type="button" class="btn btn-primary"><i class="far fa-edit" style="margin-right:5px"></i> تعديل</button></a>
                    </td>
                    <form class="delet-element" action="{{route('reports.destroy',[$report->id])}}" method="POST">
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
        {{$reports->withQueryString()->links()}}
    @endif
</x-main-layout>