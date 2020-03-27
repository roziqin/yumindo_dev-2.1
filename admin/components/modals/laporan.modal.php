
<!-------------- Modal tambah produk -------------->

<div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Detail Laporan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <table id="listlaporan" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Tanggal</th>
            <th>Nama Pelanggan</th>
            <th>Bank</th>
            <th class="text-right">jumlah</th>
          </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <div class="row">
          <div class="col-md-6"><b>Total</b></div>
          <div class="col-md-6 text-right"><b><p class="total"></p></b></div>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <a class="btn btn-default export-omset-detail" href="" target="_blank">Export</a>
        <button class="btn btn-primary" data-dismiss="modal" aria-label="Close">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-------------- End modal tambah produk -------------->



  <script type="text/javascript">
    $(document).ready(function(){


    });
  </script> 