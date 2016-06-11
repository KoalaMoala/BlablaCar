<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    Trips
                    <a  href="<?= base_url('admin/trips/create') ?>" class="btn btn-success">Add a new</a>
                </h2>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Trips listing
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Departure</th>
                                    <th>Destination</th>
                                    <th>Date</th>
                                    <th>Remaining Seats</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($trips)): ?>
                                    <?php foreach ($trips as $key => $list): ?>
                                        <tr class="odd gradeX">
                                            <td><?=$list['departure']?></td>
                                            <td><?=$list['destination']?></td>
                                            <td><?=$list['date_departure']?></td>
                                            <td><?=$list['remaining_seats']?></td>
                                            <td>
                                              <?php if($list['owner_id'] == $user_id ){ ?>
                                                <a href="<?= base_url('admin/trips/edit/'.$list['id']) ?>" class="btn btn-info">Edit</a>
                                                <a href="<?= base_url('admin/trips/delete/'.$list['id']) ?>" class="btn btn-danger">Delete</a>
                                              <?php }elseif ($list['remaining_seats'] > 0) { ?>
                                                <a href="<?= base_url('admin/trips/reservation/'.$list['id']) ?>" class="btn btn-success">Join</a>
                                              <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="even gradeC">
                                        <td>No data</td>
                                        <td>No data</td>
                                        <td>No data</td>
                                        <td>No data</td>
                                        <td>
                                            <a href="#" class="btn btn-info">edit</a>
                                            <a href="#" class="btn btn-danger">delete</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfooter>
                                <tr>
                                  <th>Departure</th>
                                  <th>Destination</th>
                                  <th>Date</th>
                                  <th>Remaining Seats</th>
                                  <th>Action</th>
                                </tr>
                            </tfooter>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
</div>
<!-- /#page-wrapper -->
