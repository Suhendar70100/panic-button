<input type="hidden" id="id">

<div class="modal fade" id="addResidentialButton" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body p-md-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2 pb-1 title">Tambah Perumahan Baru</h3>
          <p>Add new card to complete payment</p>
        </div>
        <form id="addNewCCForm" class="row g-4" onsubmit="return false">
          <div class="col-12">
              <div class="form-floating form-floating-outline">
                <input id="name" name="residentialName" class="form-control credit-card-mask" type="text"
                  placeholder="Nama Perumahan" />
                <div class="invalid-feedback"></div>
                <label for="modalAddCard">Nama Perumahan</label>
              </div>
          </div>
          <div class="col-12">
              <div class="form-floating form-floating-outline">
                <p class="invalid-feedback"></p>
                <input id="address" name="residentialAddres" class="form-control credit-card-mask" type="text"
                  placeholder="Alamat Perumahan" />
                <div class="invalid-feedback"></div>
                <label for="modalAddCard">Alamat Perumahan</label>
              </div>
          </div>
          <div class="col-12 text-center">
            <button type="submit" id="submit-button" class="btn btn-danger me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-outline-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>