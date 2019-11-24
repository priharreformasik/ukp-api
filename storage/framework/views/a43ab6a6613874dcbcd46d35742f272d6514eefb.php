<?php $__env->startSection('css'); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content-header'); ?>
    <section class="content-header">
      <h1>
        Aproval Jadwal Konsultasi
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pengaturan</a></li>
        <li class="active">Aproval Jadwal Konsultasi</li>
      </ol>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <div class="col-sm-4 col-md-2" style="margin-top: 10px;">
                      <div class="form-group">
                      <select class="form-control select2" style="width: 100%;">
                        <option selected="selected">Belum Konfirmasi</option>
                        <option>Konfirmasi</option>
                      </select>
                    </div>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="margin-right: 15px; margin-left: 15px;">
              <table id="datatable1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center" width="80px;">TANGGAL<br>KONSULTASI</th>
                            <th class="text-center">NAMA KLIEN</th>
                            <th class="text-center">LAYANAN</th>
                            <th class="text-center">RUANGAN</th>
                            <th class="text-center">SESI</th>
                            <th class="text-center">NAMA PSIKOLOG</th>
                            <th class="text-center" width="80px;">STATUS</th>
                            <th class="text-center" width="100px;">WAKTU PENDAFTARAN</th>
<!--                             <th class="text-center" width="100px;">TIME REMAINING</th>
 -->                            <th class="text-center" class="wd-10p">ACTION</th>
                        </tr>
                </thead>
                        <tbody> 
                        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                         
                            <tr>
                                <td align="center"><?php echo e($counter); ?></td>
                                <?php $counter++; ?> 
                                <td><?php echo e(\Carbon\Carbon::parse($jadwal->tanggal)->format('l, j F Y')); ?></td>
                                <td><?php echo e($jadwal->klien->user['name']); ?></td>
                                <td><?php echo e($jadwal->layanan['nama']); ?></td>
                                <td>
                                    <?php if(!$jadwal->ruangan): ?> 
                                            -
                                            <?php else: ?> 
                                            <?php echo e($jadwal->ruangan['nama']); ?> 
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(!$jadwal->sesi): ?> 
                                            -
                                            <?php else: ?> 
                                            <?php echo e($jadwal->sesi['jam']); ?> 
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(!$jadwal->psikolog): ?> 
                                            -
                                            <?php else: ?> 
                                            <?php echo e($jadwal->psikolog->user['name']); ?> 
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($jadwal->nama); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($jadwal->created_at)->format('j F Y H:i:s')); ?></td>
<!--                                 <td><?php echo e((\Carbon\Carbon::parse($jadwal->updated_at))->diff(\Carbon\Carbon::parse($jadwal->created_at))->format('%h:%I:%s')); ?></td>
 -->                                <td align="center">
                                    <div>
                                    <?php if(($jadwal->created_at)->addMinutes(0) > \Carbon\Carbon::now()): ?>
                                    <button class="btn btn-warning btn-icon waiting" style="border-radius:50%;" title="Edit">
                                        <div><i class="fa fa-pencil" style="margin:5px;"></i></div>
                                    </button>
                                    
                                    <?php else: ?>
                                        <a href="<?php echo e(url('pengaturan/aproval/'.$jadwal->id.'/edit')); ?>" class="btn btn-warning btn-icon" style="border-radius:50%;" title="Edit">
                                            <div><i class="fa fa-pencil" style="margin:5px;"></i></div>
                                        </a>
                                    <?php endif; ?>
                                   <!--  <a href="<?php echo e(url('jadwal/'.$jadwal->id.'/edit')); ?>" class="btn btn-warning" style="border-radius:50%;" title="Edit">
                                        <div><i class="fa fa-pencil" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a>
                                    <a href="#" class="btn btn-danger" style="border-radius:50%;" onclick="javascript:if(confirm('Yakin ingin hapus data?')){window.location.href='<?php echo e(url('jadwal'.$jadwal->id.'/delete')); ?>'};" title="Delete">
                                      <div><i class="fa fa-trash" style="margin:5px 2px 5px 2px;"></i></div>
                                    </a> -->
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
                scrollX: false,
                responsive: false,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                }
            });
        });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script type="text/javascript">
        $(document).on('click', '.waiting', function() {
            toastr.error('Menunggu konfirmasi psikolog!', 'Peringatan!', {timeOut: 5000});
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>