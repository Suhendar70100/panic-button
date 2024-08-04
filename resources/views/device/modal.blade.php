<input type="hidden" id="id">

<div class="modal fade" id="addDeviceButton" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body p-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2 pb-1 title">Tambah Perangkat</h3>
                </div>
                <form id="addNewCCForm" class="row g-4" onsubmit="return false">
                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <input id="code_device" name="code_device" class="form-control credit-card-mask" type="text"
                                placeholder="code_device" maxlength="20" />
                            <div class="invalid-feedback"></div>
                            <label for="modalAddCard">Kode Perangkat</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <p class="invalid-feedback"></p>
                            <input id="owner_device" name="owner_device" class="form-control credit-card-mask"
                                type="text" placeholder="Nama Pemilik" />
                            <div class="invalid-feedback"></div>
                            <label for="modalAddCard">Nama Pemilik</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <p class="invalid-feedback"></p>
                            <select id="id_residential_block" name="id_residential_block" class="form-control">
                                <option value="">Pilih Blok</option>
                                @foreach ($residentialBlockData as $residentialBlock)
                                    <option value="{{ $residentialBlock->id }}">{{ $residentialBlock->name_block }} - {{ $residentialBlock->residential->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                            <label for="modalAddCard">Nama Blok</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <p class="invalid-feedback"></p>
                            <input id="house_number" name="house_number" class="form-control credit-card-mask"
                                type="text" placeholder="Nomor Rumah" />
                            <div class="invalid-feedback"></div>
                            <label for="modalAddCard">Nomor Rumah</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <p class="invalid-feedback"></p>
                            <input id="phone" name="phone" class="form-control credit-card-mask"
                                type="text" placeholder="Nomor HP" />
                            <div class="invalid-feedback"></div>
                            <label for="modalAddCard">Nomor HP</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <p class="invalid-feedback"></p>
                            <select id="access" class="form-control">
                                <option value="">Pilih Akses</option>
                                <option value="0">Batasi</option>
                                <option value="1">Bebaskan</option>
                            </select>
                            <div class="invalid-feedback"></div>
                            <label for="modalAddCard">Akses</label>
                        </div>
                    </div>
                    {{-- <div class="col-12">
            <div class="form-floating form-floating-outline">
                <p class="invalid-feedback"></p>
                <select id="residential" name="residentialBlock" class="form-control">
                  <option value="">Pilih Perumahan</option>
                  @foreach ($residentialData as $residentialBlock)
                      <option value="{{ $residentialBlock->id }}">{{ $residentialBlock->name }}</option>
                  @endforeach
              </select>
                <div class="invalid-feedback"></div>
                <label for="modalAddCard">Perumahan</label>
            </div>
          </div> --}}
                    <div class="col-12 text-center">
                        <button type="submit" id="submit-button" class="btn btn-danger me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary btn-reset" data-bs-dismiss="modal"
                            aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
