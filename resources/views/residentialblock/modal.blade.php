<input type="hidden" id="id_resindential" name="id_resindential">

<div class="modal fade" id="addResidentialBlockButton" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body p-md-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2 pb-1 title">Tambah Blok Perumahan Baru</h3>
        </div>
        <form id="addNewCCForm" class="row g-4" onsubmit="return false">
          <div class="col-12">
              <div class="form-floating form-floating-outline">
                <input id="code_block" name="residentialCode" class="form-control credit-card-mask" type="text"
                  placeholder="Kode Blok" />
                <div class="invalid-feedback"></div>
                <label for="modalAddCard">Kode Blok</label>
              </div>
          </div>
          <div class="col-12">
              <div class="form-floating form-floating-outline">
                <p class="invalid-feedback"></p>
                <input id="name_block" name="residentialName" class="form-control credit-card-mask" type="text"
                  placeholder="Nama Blok" />
                <div class="invalid-feedback"></div>
                <label for="modalAddCard">Nama Blok</label>
              </div>
          </div>
          <div class="col-12">
            <div class="form-floating form-floating-outline">
                <p class="invalid-feedback"></p>
                <select id="resindential" name="residentialBlock" class="form-control">
                    <option value="">Pilih Perumahan</option>
                    @foreach($residentialData as $residential)
                        @if(!in_array($residential->id, $usedResidentialIds))
                            <option value="{{ $residential->id }}">{{ $residential->name }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback"></div>
                <label for="modalAddCard">Perumahan</label>
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