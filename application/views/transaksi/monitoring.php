<!-- <style type="text/css">
#lat, #lon { text-align:right }
#map { width:100%;height: 500px; }
.address { cursor:pointer }
.address:hover { color:#AA0000;text-decoration:underline }
</style> -->

<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-body pad">

      <div class="col-sm-12">
        <div class="form-group">
           <div id="container-map"></div>
        </div>
      </div>

      </div>
    </div>
  </div>

   
    
    
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
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
              <label class="control-label col-md-2">Lokasi</label>
              <div class="col-md-9">
                <textarea name="lokasi" id="lokasi" class="form-control" cols="5" rows=5 disabled></textarea>
             </div>
           </div>

          </div>
         </form>
       </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!--End Bootstrap modal -->




<script src="<?=base_url()?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">

const markerOnClick = (e) =>{
  $('#form')[0].reset(); // reset form on modals
  $('#modal_form').modal('show'); // show bootstrap modal
  $('.modal-title').text('Tambah Data User'); // Set Title to Bootstrap modal title
  $.ajax({
    url: 'https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='+ e.latlng.lat +'&lon='+e.latlng.lng,
    method: 'GET',
    success: function(response) {
      let full = (response.display_name+"\n"+response.address.state_district);
      $('#lokasi').val(full);
    },
    error: function (jqXHR, textStatus, errorThrown){
      alert('Error adding / update data');
    }
  });
}


const loadMap = () => {
   $.ajax({
    url: '<?=base_url()?>transaksi/Monitoring/loadMap',
    method: 'GET',
    success: function(response) {
      $('#container-map').html(response);
    },
    error: function (jqXHR, textStatus, errorThrown){
      alert('Error adding / update data');
    }
  });
}

loadMap();
setInterval(()=>{ 
 loadMap();
}, 10000);



</script>