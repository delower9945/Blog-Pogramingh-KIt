@extends('layouts.backend.admin_master')

@section('title', 'Add New Category')
    
@push('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}
@endpush
@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Category Edit 
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
       <form action="{{route('admin.category.update',$categorys->id)}}" method="post" enctype="multipart/form-data">
           @csrf
           @method('PUT')
           <div class="intro-y box p-5">
            <div>
                <label>Category Name</label>
                <input type="text" class="input w-full border mt-2" placeholder="Input text" name="name" value="{{$categorys->name}}">
            </div>
            <div>
                <label>Category Image</label>
                <input type="file" class="input w-full border mt-2" placeholder="Input file" name="image"  >
            </div>
        
            <div class="text-right mt-5">
                <a href="{{route('admin.category.index')}}" class="button w-24 border text-gray-700 mr-1">Back</a>
                <button type="submit" class="button w-24 bg-theme-1 text-white">Save</button>
            </div>
 
        </div>
       </form>
        <!-- END: Form Layout -->
    </div>
</div>
@endsection

@push('js')

        
    
@endpush