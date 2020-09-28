<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header">
        <!-- tools box -->
        <div class="pull-right box-tools">
          <!-- <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button> -->
         
        </div>
        <!-- /. tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body pad">
        
            <div class="row tambah">
                <div class="col-md-6">
                  
                        
                    
                </div>                
            </div>
        
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover table-checkable order-column table-sm" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Polisi</th>
                        <th>Nama Kendaraan</th>
                        <th>Nama Penyewa</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Lokasi Tujuan</th>
                        <th>Tujuan Perjalanan</th>
                        <th>Jarak Perjalanan</th>
                        <th>Status</th>
                        <th style="width: 130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    foreach ($data_pemesanan as $key => $value):
                    $btn_stat = '';
                    if($value->status_sewa == 1){
                        $status_sewa = '<span class="label label-warning">Menunggu Persetujuan Atasan</span>';
                    }elseif($value->status_sewa == 2){
                        $status_sewa = '<span class="label label-success">Sudah Disetujui Atasan</span>';
                        $btn_stat = 'disabled';
                    }elseif($value->status_sewa == 3){
                        $status_sewa = '<span class="label label-info">Dalam Proses Peminjaman</span>';
                    }elseif($value->status_sewa == 4){
                        $status_sewa = '<span class="label label-default">Peminjaman Selesai</span>';
                        $btn_stat = 'disabled';
                    }elseif($value->status_sewa == 5){
                        $status_sewa = '<span class="label label-danger">Permohonan Ditolak</span>';
                        $btn_stat = 'disabled';
                    } 

                ?>
                    <tr>
                        <td><?=$key+1?></td>
                        <td><?=$value->no_plat?></td>
                        <td><?=$value->judul?></td>
                        <td><?=$value->nama?></td>
                        <td><?=view_date_hi($value->tgl_sewa)?></td>
                        <td><?=view_date_hi($value->tgl_pinjam)?></td>
                        <td><?=view_date_hi($value->tgl_kembali)?></td>
                        <td><?=$value->lokasi_tujuan?></td>
                        <td><?=$value->tujuan_perjalanan?></td>
                        <td><?=$value->jarak?></td>
                        <td><?=$status_sewa?></td>
                        <td><button class="btn btn-info btn-flat btn-sm" type="button" onclick="modalDetail(<?=$value->id_sewa?>)">Detail <span class="fa fa-eye"></span></button>
                          <button class="btn btn-primary btn-flat btn-sm" <?=$btn_stat?> type="button" onClick="modalProses(<?=$value->id_sewa?>)">Proses <span class="fa fa-file-o"></span></button></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col-->
</div>
<!-- ./row -->

<!-- Bootstrap modal proses -->
<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width: 750px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" name="id_sewa" id="id_sewa">
          <div class="form-body">

            <div class="form-group">
              <label class="control-label col-md-2">Status Sewa</label>
              <div class="col-md-9">
                
                <select class="form-control" name="status_sewa" id="status_sewa" onchange="change_stat(this.value)">
                   <option>--</option>
                    <option value="2">Pemesanan Diterima</option>
                    <option value="5">Pemesanan Ditolak</option>
                </select>

             </div>
           </div>

            <div class="form-group" id="label_supir">
              <label class="control-label col-md-2">Supir</label>
              <div class="col-md-9">
                <select class="form-control" name="id_supir" id="id_supir">
                    <option>--</option>
                    <?php foreach ($data_supir as $key => $value): ?>
                      <option value="<?=$value->id_supir?>"><?=$value->nm_supir?></option>
                    <?php endforeach; ?>
                </select>
             </div>
           </div>

            <div class="form-group" id="label_reject">
              <label class="control-label col-md-2">Keterangan</label>
              <div class="col-md-9">
                <textarea name="ket_reject" id="ket_reject" class="form-control" cols="5" rows="5"></textarea>
             </div>
           </div>

          </div>
         </form>
       </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tutup</button>
        <button type="button" id="btnSave" onclick="proses()" class="btn btn-primary btn-flat">Kirim</button>
      </div>
    </div>
  </div>
</div>
<!--End Bootstrap modal proses -->

<!-- Bootstrap modal detail -->
        <div class="modal fade" id="modal_detail" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
              </div>
              <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                  <input type="hidden" value="" name="id_role"/> 
                  <div class="form-body">

                    <div class="form-group">
                      <label class="control-label col-md-2">Nama Kendaraan</label>
                      <div class="col-md-9">
                        <input name="judul" id="judul" class="form-control" type="text" disabled="true">
                     </div>
                   </div>

                   <div class="form-group">
                      <label class="control-label col-md-2">Deskripsi</label>
                      <div class="col-md-9">
                        <input name="deskripsi" id="deskripsi" class="form-control" type="text" disabled="true">
                     </div>
                   </div>

                    <div class="form-group">
                      <label class="control-label col-md-2">Lokasi Tujuan</label>
                      <div class="col-md-9">
                        <input name="lokasi_tujuan" id="lokasi_tujuan" class="form-control" type="text" disabled="true">
                     </div>
                   </div>

                   <div class="form-group">
                      <label class="control-label col-md-2">Jarak</label>
                      <div class="col-md-9">
                        <input name="jarak" id="jarak" class="form-control" type="text" disabled="true">
                     </div>
                   </div>

                   <div class="form-group">
                      <label class="control-label col-md-2">Tujuan Perjalanan</label>
                      <div class="col-md-9">
                        <input name="tujuan_perjalanan" id="tujuan_perjalanan" class="form-control" type="text" disabled="true">
                     </div>
                   </div>

                    <div class="form-group">
                      <label class="control-label col-md-2">Tgl Sewa</label>
                      <div class="col-md-9">
                        <input name="tgl_sewa" id="tgl_sewa" class="form-control" type="text" disabled="true">
                     </div>
                   </div>

                   <div class="form-group">
                      <label class="control-label col-md-2">Tgl Pinjam</label>
                      <div class="col-md-9">
                        <input name="tgl_pinjam" id="tgl_pinjam" class="form-control" type="text" disabled="true">
                     </div>
                   </div>

                   <div class="form-group">
                      <label class="control-label col-md-2">Tgl Kembali</label>
                      <div class="col-md-9">
                        <input name="tgl_kembali" id="tgl_kembali" class="form-control" type="text" disabled="true">
                     </div>
                   </div>

                    <div class="form-group">
                      <label class="control-label col-md-2">Keterangan</label>
                      <div class="col-md-9">
                        <input name="keterangan" id="keterangan" class="form-control" type="text" disabled="true">
                     </div>
                   </div>

                  </div>
                 </form>
               </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                <!-- <button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-flat">Kirim</button> -->
              </div>
            </div>
          </div>
        </div>
        <!--End Bootstrap modal detail-->



<script src="<?=base_url()?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>

    <script type="text/javascript">
    var save_method; //for save method string
    var table;

    $(document).ready(function() { 
      //TAMPIL DATA TABLE SERVER SIDE
      table = $('#table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": false //Feature control DataTables' server-side processing mode.
      });
    });

    function modalProses(id_sewa){
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Proses Data'); // Set Title to Bootstrap modal title
      $('#id_sewa').val(id_sewa);
      $('#label_supir').hide();
      $('#label_reject').hide();
    }

    function change_stat(stat)
    {
       if(stat == 2) {
          $('#label_supir').show();
          $('#label_reject').hide();
       }else if(stat == 5){
          $('#label_supir').hide();
          $('#label_reject').show();
       }
    }

    function reload_table()
    {
      $('#table').DataTable().ajax.reload();
    }

    function proses()
    {
      
      var url;
      url = "<?php echo site_url('transaksi/Sewa/updateStatusSewa')?>";
       // ajax adding data to database
       $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
          if(data.status==true){
            $('#modal_form').modal('hide');
            swal('Pesan','Update Data Berhasil', 'success');
            //window.location.reload();
            // reload_table();
        
          }else{
            $('#modal_form').modal('hide');
            swal('Pesan','Update Data Gagal', 'error');
            //window.location.reload();
            // reload_table();           

          }
         },
         error: function (jqXHR, textStatus, errorThrown)
         {
          alert('Error adding / update data');
         }
      });
     }

     function edit_data(id)
     {
      save_method = 'update';
      $('#type').val("edit");
      $('#form')[0].reset(); 
      $('#modal_form').modal('show');
      $('.modal-title').text('Edit Data User'); 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('master/Jabatan/ajax_get_data_by_id')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

          $('[name="id_jabatan"]').val(data.id_jabatan);
          $('[name="nm_jabatan"]').val(data.nm_jabatan);
                   
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from ajax');
          }
        });
    }

    function delete_data(id){

      swal({
        title: "Konfirmasi Hapus Data",
        text: "Apakah anda yakin, ingin menghapus Data ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Ya',
        cancelButtonText: "Tidak",
        closeOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm){
        if (isConfirm){
          $.ajax({
            url : "<?php echo site_url('master/Jabatan/delete_via_ajax')?>",
            type: "POST",
            data:{"id":id},
            dataType: "JSON",
          success: function(data)
          {
            if(data.status==true){
              swal('Pesan', 'Data berhasil dihapus', 'success');
            }else{
              swal('Pesan', 'Data Gagal dihapus', 'error');
            }
            reload_table();
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from ajax');
          }
        });
        } else {
          swal("Cancelled", "Data Batal dihapus", "error");
          return false
        }
      });
    }

    const modalDetail = (id_sewa) => {
        $('#modal_detail').modal('show');
         $('.modal-title').text('Detail Data'); // Set Title to Bootstrap modal title

        $.ajax({
        url : "<?php echo site_url('index/getDetailSewaByIdSewa')?>/" + id_sewa,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('#judul').val(data.judul)
            $('#deskripsi').val(data.deskripsi)
            $('#lokasi_tujuan').val(data.lokasi_tujuan)
            $('#tujuan_perjalanan').val(data.tujuan_perjalanan)
            $('#jarak').val(data.jarak)
            $('#tgl_sewa').val(data.tgl_sewa)
            $('#tgl_pinjam').val(data.tgl_pinjam)
            $('#tgl_kembali').val(data.tgl_kembali)
            $('#keterangan').val(data.keterangan)
                   
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from ajax');
          }
        });

    }
</script>
