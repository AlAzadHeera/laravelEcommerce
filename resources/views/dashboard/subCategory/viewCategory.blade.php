@extends('adlayout')

@section('title','Sub Categories')

@push('css')

@endpush

@section('adcontent')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Categories</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">All Categories</a></li>
    </ul>


    <div class="row-fluid sortable">
        @if(session('successMsg'))
            <div class="box-content alerts">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Well done!</strong> {{ session('successMsg') }}
                </div>
            </div>
        @endif
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>Categories</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($subCategories as $key=>$subCategory)
                        <tr>
                            <td class="center">{{ $key + 1 }}</td>
                            <td class="center">{{ $subCategory->menu_title }}</td>
                            <td class="center">{{ $subCategory->menu_description }}</td>
                            <td class="center">{{ $subCategory->category_title}}</td>
                            <td class="center">
                                @if($subCategory->menu_status == 1)
                                <span class="label label-success">Active</span>
                                @else
                                <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="center">
                                @if($subCategory->menu_status == 1)
                                    <a class="btn btn-danger" href="{{URL::to('inactiveSubCategory/'.$subCategory->id)}}">
                                        <i class="halflings-icon white thumbs-down"></i>
                                    </a>
                                @else
                                    <a class="btn btn-success" href="{{URL::to('activeSubCategory/'.$subCategory->id)}}">
                                        <i class="halflings-icon white thumbs-up"></i>
                                    </a>
                                @endif
                                <a class="btn btn-info" href="{{URL::to('editSubCategory/'.$subCategory->id)}}">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                {{--<a class="btn btn-danger" href="{{URL::to('deleteCategory/'.$category->id)}}" onclick="">
                                    <i class="halflings-icon white trash"></i>
                                </a>--}}
                                    <form method="post" id="delete-form-{{ $subCategory->id }}" action="{{url('deleteSubCategory',$subCategory->id)}} " style="display:none">
                                        @csrf
                                        @method('post')
                                    </form>
                                    <button class="btn btn-danger btn-sm" onclick="if (confirm('Are You Sure?')){event.preventDefault();getElementById('delete-form-{{$subCategory->id}}').submit()}else{ preventDefault(); } ">
                                        <i class="halflings-icon white trash"></i>
                                    </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->
@endsection

@push('scripts')

@endpush