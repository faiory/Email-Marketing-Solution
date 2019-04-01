@extends('layouts.mainTemplate') 
@section('contentHeader') Clients
@endsection
 
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">View</a></li>
                <li><a href="#tab_2" data-toggle="tab">Add</a></li>
                <li><a href="#tab_3" data-toggle="tab">Modify</a></li>
                <li><a href="#tab_4" data-toggle="tab">Import/Export</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <b>How to use:</b>

                    <p>Exactly like the original bootstrap tabs except you should use the custom wrapper <code>.nav-tabs-custom</code>                        to achieve this style.</p>
                    A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole
                    heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls
                    like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                    that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and
                    yet I feel that I never was a greater artist than now.
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Input Addon</h3>
                        </div>
                        <div class="box-body">
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" placeholder="Username">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>US phone mask:</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
                            <br />

                            <div class="input-group">
                                <input type="text" class="form-control">
                                <span class="input-group-addon">.00</span>
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control">
                                <span class="input-group-addon">.00</span>
                            </div>

                            <h4>With icons</h4>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <br>

                            <div class="input-group">
                                <input type="text" class="form-control">
                                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                <input type="text" class="form-control">
                                <span class="input-group-addon"><i class="fa fa-ambulance"></i></span>
                            </div>

                            <h4>With checkbox and radio inputs</h4>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                              <input type="checkbox">
                            </span>
                                        <input type="text" class="form-control">
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                              <input type="radio">
                            </span>
                                        <input type="text" class="form-control">
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>
                            <!-- /.row -->

                            <h4>With buttons</h4>

                            <p class="margin">Large: <code>.input-group.input-group-lg</code></p>

                            <div class="input-group input-group-lg">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Action
                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                <!-- /btn-group -->
                                <input type="text" class="form-control">
                            </div>
                            <!-- /input-group -->
                            <p class="margin">Normal</p>

                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-danger">Action</button>
                                </div>
                                <!-- /btn-group -->
                                <input type="text" class="form-control">
                            </div>
                            <!-- /input-group -->
                            <p class="margin">Small <code>.input-group.input-group-sm</code></p>

                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control">
                                <span class="input-group-btn">
                          <button type="button" class="btn btn-info btn-flat">Go!</button>
                        </span>
                            </div>
                            <!-- /input-group -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                    text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                    specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                    remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                    containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker
                    including versions of Lorem Ipsum.
                </div>
                <div class="tab-pane" id="tab_4">
                    <div class="form-group">
                        <label for="exampleInputFile">CSV</label>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">Upload the file here accepted format is CSV</p>
                    </div>
                    
                    <!-- /input-group -->
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>



@stop