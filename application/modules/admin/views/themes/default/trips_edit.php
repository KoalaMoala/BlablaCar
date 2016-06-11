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
                          <form role="form" method="POST" action="<?=base_url('admin/trips/edit/') . '/' . $trip->id?>">
                              <div class="form-group">
                                  <label>Departure</label>
                                  <input class="form-control" value="<?= $trip->departure ?>" id="departure" name="departure">
                              </div>
                              <div class="form-group">
                                  <label>Destination</label>
                                  <input class="form-control" value="<?= $trip->destination ?>" id="destination" name="destination">
                              </div>
                              <div class="form-group">
                                  <label>Departure's date | YYYY/MM/DD HH:MM</label>
                                  <input class="form-control" value="<?= $trip->date_departure ?>" id="date" name="date">
                              </div>
                              <div class="form-group">
                                  <label>Car capacity</label>
                                  <input type="number" value="<?= $trip->car_capacity ?>" class="form-control" id="car_capacity" name="car_capacity" min="1">
                              </div>
                              <div class="form-group">
                                  <label>Price</label>
                                  <input type="number" value="<?= $trip->price ?>" class="form-control" id="price" name="price" min="1">
                              </div>
                              <div class="form-group">
                                  <label>Preferences</label>
                                  <input class="form-control" value="<?= $trip->preferences ?>" id="preferences" name="preferences">
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
