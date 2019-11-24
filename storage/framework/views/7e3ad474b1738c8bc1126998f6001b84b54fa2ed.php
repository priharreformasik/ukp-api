<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <section class="content-header">
      <h1>
        Edit Data Klien
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo e(url('#')); ?>">User</a></li>
        <li><a href="<?php echo e(url('user/klien')); ?>">Daftar Klien</a></li>
        <li class="active">Edit Data Klien</li>
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
      <div class="box box-default">
        <div class="box-header" style="padding-right: 50px; padding-top: 20px">
          <div style="float:right; ">
              <a href="<?php echo e(url('ganti_password/'.$data->id.'/klien')); ?>" type="button" class="btn btn-block btn-warning"><i class="fa fa-pencil"></i> Ganti Password</a>
          </div>
        </div>
        <!-- /.box-header -->
        <?php echo Form::open(array('url'=>'user/klien/'.$data->id.'/edit', 'method'=>'POST','enctype'=>'multipart/form-data')); ?>

          <div class="box-body" style="padding-left: 70px; padding-right: 30px;">
            <div class="col-md-2 pl-5 pr-5">
              <?php if(!$data->foto): ?>
                  <img class="img-detail" src="<?php echo e(asset('images/user.png')); ?>" class="img-responsive" style="width: 150px;">
              <?php else: ?>
                  <img class="img-detail" src="<?php echo e(url('images/'.$data->foto)); ?>" class="img-responsive" style="width: 150px;">
              <?php endif; ?>
              <div align="center" style="margin-top: 10px;">
                <a href="<?php echo e(url('user/klien/'.$data->id.'/edit_foto')); ?>"><i class="fa fa-pencil"></i> Ganti Foto</a>
              </div>
            </div>
            <div class="col-md-10 pl-5 pr-5" style="padding-left: 80px; ">
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Nama</p>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="name" placeholder="" value="<?php echo e(old('name') ? old('name') : $data->name); ?>">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>NIK</p>
                  </div>
                  <div class="col-md-10">
                    <input type="number" class="form-control" name="nik" placeholder="" value="<?php echo e(old('nik') ? old('nik') : $data->nik); ?>">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Jenis Kelamin</p>
                  </div>
                  <div class="col-md-10">
                    <input class="col-md-1" name="jenis_kelamin" type="radio" value="Laki-laki" <?php echo e(($data->jenis_kelamin=="Laki-laki")? "checked" : ""); ?>> Laki-laki<br>
                    <input class="col-md-1" name="jenis_kelamin" type="radio" value="Perempuan" type="radio" <?php echo e(($data->jenis_kelamin=="Perempuan")? "checked" : ""); ?>> Perempuan
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Tanggal Lahir</p>
                  </div>
                      <div class="col-md-10">
                          <div class="input-group">
                              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input name="tanggal_lahir" type="text" class="form-control fc-datepicker datepicker" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="<?php echo e(old('tanggal_lahir') ? old('tanggal_lahir') : \Carbon\Carbon::parse($data->tanggal_lahir)->format('Y-m-d')); ?>">
                          </div>
                      </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Anak ke</p>
                  </div>
                  <div class="col-md-2">
                    <input type="number" class="form-control" name="anak_ke" placeholder="" value="<?php echo e(old('anak_ke') ? old('anak_ke') : $data->klien->anak_ke); ?>"> 
                  </div>
                  <div class="col-md-1">
                      <p>dari</p>
                  </div>
                  <div class="col-md-2">
                    <input type="number" class="form-control" name="jumlah_saudara" placeholder="" value="<?php echo e(old('jumlah_saudara') ? old('jumlah_saudara') : $data->klien->jumlah_saudara); ?>">
                  </div>
                  <div class="col-md-1">
                      <p>bersaudara</p>
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Pendidikan Terakhir</p>
                  </div>
                  <div class="col-md-10">
                    <div class="col-md-3">
                      <input class="col-md-1" name="pendidikan_terakhir" type="radio" value="SD" <?php echo e(($data->klien->pendidikan_terakhir=="SD")? "checked" : ""); ?>> SD<br>
                      <input class="col-md-1" name="pendidikan_terakhir" type="radio" value="SMP" <?php echo e(($data->klien->pendidikan_terakhir=="SMP")? "checked" : ""); ?>> SMP<br>
                    </div>
                    <div class="col-md-3">
                      <input class="col-md-1" name="pendidikan_terakhir" type="radio" value="SMA" <?php echo e(($data->klien->pendidikan_terakhir=="SMA")? "checked" : ""); ?>> SMA<br>
                      <input class="col-md-1" name="pendidikan_terakhir" type="radio" value="D3" <?php echo e(($data->klien->pendidikan_terakhir=="D3")? "checked" : ""); ?>> D3<br>
                    </div>
                    <div class="col-md-3">
                      <input class="col-md-1" name="pendidikan_terakhir" type="radio" value="S1" <?php echo e(($data->klien->pendidikan_terakhir=="S2")? "checked" : ""); ?>> S1<br>
                      <input class="col-md-1" name="pendidikan_terakhir" type="radio" value="S2" <?php echo e(($data->klien->pendidikan_terakhir=="S3")? "checked" : ""); ?>> S2<br>
                    </div>
                    <div class="col-md-3">
                      <input class="col-md-1" name="pendidikan_terakhir" type="radio" value="S3" <?php echo e(($data->klien->pendidikan_terakhir=="S2")? "checked" : ""); ?>> S3
                  </div>
                </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Alamat</p>
                  </div>
                  <div class="col-md-10">
                    <textarea class="form-control" name="alamat" placeholder=""><?php echo e(old('alamat') ? old('alamat') : $data->alamat); ?></textarea>
                  </div>
              </div>                 
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Nomor Telepon</p>
                  </div>
                  <div class="col-md-10">
                    <input type="number" class="form-control" name="no_telepon" placeholder="" value="<?php echo e(old('no_telepon') ? old('no_telepon') : $data->no_telepon); ?>">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Email</p>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="email" placeholder="" value="<?php echo e(old('email') ? old('email') : $data->email); ?>">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px;">
                  <div class="col-md-2">
                      <p>Username</p>
                  </div>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="username" placeholder="" value="<?php echo e(old('username') ? old('username') : $data->username); ?>">
                  </div>
              </div>
              <div class="row pl-5 pr-5" style="margin-top: 5px; padding-bottom:10px;">
                  <div class="col-md-2">
                        <p>Kategori Klien</p>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control select2" name="kategori_id">
                          <?php if(! $data->klien['kategori_id']): ?> 
                            <option value="">Pilih kategori klien</option>
                            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>" <?php echo e(collect(old('kategori'))->contains($value->id) ? 'selected':''); ?>><?php echo e($value->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php else: ?>
                            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>" <?php echo e(collect(old('kategori'))->contains($value->id) ? 'selected':''); ?> <?php if($value->id == $data->klien['kategori_id']): ?> selected='selected' <?php endif; ?>><?php echo e($value->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
                        </select>
                    </div>
              </div>                   
          </div>
          <div class="row mt-3">
                <div class="col-lg" style="text-align: center ; padding-bottom:10px;">
                  <button type="button" class="btn btn-danger" onclick="location.href='<?php echo e(url('user/klien')); ?>'">Kembali</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
          </div>
        </div>
        <?php echo Form::close(); ?>

      </div>
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

 <script>
      $(function () {
        //Date picker
        $('.datepicker').datepicker({
          autoclose: true,
          endDate: "dd",
        //   startDate: "dd",
          todayHighlight: true
        })
      })
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>