@extends('adlayout')

@section('title','')

@push('css')

@endpush

@section('adcontent')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Category</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">Add Category</a>
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add A New Category</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{url('storeProduct')}}">
                    @csrf
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="title">Product Name</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="title" name="product_name" required="">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="selectError">Category</label>
                            <div class="controls">
                                <select id="selectError" data-rel="chosen" name="category_id">
                                    @foreach($categories as $category)
                                        <option  value="{{$category->id}}">{{$category->category_title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError1">Brand</label>
                            <div class="controls">
                                <select id="selectError1" data-rel="chosen" name="brand_id">
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="control-group hidden-phone">
                            <label class="control-label" for="catDescription">Short Description</label>
                            <div class="controls">
                                <textarea class="cleditor" id="catDescription" name="short_description" rows="3" required=""></textarea>
                            </div>
                        </div>

                        <div class="control-group hidden-phone">
                            <label class="control-label" for="catDescription">Long Description</label>
                            <div class="controls">
                                <textarea class="cleditor" id="catDescription" name="long_description" rows="3" required=""></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="title">Product Color</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="title" name="product_color" required="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="title">Product Size</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="title" name="product_size" required="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="title">Product Price ($)</label>
                            <div class="controls">
                                <input type="number" class="input-xlarge" id="title" name="product_price" required="required">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="optionsCheckbox2">Publication Status</label>
                            <div class="controls">
                                <label class="checkbox">
                                    <input id="optionsCheckbox2" value="1"  type="checkbox" name="status">
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="fileInput">File input</label>
                            <div class="controls">
                                <input type="file" class="input-file uniform_on" id="fileInput" name="image">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->
@endsection

@push('scripts')

@endpush