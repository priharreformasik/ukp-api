<?php $__env->startSection('css'); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content-header'); ?>
    <section class="content-header">
      <h1>
        Jadwal Konsultasi
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jadwal Konsultasi</li>
      </ol>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="col-sm-4 col-md-2" style="margin-top: 10px; ">
              <a href="<?php echo e(url('jadwal/tambah')); ?>" type="button" class="btn btn-block btn-primary"><i class="fa fa-plus mg-r-10"></i> Tambah Jadwal</a>
              </div>
              <div class="col-sm-4 col-md-4" style="margin-top: 10px; float:right; ">
              <?php echo Form::open(array('url'=>'jadwal','method'=>'GET', 'class'=>'form-horizontal')); ?>


              <div class="pull-right" style="margin-top: 10px; margin-left: 5px; float:right;">
                <button class="btn btn-success" type="submit">Go!</button>
              </div>
              <div class="pull-right" style="margin-top: 10px; float:right; ">
                <select class="form-control" name="status" style="width: 100%;float: right;">
                  <option value="all"> Filter</option>
                  <option value="Terjadwal">Terjadwal</option>
                  <option value="Selesai">Selesai</option>
                  <option value="Dibatalkan">Dibatalkan</option>
                </select>
              </div>
              <?php echo Form::close(); ?>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="margin-right: 15px; margin-left: 15px;">
              <table id="datatable1" class="table display responsive nowrap table-bordered">
                <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">TANGGAL</th>
                            <th class="text-center">JAM</th>
                            <th class="text-center">NAMA KLIEN</th>
                            <th class="text-center">RUANGAN</th>
                            <th class="text-center">NAMA PSIKOLOG</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center" class="wd-10p">ACTION</th>
                        </tr>
                </thead>
                        <tbody> 
                        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                         
                            <tr>
                                <td align="center"><?php echo e($counter); ?></td>
                                <?php $counter++; ?>   
                                <td><?php echo e(\Carbon\Carbon::parse($jadwal->tanggal)->format('l, j F Y')); ?></td>
                                <td><?php echo e($jadwal->sesi['jam']); ?></td>
                                <td><?php echo e($jadwal->klien->user['name']); ?></td>
                                <td><?php echo e($jadwal->ruangan['nama']); ?></td>
                                <td>
                                  <?php if(!$jadwal->psikolog): ?> 
                                    -
                                  <?php else: ?> 
                                    <?php echo e($jadwal->psikolog->user['name']); ?> 
                                  <?php endif; ?>
                                </td>
                                <td><?php echo e($jadwal->nama); ?></td>
                                <td align="center">
                                    <div>
                                    <a href="<?php echo e(url('jadwal/'.$jadwal->id.'/detail')); ?>" class="btn btn-info btn-icon" style="border-radius:50%;" title="Detail">
                                        <div><i class="fa fa-info" style="margin:5px;"></i></div>
                                    </a>
                                    <a href="<?php echo e(url('jadwal/'.$jadwal->id.'/edit')); ?>" class="btn btn-warning" style="border-radius:50%;" title="Edit">
                                        <div><i class="fa fa-pencil" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a>
                                    <a href="<?php echo e(url('jadwal/'.$jadwal->id.'/delete')); ?>" class="btn btn-danger btn-sm"
                                       data-tr="tr_<?php echo e($jadwal->id); ?>"
                                       data-toggle="confirmation"
                                       data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                                       data-btn-ok-class="btn btn-sm btn-danger"
                                       data-btn-cancel-label="Cancel"
                                       data-btn-cancel-icon="fa fa-chevron-circle-left"
                                       data-btn-cancel-class="btn btn-sm btn-default pull-right"
                                       data-title="Are you sure you want to delete ?"
                                       data-placement="left" data-singleton="true"
                                       style="border-radius:50%;" >
                                       <div><i class="fa fa-trash" style="margin:6px 4px 6px 4px;"></i></div>
                                    </a>
                                    </div>
                                </td>
                            </tr> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                           
                        </tbody>
                    </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?><!-- DataTables -->
    <script src="<?php echo e(asset('bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>

    <script>
         $(function(){
            'use strict';

            $('#datatable1').DataTable({
//                scrollX: true,
                responsive: false,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                }
            });
        });


    </script>
    <script>
      $("#myModal").modal("show");
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>