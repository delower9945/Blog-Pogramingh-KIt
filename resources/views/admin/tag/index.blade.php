@extends('layouts.backend.admin_master')
@section('title', 'Tag ')

@push('css')

@endpush
@section('content')
        <!-- END: Top Bar -->
                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Datatable
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <a href=""></a>
                        <a href="{{ route('admin.tag.create')}}"><button class="button text-white bg-theme-1 shadow-md mr-2"> Add New Product</button></a>
                        <div class="dropdown relative ml-auto sm:ml-0">
                            <button class="dropdown-toggle button px-2 box text-gray-700">
                                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i> </span>
                            </button>
                            <div class="dropdown-box mt-10 absolute w-40 top-0 right-0 z-20">
                                <div class="dropdown-box__content box p-2">
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="file-plus" class="w-4 h-4 mr-2"></i> New Category </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="users" class="w-4 h-4 mr-2"></i> New Group </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BEGIN: Datatable -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">Tag Name</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Slug name</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Created By</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Update By</th>
                                {{-- <th class="border-b-2 text-center whitespace-no-wrap">STATUS</th> --}}
                                <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                            <tr>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ $tag->name }}</div>
                                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $tag->name }}</div>
                                </td>
                                
                                <td class="text-center border-b">{{$tag->slug}}</td>
                                <td>{{$tag->created_at == ''?'No Data show' :$tag->created_at->format('Y m d').'  -  '.$tag->created_at->diffForHumans()}}</td>
                                <td>{{$tag->updated_at == ''?'No Data show' :$tag->updated_at->format('Y m d').'  -  '.$tag->updated_at->diffForHumans()}}</td>
                                
                                {{-- <td class="w-40 border-b">
                                    <div class="flex items-center sm:justify-center text-theme-9"> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Active </div>
                                </td> --}}
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                        <a class="flex items-center mr-3" href="{{ route ('admin.tag.edit',$tag->id)}}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        {{-- <button class="flex items-center text-theme-6" onclick="{{}}">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete 
                                            
                                        </button> --}}

                                        <button class="flex items-center text-theme-6" 
                                        onclick="deletetag({{$tag->id}})">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete 
                                            
                                        </button>
                                        <form id="delet-form-{{$tag->id}}" action="{{route('admin.tag.destroy',$tag->id)}}" method="POST" >
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        
                                    </div>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- END: Datatable -->
@endsection

@push('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  {{-- swet alart --}}
  <script type="text/javascript">
    function deletetag(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
           event.preventDefault();
           document.getElementById('delet-form-'+id).submit();
        }
        })
    }
</script>

@endpush