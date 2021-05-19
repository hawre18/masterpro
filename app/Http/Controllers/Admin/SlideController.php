<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides=Slide::with('photos')->paginate(5);
        return view('Admin.slides.index',compact(['slides']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.slides.create');
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
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3',
            'status' => 'required',
        ]);

        try{
            $slide=new Slide();
            $slide->title=$request->title;
            $slide->status=$request->status;
            $slide->description=$request->description;
            $slide->save();
            $photos=explode(',',$request->input('photo_id')[0]);
            $slide->photos()->sync($photos);
            Session::flash('slide_success','اسلاید با موفقیت ثبت شد');
            return redirect('/slides');
        }
        catch (\Exception $m){
            Session::flash('slide_error','خطایی در ثبت اسلاید به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/slides');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide=Slide::with(['photos'])->whereId($id)->first();
        return view('Admin.slides.edit',compact(['slide']));
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
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3',
            'status' => 'required',
        ]);

        try{
            $slide=Slide::findorfail($id);
            $slide->title=$request->title;
            $slide->status=$request->status;
            $slide->description=$request->description;
            $slide->save();
            $photos=explode(',',$request->input('photo_id')[0]);
            $slide->photos()->sync($photos);
            Session::flash('slide_success','اسلاید با موفقیت ویرایش شد');
            return redirect('/slides');
        }
        catch (\Exception $m){
            Session::flash('slide_error','خطایی در ویرایش اسلاید به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/slides');
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
    public function delete($id)
    {
        try{
            $slide=Slide::findorfail($id);
            $slide->delete();
            Session::flash('slide_success','اسلاید با موفقیت حذف شد');
            return redirect('/slides');
        }
        catch (\Exception $m){
            Session::flash('slide_error','خطایی در حذف اسلاید به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/slides');
        }
    }

    public function publish($id,$status)
    {
        try{
            if($status=='active') {
                DB::table('slides')
                    ->where('id', $id)
                    ->update(array('status' => 'active'));
                Session::flash('one_status', 'اسلاید با موفقیت منتشر شد');
                return redirect('/slides');
            }elseif ($status=='deactive') {
                DB::table('slides')
                    ->where('id', $id)
                    ->update(array('status' => 'deactive'));
                Session::flash('zero_status', 'اسلاید با موفقیت منقضی شد');
                return redirect('/slides');
            }
        }
        catch (\Exception $m){
            Session::flash('status_error','خطایی در انجام عملیات روی  اسلاید به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/slides');
        }
    }
}
