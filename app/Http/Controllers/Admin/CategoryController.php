<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys =Category::latest()->get();
        return view('admin.category.index',compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $this->validate($request,[
            'name'=>'required | unique:categories',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // get from Image
        
        $image=$request->file('image');
        $slug= str::slug('$request->image,');
        if(isset($image)) 
        {
            // Make Name for Image
            $carentdate= carbon::now()->toDateString();
            $imagename=$slug.'-'.$carentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // Get Image Directory 
            if(!Storage::disk( 'public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');

            }
            // resize Image and uplode
            $category= Image::make($image)->resize(1600,589)->stream();
            Storage::disk('public')->put('category/'.$imagename,$category);



            // Image Next Derectory jodi Thaky
            if(!Storage::disk( 'public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');

            }
          // resize Image  Next Derectory jodi Thaky

            $slider= Image::make($image)->resize(500,339)->stream();
            Storage::disk('public')->put('category/slider/'.$imagename,$slider);

        }else {
            $imagename ='defult.png';
        }
        // Image insert data 

        $categorys=Category::insert([
            'name'=>$request->name,
            'slug'=>$slug,
            'image'=>$imagename,
            'created_at'=>Carbon::now()
        ]);
        Toastr::success('Massage your Success fully add', 'success',);
        return redirect()->route('admin.category.index');
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
        $categorys =Category::find($id);
        return view('admin.category.edit',compact('categorys'));
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

        $this->validate($request,[
            'name'=>'required',
            'image'=>"mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);
        // get from Image
        
        $image=$request->file('image');
        $slug= str::slug('$request->image,');
        // Old image dorat jonno 
        $oldCategoryimage= Category::find($id);

        if(isset($image)) 
        {
            // Make Name for Image
            $carentdate= carbon::now()->toDateString();
            $imagename=$slug.'-'.$carentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // Get Image Directory 
            if(!Storage::disk( 'public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');

            }

            // Delet old Imag

            if(Storage::disk('public')->exists('category/'.$oldCategoryimage->image))
            {
                Storage::disk('public')->delete('category/'.$oldCategoryimage->image);
            }

            // resize Image and uplode
            $category= Image::make($image)->resize(1600,589)->stream();
            Storage::disk('public')->put('category/'.$imagename,$category);



            // Image Next Derectory jodi Thaky jemon Slider
            if(!Storage::disk( 'public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');

            }

            // Delet old Imag Slider

            if(Storage::disk('public')->exists('category/slider/'.$oldCategoryimage->image))
            {
                Storage::disk('public')->delete('category/slider/'.$oldCategoryimage->image);
            }
          // resize Image  Next Derectory jodi Thaky

            $slider= Image::make($image)->resize(500,339)->stream();
            Storage::disk('public')->put('category/slider/'.$imagename,$slider);

        }else {
            $imagename =$oldCategoryimage->image;
        }
        // Image insert data 
        Category::where('id',$id)->update([
            'name'=>$request->name,
            'slug'=>$slug,
            'image'=>$imagename,
            'updated_at'=>Carbon::now()
        ]);
     
        Toastr::success('  Success fully Update Date', 'success',);
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        if(Storage::disk('public')->exists('category/'.$category->image))
        {
            Storage::disk('public')->delete('category/'.$category->image);
        }
        
        // slider image 
        if(Storage::disk('public')->exists('category/slider/'.$category->image))
        {
            Storage::disk('public')->delete('category/slider/'.$category->image);

        }
        $category->delete();
        Toastr::success('Massage your Deleted Success ', 'success',);
        return redirect()->back();
    }
}
