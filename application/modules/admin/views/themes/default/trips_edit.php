<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                Brands
                <a  href="<?= base_url('admin/brands') ?>" class="btn btn-warning">Go back to brands listing</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Update brand
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="POST" action="<?=base_url('admin/brands/edit/'.$brand->id)?>">
                                <div class="form-group">
                                    <label>Brand Id Input</label>
                                    <input class="form-control" value="<?=$brand->id?>" placeholder="Auto generated" disabled="1">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input class="form-control" value="<?=$brand->description?>" placeholder="Enter brand description" id="description" name="description">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit Button</button>
                            </form>
                        </div>


                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
