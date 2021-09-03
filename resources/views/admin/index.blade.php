<x-main-layout :title="$title">
        <div class="container-fluid">
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h5 class="m-0">قسم الاخبار</h5>
                  </div>
                  <div class="card-body">
                    {{-- <h6 class="card-title">Special title treatment</h6> --}}
    
                    <p class="card-text">هنا يتم عرض واضافة الاخبار</p>
                    <a href="#" class="btn btn-primary">عرض سجل الأخبار</a>
                    
                  </div>
                </div>
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h5 class="m-0">قسم المقالات</h5>
                  </div>
                  <div class="card-body">
                    {{-- <h6 class="card-title">Special title treatment</h6> --}}
    
                    <p class="card-text">هنا يتم عرض واضافة مقال اليوم</p>
                    <a href="#" class="btn btn-primary">عرض المقالات</a>
                  </div>
                </div>
              </div>
              <!-- /.col-md-6 -->
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h5 class="m-0"> قسم الاعضاء</h5>
                  </div>
                  <div class="card-body">
                    {{-- <h6 class="card-title">Special title treatment</h6> --}}
    
                    <p class="card-text">هنا يتم عرض واضافة الأعضاء</p>
                    <a href="#" class="btn btn-primary">عرض الأعضاء</a>
                  </div>
                </div>
    
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h5 class="m-0">قسم مقاطع الفيديو</h5>
                  </div>
                  <div class="card-body">
                    {{-- <h6 class="card-title">Special title treatment</h6> --}}
    
                    <p class="card-text">هنا يتم عرض واضافة مقطع اليوم</p>
                    <a href="#" class="btn btn-primary">عرض مقاطع الفيديو</a>
                  </div>
                </div>
              </div>
              <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
</x-main-layout>