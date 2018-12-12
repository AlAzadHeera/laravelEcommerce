@extends('adlayout')

@section('title','Slider')

@push('css')

@endpush

@section('adcontent')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="#">Brands</a>
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
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add A New Slider</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post" action="{{url('storeSlider')}}" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="title">Heading One</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="title" name="heading_one">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="title">Heading Two</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="title" name="heading_two" required="">
                            </div>
                        </div>

                        <div class="control-group hidden-phone">
                            <label class="control-label" for="catDescription">Slider Description</label>
                            <div class="controls">
                                <textarea class="cleditor" id="catDescription" name="description" rows="3" required=""></textarea>
                            </div>
                        </div>
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="catDescription">Button URL</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="catDescription" name="url" required="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="fileInput">Slider Image</label>
                            <div class="controls">
                                <input type="file" class="input-file uniform_on" id="fileInput" name="image">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="fileInput">Price Image</label>
                            <div class="controls">
                                <input type="file" class="input-file uniform_on" id="fileInput" name="price_image">
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
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Add Slider</button>
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