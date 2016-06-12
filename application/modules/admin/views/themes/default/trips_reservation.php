<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                Reservation
                <a  href="<?= base_url('admin/trips') ?>" class="btn btn-warning">Go back to trips listing</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <h2>Trip from <?= $trip->departure ?> to <?= $trip->destination ?></h2>
        <p>Date : <?= $trip->date_departure ?></p>
        <p>Remaining Seats : <?= $trip->remaining_seats ?></p>
        <p>Price : <?= $trip->price ?></p>
        <p>Preferences : <?= $trip->preferences ?></p>
      </div>
    <!-- /.col-lg-12 -->
    </div>
    <?php if($this->session->flashdata('msg')){ ?>
    <div class="row" id="flashdata">
      <div class="col-lg-12 alert alert-success">
        <?= $this->session->flashdata('msg'); ?>
      </div>
    </div>


    <script>
    setTimeout(function(){
      document.getElementById('flashdata').remove();
    }, 2000);
    Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
    }
    NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
        for(var i = this.length - 1; i >= 0; i--) {
            if(this[i] && this[i].parentElement) {
                this[i].parentElement.removeChild(this[i]);
            }
        }
    }
    </script>
    <?php } ?>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Current Reservation <?php if($seats > 0){ echo ': You have ' . $seats . ' seats.'; } ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                      <div class="col-lg-6">
                          <form role="form" method="POST" action="<?=base_url('admin/trips/reservation/') . '/' . $trip->id?>">
                              <div class="form-group">
                                  <label>Seats</label>
                                  <?php $max_seats = $trip->remaining_seats + $seats; ?>
                                  <input class="form-control" type="number" value="<?= $seats ?>" min="0"
                                  max="<?= min($max_seats, floor($this->session->all_userdata()['credit'] / $trip->price) ); ?>"
                                  id="seats" name="seats">
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
