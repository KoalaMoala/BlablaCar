<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                Products
                <a  href="<?= base_url('admin/products') ?>" class="btn btn-warning">Go back to products listing</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create new product
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="POST" action="<?=base_url('admin/products/create')?>">
                                <div class="form-group">
                                    <label>Product Id Input</label>
                                    <input class="form-control" placeholder="Auto generated" disabled="1">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" placeholder="Enter product name" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input class="form-control" placeholder="Enter product name" id="price" name="price">
                                </div>
                                <div class="form-group">
                                    <label>Model</label>
                                    <input class="form-control" placeholder="Enter product mode" id="model" name="model">
                                </div>
                                <div class="form-group">
                                    <label>Brand</label>
                                    <select class="form-control" id="brand_id" name="brand_id">
                                        <?php if (count($brands)): ?>
                                            <?php foreach ($brands as $key => $brand): ?>
                                                <option value="<?= $brand['id'] ?>"><?= $brand['description'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <?php if (count($categories)): ?>
                                            <?php foreach ($categories as $key => $category): ?>
                                                <option value="<?= $category['id'] ?>"><?= $category['description'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tag Line</label>
                                    <input class="form-control" placeholder="Enter product description" id="tag_line" name="tag_line">
                                </div>
                                <div class="form-group">
                                    <label>Features</label>
                                    <textarea class="form-control" rows="3" id="features" name="features"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Button</button>
                                <button type="reset" class="btn btn-default">Reset Button</button>
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
