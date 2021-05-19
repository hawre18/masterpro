@extends('Admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('/admin/dist/css/dropzone.css')}}">
@endsection
@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">ایجاد اسلاید صفحه اصلی فروشگاه</h3>
                </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('Admin.layout.errors')
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form method="post" action="\slides">
                            @csrf
                            <div class="form-group">
                                <label for="title">عنوان اسلاید</label>
                                <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="عنوان اسلاید">
                            </div>
                            <div class="form-group">
                                <label >توضیحات اصلی</label>
                                <textarea  id="longDescription" name="description" class="form-control" >{{old('description')}}</textarea>
                            </div>
                            <div>
                                <label >وضعیت نشر</label>
                                <div>
                                    <input type="radio" name="status" value="deactive" ><span>منتشر نشده</span>
                                    <input type="radio" name="status" value="active" ><span>منتشر شده</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="photo">گالری تصاویر</label>
                                <input type="hidden" name="photo_id[]" id="slide-photo">
                                <div id="photo" class="dropzone" ></div>
                                <div class="=row">
                                </div>
                            </div>

                            <button type="submit" onclick="sliderGallery()" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </section>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('/admin/plugins/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin/dist/js/dropzone.js')}}"></script>
    <script>
        Dropzone.autoDiscover=false;
        var slidesGallery=[]
        var drop=new Dropzone('#photo',{
            addRemoveLinks:true,
            url:"{{route('photos.upload')}}",
            sending:function (file,xhr,formData) {
                formData.append("_token","{{csrf_token()}}")
            },
            success: function (file,response) {
                slidesGallery.push(response.photo_id)
            }
        });
        sliderGallery=function () {
            document.getElementById('slide-photo').value = slidesGallery
        }
        CKEDITOR.replace('longDescription',{
            customConfig:'config.js',
            toolbar:'simple',
            language:'fa',
            removePlugins:'cloudservices, easyimage'
        })
    </script>
@endsection
