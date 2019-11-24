<?php $__env->startSection('css'); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content-header'); ?>
    <section class="content-header">
      <h1>
        Daftar Asesmen
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data</a></li>
        <li class="active">Daftar Asesmen</li>
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
              <a href="<?php echo e(url('data/asesmen/tambah')); ?>" type="button" class="btn btn-block btn-primary"><i class="fa fa-plus mg-r-10"></i> Tambah Asesmen</a>
              </div>
              <!-- <div class="col-sm-4 col-md-2" style="margin-top: 10px; float:right; ">
              <a href="layanan_list.html" type="button" class="btn btn-block btn-primary"><i class="fa fa-download mg-r-10"></i> Download PDF</a>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="margin-right: 15px; margin-left: 15px;">
              <table id="datatable1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th class="text-center" width="10px;">NO</th>
                            <th class="text-center">ASESMEN</th>
                            <th class="text-center">LAYANAN</th>
                            <th class="text-center" width="300px;">DESKRIPSI</th>
                            <th class="text-center">HARGA</th>
                            <th class="text-center" class="wd-10p">ACTION</th>
                        </tr>
                        </thead>
                        <tbody> 
                        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $asesmen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                         
                            <tr>
                                <td align="center"><?php echo e($value+1); ?></td>
                                <td><?php echo e($asesmen->nama); ?></td>
                                <td><?php echo e($asesmen->layanan['nama']); ?></td>
                                <td><?php echo e($asesmen->deskripsi); ?></td>
                                <td>Rp <?php echo e(number_format($asesmen->harga,0,".",".")); ?></td>
                                <td align="center">
                                    <div>
                                    <a href="<?php echo e(url('data/asesmen/'.$asesmen->id.'/edit')); ?>" class="btn btn-warning" style="border-radius:50%;" title="Edit">
                                        <div><i class="fa fa-pencil" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a>
                                    <a href="<?php echo e(url('data/asesmen/'.$asesmen->id.'/delete')); ?>" class="btn btn-danger btn-sm"
                                       data-tr="tr_<?php echo e($asesmen->id); ?>"
                                       data-toggle="confirmation"
                                       data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                                       data-btn-ok-class="btn btn-sm btn-danger"
                                       data-btn-cancel-label="Cancel"
                                       data-btn-cancel-icon="fa fa-chevron-circle-left"
                                       data-btn-cancel-class="btn btn-sm btn-default pull-right"
                                       data-title="Are you sure you want to delete ?"
                                       data-placement="left" data-singleton="true"
                                       style="border-radius:50%;">
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

<?php $__env->startSection('javascript'); ?>
<!-- DataTables -->
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>