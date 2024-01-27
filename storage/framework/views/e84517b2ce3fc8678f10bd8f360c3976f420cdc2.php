

<?php $__env->startSection('title', 'Inicio'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <p>Bienvenido al Sistema</p> <?php echo app('pragmarx.version')->format('compact'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
   <div class="float-right d-none d-sm-block">
        <b>Version</b> <?php echo app('pragmarx.version')->format('compact'); ?>       
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script> console.log('Hi!'); </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
   <div class="float-right d-none d-sm-block">
        <b>Version</b> <?php echo app('pragmarx.version')->format('compact'); ?>       
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sivig\resources\views/welcome.blade.php ENDPATH**/ ?>