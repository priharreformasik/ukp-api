<?php $__env->startSection('css'); ?>
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/morris.js/morris.css')); ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/jvectormap/jquery-jvectormap.css')); ?>">
  <!-- <link href="<?php echo e(asset('lib/select2/css/select2.min.css')); ?>" rel="stylesheet"> -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <h1>
        Rekap Konsultasi Layanan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Rekap Konsultasi</a></li>
        <li class="active">Rekap Konsultasi Layanan</li>
      </ol>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content">

  <?php echo Form::open(array('url'=>'statistik/layanan_report','method'=>'GET', 'files'=>'true', 'class'=>'form-horizontal')); ?>

    <div class="box-body">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-success">
            <div class="box-header with-border">
              <div class="row pl-5 pr-5" style="margin-top: 5px;margin-bottom: 20px;" align="center">
                  <h4>REKAP KONSULTASI BERDASARKAN JENIS LAYANAN</h4>
              </div>
              <div class="row pl-5 pr-5" style="margin-right: 200px; margin-left: 200px; margin-top:15px;">
                  <div class="col-md-4">
                      <p>Layanan</p>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" name="layanan">
                        <option value="">Pilih Layanan</option>
                        <?php $__currentLoopData = $layanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>" <?php echo e(collect(old('layanan'))->contains($value->id) ? 'selected':''); ?>><?php echo e($value->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
              </div>
              <div class="row pl-5 pr-5"  style="margin-right: 200px; margin-left: 200px; margin-top:5px;">
                  <div class="col-md-4">
                      <p>Dari</p>
                  </div>
                      <div class="col-md-8">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input name="from" type="text" class="form-control fc-datepicker" id="datepicker"  placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="<?php echo e(old('from')); ?>" required="">
                          </div>
                      </div>
              </div>
              <div class="row pl-5 pr-5"  style="margin-right: 200px; margin-left: 200px; margin-top:5px;">
                  <div class="col-md-4">
                      <p>Sampai</p>
                  </div>
                      <div class="col-md-8">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input name="until" type="text" class="form-control fc-datepicker" id="datepicker"  placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="<?php echo e(old('until')); ?>" required="">
                          </div>
                      </div>
              </div>
              <div class="row mt-3"  style="margin-top: 20px;">
                <div class="col-lg" style="text-align: center">
                  <button type="submit" class="btn btn-success" >Submit</button>
                </div>
            </div>
            </div>
           <?php echo Form::close(); ?>

            <!-- /.box-body -->
          </div>

          <!-- /.nav-tabs-custom -->
        </section>

        <?php echo Form::open(array('url'=>'statistik/report_all_layanan','method'=>'POST', 'files'=>'true', 'class'=>'form-horizontal')); ?>

    <div class="box-body">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-success">
            <div class="box-header with-border">
              <div class="row pl-5 pr-5" style="margin-top: 5px;margin-bottom: 20px;" align="center">
                  <h4>REKAP KONSULTASI LAYANAN</h4>
              </div>
              <div class="row pl-5 pr-5"  style="margin-right: 250px; margin-left: 250px; margin-top:5px;">
                  <div class="col-md-4">
                      <p>Dari Tanggal</p>
                  </div>
                      <div class="col-md-8">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input name="from" type="text" class="form-control fc-datepicker" id="datepicker"  placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="<?php echo e(old('from')); ?>" required="">
                          </div>
                      </div>
              </div>
              <div class="row pl-5 pr-5"  style="margin-right: 250px; margin-left: 250px; margin-top:5px;">
                  <div class="col-md-4">
                      <p>Sampai Tanggal</p>
                  </div>
                      <div class="col-md-8">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input name="until" type="text" class="form-control fc-datepicker" id="datepicker"  placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="<?php echo e(old('until')); ?>" required="">
                          </div>
                      </div>
              </div>
              <div class="row mt-3"  style="margin-top:20px;">
                <div class="col-lg" style="text-align: center">
                  <button type="submit" class="btn btn-success" >Submit</button>
                </div>
            </div>
            </div>
           <?php echo Form::close(); ?>


      </div>
      <!-- /.row (main row) -->
    </div>

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<!-- Morris.js charts -->
<script src="<?php echo e(asset('bower_components/raphael/raphael.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/morris.js/morris.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')); ?>"></script>
<!-- jvectormap -->
<script src="<?php echo e(asset('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(asset('bower_components/jquery-knob/dist/jquery.knob.min.js')); ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo e(asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
<!-- FastClick -->
<script src="<?php echo e(asset('bower_components/fastclick/lib/fastclick.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('bower_components/admin-lte/dist/js/adminlte.min.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('bower_components/admin-lte/dist/js/pages/dashboard.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('bower_components/admin-lte/dist/js/demo.js')); ?>"></script>
<script>
$(function () {
    "use strict";
// 
// Datepicker
            $('.fc-datepicker').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                dateFormat: 'yy-mm-dd'
            });
  });

  // $('.select2').select2();
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>