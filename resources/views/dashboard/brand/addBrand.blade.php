@extends('adlayout')

@section('title','')

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
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add A New Brand</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post" action="{{url('storeBrand')}}">
                    @csrf
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="title">Brand Name</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="title" name="brand_name" required="">
                            </div>
                        </div>

                        <div class="control-group hidden-phone">
                            <label class="control-label" for="catDescription">Brand Description</label>
                            <div class="controls">
                                <textarea class="cleditor" id="catDescription" name="description" rows="3" required=""></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="optionsCheckbox2">Publication Status</label>
                            <div class="controls">
                                <label class="checkbox">
                                    <input id="optionsCheckbox2" value="1"  type="checkbox" name="brand_status">
                                </label>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save changes</button>
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