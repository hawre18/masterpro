@extends('Admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">تعیین ویژگی های دسته بندی {{$brand->name}}</h3>
                <div class="text-left">
                    <a class="btn btn-app">
                        <i class="fa fa-plus" href="{{route('brands.create')}}"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        @include('Admin.layout.errors')
                        <form method="post" action="\admins\brands.saveSetting\{{$brand->id}}">
                            @csrf
                            <div class="form-group">
                                <label for="categories">دسته بندی ها </label>
                                <select name="categories[]" class="form-control" multiple>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if(in_array($category->id,$brand->categories->pluck('id')->toArray())) selected @endif>{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </section>
@endsection
