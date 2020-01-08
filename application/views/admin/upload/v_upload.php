

<!-- page content -->
<div class="right_col" role="main">

  <div class="clearfix"></div>

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_title">
          <h2>Upload</h2>

          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <form class="form-horizontal" id="submit">
            <div class="form-group">
              <input type="text" name="judul" class="form-control" placeholder="Judul">
            </div>
            <div class="form-group">
              <input type="file" name="file">
            </div>
            <div class="form-group">
              <button class="btn btn-success" id="btn-upload" type="submit">Upload</button>
            </div>
          </form>

          

          

        </div>  
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
  $('#submit').submit(function(e){
    e.preventDefault();
    $.ajax({
      url:'<?php echo base_url().'upload/do_upload' ?>',
      type:'POST',
      data:new FormData(this),
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      success:function(data)
      {
        alert("Upload Berhasil");
      }
    });
     });
  });
</script>

<!-- /page content -->
        