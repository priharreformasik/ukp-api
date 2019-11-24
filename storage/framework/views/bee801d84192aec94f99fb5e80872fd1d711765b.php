<?php $__env->startSection('content-header'); ?>
    <section class="content-header">
      <h1>
        Tambah Asesmen
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data</a></li>
        <li><a href="<?php echo e(url('data/asesmen')); ?>">Daftar Asesmen</a></li>
        <li class="active">Tambah Asesmen</li>
      </ol>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="content">
      <?php if(count($errors)>0): ?>
          <div class="alert alert-danger">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li>
                <?php echo e($error); ?>

              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
      <?php endif; ?>
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default" style="padding-top: 30px; ">
        <!-- /.box-header -->
        <?php echo Form::open(array('url'=>'data/asesmen/simpan','method'=>'POST', 'files'=>'true','class'=>'form-horizontal')); ?>

          <div class="box-body" style="padding-left: 100px; padding-right: 100px;">
            <div class="col-md-12 pl-5 pr-5">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Asesmen</p>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="nama" placeholder="Asesmen" value="<?php echo e(old('nama')); ?>">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Deskripsi</p>
                  </div>
                  <div class="col-md-8">
                    <textarea class="form-control" name="deskripsi" placeholder="Deskripsi"><?php echo e(old('deskripsi')); ?></textarea>
                  </div> 
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-4">
                      <p>Harga</p>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" name="harga" placeholder="Harga" value="<?php echo e(old('harga')); ?>">
                  </div>
              </div>   
              <div class="row pl-5 pr-5" style="margin-top: 5px; margin-bottom: 10px;">
                  <div class="col-md-4">
                      <p>Layanan</p>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control select2" name="layanan_id">
                        <option value="">Pilih layanan</option>
                        <?php $__currentLoopData = $layanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>" <?php echo e(collect(old('layanan'))->contains($value->id) ? 'selected':''); ?>><?php echo e($value->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
              </div>                                         
          </div>
          <div class="row mt-3" style="">
                <div class="col-lg" style="text-align: center ; padding-bottom:10px;">
                  <button type="button" class="btn btn-danger" onclick="location.href='<?php echo e(url('data/asesmen')); ?>'">Kembali</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
          </div>
        </div>
        <?php echo Form::close(); ?>

      </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
  $(function () {
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
  })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>