<div class="title">
    <div class="row">
        <div class="col-lg-2">
            <button class="back-button" onclick="window.history.back()">Volver</button>
        </div>
    </div>
</div>
<style>
    #content-form
    {
        display: block;
        background-color: rgba(255,255,255,0.70);
        width: 400px;
        height: 200px;
        padding-top: 35px;
    }
    #lote
    {
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>
<div align="center">
    <form id="content-form" class="box-shadow" action="<?php echo base_url(); ?>procesator/carga_creditos" method="post" enctype="multipart/form-data">
        <label for="lote" style="font-size: 15px; margin-bottom: 15px;">Seleccione el archivo a cargar</label>
        <input type="file" name="lote" id="lote" required>
        <input type="submit" value="Cargar Archivo" name="submit" class="btn btn-primary">
    </form>
</div>