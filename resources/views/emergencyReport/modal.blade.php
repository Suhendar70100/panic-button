<input type="hidden" id="id" name="id_residential">

<div class="modal fade" id="addEmergencyReportButton" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body p-md-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2 pb-1 title">Tambah Laporan</h3>
        </div>
        <form id="addNewCCForm" class="row g-4" onsubmit="return false">
          <div class="col-12">
            <div class="form-floating form-floating-outline">
                <p class="invalid-feedback"></p>
                <select id="id_emergency_state" name="id_emergency_state" class="form-control">
                  <option value="">Pilih Keadaan Darurat</option>
                  @foreach($emergencyState as $item)
                      <option value="{{ $item->id }}">{{ $item->device->owner_device }} - {{ $item->device->residentialBlock->residential->name }} {{ $item->device->residentialBlock->name_block }} No.{{ $item->device->house_number }}</option>
                  @endforeach
              </select>
                <div class="invalid-feedback"></div>
                <label for="modalAddCard">Keadaan Darurat</label>
            </div>
          </div>
          <div class="col-12">
            <div class="form-floating form-floating-outline">
              <p class="invalid-feedback"></p>
              <textarea
              class="form-control h-px-200"
              id="description"
              name="description"
              placeholder="Deskripsi kejadian..."></textarea>
              <div class="invalid-feedback"></div>
              <label for="modalAddCard">Deskripsi</label>
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
