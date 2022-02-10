<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-4" data-bs-toggle="modal" data-bs-target="#modalOrder">
    Tambah Data Baru
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="modalOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id">
            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer</label>
                <select class="form-select" name="customer_id" id="customer_id">
                </select>
            </div>
            <div class="mb-3">
                <label for="product_id" class="form-label">Product</label>
                <select class="form-select" name="product_id" id="product_id">
                </select>
            </div>
            <div class="mb-3">
                <span class="form-label" id="qty">Kuantitas</span>
                <input type="number" name="qty" class="form-control" placeholder="enter your qty" aria-label="qty" aria-describedby="qty">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="simpan">Save</button>
        </div>
      </div>
    </div>
  </div>
  <script src="{{url('/assets/pages/modalorder.js')}}"></script>