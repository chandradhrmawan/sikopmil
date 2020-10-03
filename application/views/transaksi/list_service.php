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
                  
                    <div class="row tambah">
                      <div class="col-md-6">
                             <button class="btn btn-primary btn-flat btn-sm" type="button" onclick="add()">Tambah <span class="fa fa-plus"></span></button> 
                      </div>                
                    </div>   
                    
                </div>                
            </div>
        
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover table-checkable order-column table-sm" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Polisi</th>
                        <th>Nama Kendaraan</th>
                        <th>Tanggal Service</th>
                        <th>Total</th>
                        <th style="width: 130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    foreach ($data_service as $key => $value):
                ?>
                    <tr>
                        <td><?=$key+1?></td>
                        <td><?=$value->no_plat?></td>
                        <td><?=$value->judul?></td>
                        <td><?=view_date_hi($value->tgl_service)?></td>
                        <td>Rp.<?=($value->total)?$value->total:0?></td>
                        <td><button class="btn btn-info btn-flat btn-sm" type="button" onclick="modalDetail(<?=$value->id_hdr_service?>)">Detail <span class="fa fa-eye"></span></button>
                            <button class="btn btn-primary btn-flat btn-sm" type="button" onclick="modalCetak(<?=$value->id_hdr_service?>)">Cetak <span class="fa fa-file-o"></span></button></td>
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
        <form action="#" id="form1" class="form-horizontal">
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
                <select class="form-control" name="id_user" id="id_user">
                    <option>--</option>
                    <?php foreach ($data_supir as $key => $value): ?>
                      <option value="<?=$value->id_user?>"><?=$value->nama?></option>
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
                <form action="#" id="form2" class="form-horizontal">
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

    function modalCetak(id_hdr_service){
      let url  = "<?php echo site_url('transaksi/Service/printService/')?>"+id_hdr_service;
      window.location.href=url;
    }

    const add = () => {
      let url  = "<?php echo site_url('transaksi/Service/formAdd')?>";
      window.location.href=url;
    }

    const modalDetail = (id_hdr_service) => {
        let url  = "<?php echo site_url('transaksi/Service/detail/')?>"+id_hdr_service;
        window.location.href=url;

    }
</script>
