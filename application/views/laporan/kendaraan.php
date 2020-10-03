<form name="form" id="form" enctype="multipart/form-data" method="post">
<div class="row">
  <div class="col-md-12">
    <div class="box box-info" id="box-input">
      <div class="box-body pad">
            <div class="form-group">
              <label>Jenis</label>
              <select name="id_jenis" id="id_jenis" class="form-control">
                <option value="">--</option>
                <?php foreach ($data_jenis as $key => $value): ?>
                  <option value="<?=$value->id_jenis?>"><?=$value->nm_jenis?></option>
                <?php endforeach ?>
              </select>
            </div>

            <div class="form-group">
              <label>Merk</label>
              <select name="id_merk" id="id_merk" class="form-control">
                <option value="">--</option>
                <?php foreach ($data_merk as $key => $value): ?>
                  <option value="<?=$value->id_merk?>"><?=$value->nm_merk?></option>
                <?php endforeach ?>
              </select>
            </div>

            <div class="form-group">
              <label>Modal</label>
              <select name="model" id="model" class="form-control">
                <option value="">--</option>
                <?php foreach ($data_model as $key => $value): ?>
                  <option value="<?=$value->model?>"><?=$value->model?></option>
                <?php endforeach ?>
              </select>
            </div>

            <div class="form-group">
              <button type="button" class="btn btn-primary btn-flat" style="margin-right: 5px;" onclick="printPrev()">
          <i class="fa fa-search"></i> Show Data
        </button>
            </div>
      </div>
    </div>

    <div class="box">
      <div id="table-show"></div>
    </div>
  </div>
    
  </div>


</form>
<script src="<?=base_url()?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">

 const doPrint = () => {
    $('#box-input').hide();
    $('#btn-print').hide();
    window.print();
    $('#box-input').show();
    $('#btn-print').show();
  }

  const printPrev = () => {
    let id_jenis = $('#id_jenis').val()
    let id_merk  = $('#id_merk').val()
    let model    = $('#model').val()

    $.ajax({
        url : "<?php echo site_url('laporan/Kendaraan/listData')?>?id_jenis="+id_jenis+"&id_merk="+id_merk+"&model="+model,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

          $('#table-show').html(data)
          /*$('#judul').val(data.judul)
          $('#lokasi_tujuan').val(data.lokasi_tujuan)
          $('#tujuan_perjalanan').val(data.tujuan_perjalanan)
          $('#jarak').val(data.jarak)
          $('#tgl_sewa').val(data.tgl_sewa)
          $('#tgl_pinjam').val(data.tgl_pinjam)
          $('#tgl_kembali').val(data.tgl_kembali)
          $('#keterangan').val(data.keterangan)
          $('#km_awal').val(data.km_akhir+' Km')
          $('#id_sewa').val(id_sewa)
          $('#id_supir').val(data.id_supir)*/
                
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error get data from ajax');
        }
      });
  }

  const doCancel = () => {
    var url = "<?php echo site_url('transaksi/Service/index')?>"
    window.location.href = url
  }

</script>



