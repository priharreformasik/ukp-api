<?php $__env->startSection('css'); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content-header'); ?>
    <section class="content-header">
      <h1>
        Daftar Pesan
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo e(url('/pengaturan/pesan')); ?>">Pengaturan</a></li>
        <li class="active">Daftar Pesan</li>
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
              <a href="<?php echo e(url('pengaturan/pesan/tambah')); ?>" type="button" class="btn btn-block btn-primary"><i class="fa fa-plus mg-r-10"></i> Tulis Pesan</a>
              </div>
            </div>
          
            <div class="box-body" style="margin-right: 15px; margin-left: 15px;">
              <table id="datatable1" class="table display table-bordered">
                <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center" width="150px;">TANGGAL</th>
                            <th class="text-center">SUBJECT</th>
                            <th class="text-center">PENERIMA</th>
                            <th class="text-center" width="200px;">PESAN</th>
                            <th class="text-center" class="wd-10p">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>                          
                            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $pesan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                         
                            <tr>
                                <td align="center"><?php echo e($value+1); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($pesan->updated_at)->format('l, j F Y h:m:s')); ?></td>
                                <td><?php echo e($pesan->subject); ?></td>
                                <td>
                                  <?php $__currentLoopData = $pesan->user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($value->name."-".$value->level); ?></li>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td><?php echo e($pesan->pesan); ?></td>
                                <td align="center">
                                    <div>
                                    <!-- <a href="<?php echo e(url('pesan/'.$pesan->id.'/detail')); ?>" class="btn btn-info btn-icon" style="border-radius:50%;" title="Detail">
                                        <div><i class="fa fa-info" style="margin:5px;"></i></div>
                                    </a> -->
                                    <!-- <a href="<?php echo e(url('pesan/'.$pesan->id.'/edit')); ?>" class="btn btn-warning" style="border-radius:50%;" title="Edit">
                                        <div><i class="fa fa-pencil" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a> -->
                                    <!-- <a href="#" class="btn btn-danger" style="border-radius:50%;" onclick="javascript:if(confirm('Yakin ingin hapus data?')){window.location.href='<?php echo e(url('pesan'.$pesan->id.'/delete')); ?>'};" title="Delete">
                                      <div><i class="fa fa-trash" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a> -->
                                    <a href="<?php echo e(url('pengaturan/pesan/'.$pesan->id.'/delete')); ?>" class="btn btn-danger btn-sm"
                                       data-tr="tr_<?php echo e($pesan->id); ?>"
                                       data-toggle="confirmation"
                                       data-btn-ok-label="Hapus" data-btn-ok-icon="fa fa-remove"
                                       data-btn-ok-class="btn btn-sm btn-danger"
                                       data-btn-cancel-label="Kembali"
                                       data-btn-cancel-icon="fa fa-chevron-circle-left"
                                       data-btn-cancel-class="btn btn-sm btn-default pull-right"
                                       data-title="Apakah Anda yakin ingin menghapus ?"
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