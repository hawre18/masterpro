<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::with('photo')->paginate(10);
        return view('Admin.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:brands|min:3|max:255',
            'description' => 'required',
            'photo_id' => 'required',
        ]);
        try{
            $brand=new Brand();
            $brand->title=$request->input('title');
            $brand->description=$request->input('description');
            $brand->photo_id=$request->input('photo_id');
            $brand->save();
            Session::flash('brand_success','برند با موفقیت ثبت شد');
            return redirect('/brands');
        }
        catch (\Exception $m){
            Session::flash('brand_error','خطایی در ثبت به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/brands');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand=Brand::with('photo')->whereId($id)->first();
        return view('Admin.brands.show',compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand=Brand::with('photo')->whereId($id)->first();
        return view('Admin.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:brands,title,' . $id .'|min:3|max:255',
            'description' => 'required',
            'photo_id' => 'required',
        ]);
        try{
            $brand=Brand::findorfail($id);
            $brand->title=$request->input('title');
            $brand->description=$request->input('description');
            $brand->photo_id=$request->input('photo_id');
            $brand->save();
            Session::flash('brand_success','برند با موفقیت ویرایش شد');
            return redirect('/brands');
        }
        catch (\Exception $m){
            Session::flash('brand_error','خطایی در ویرایش به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/brands');
        }
    }
    public function delete($id)
    {
        try{
            $brand=Brand::findorfail($id);
            $brand->delete();
            Session::flash('brands_success','برند با موفقیت حذف شد');
            return redirect('/brands');}
        catch (\Exception $m) {
            Session::flash('brand_error', 'خطایی در حذف به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/brands');
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function indexSetting($id){
        $brand=Brand::findorfail($id);
        $categories=Category::all();
        return view('Admin.brands.index-settings',compact(['brand','categories']));
    }
    public function saveSetting(Request $request,$id){
        try{
            $brand=Brand::findorfail($id);
            $brand->categories()->sync($request->categories);
            $brand->save();
            Session::flash('brand_success','عملیات با موفقیت انجام شد');
            return redirect()->to('/brands');}
        catch (\Exception $m){
            Session::flash('brand_error','خطایی در ثبت به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/brands');
        }
    }
}
