<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                Trips
                <a  href="<?= base_url('admin/trips') ?>" class="btn btn-warning">Go back to trips listing</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create new trip
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="POST" action="<?=base_url('admin/trips/create')?>">
                                <div class="form-group">
                                    <label>Departure</label>
                                    <input class="form-control" placeholder="Departure" id="departure" name="departure">
                                </div>
                                <div class="form-group">
                                    <label>Destination</label>
                                    <input class="form-control" placeholder="Destination" id="destination" name="destination">
                                </div>
                                <div class="form-group">
                                    <label>Departure's date | DD/MM/YYYY HH:MM</label>
                                    <input class="form-control" placeholder="DD/MM/YYYY HH:MM" id="date" name="date">
                                </div>
                                <div class="form-group">
                                    <label>Car capacity</label>
                                    <input type="number" class="form-control" id="car_capacity" name="car_capacity" min="1">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control" id="price" name="price" min="1">
                                </div>
                                <div class="form-group">
                                    <label>Preferences</label>
                                    <input class="form-control" placeholder="No smoking allowed, no pets allowed.." id="preferences" name="preferences">
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
