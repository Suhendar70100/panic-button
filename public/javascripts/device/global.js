const device = $('.dataTable')
const deviceUrl = `${BASE_URL}/api/device`
const addButton = $('#buttonAdd')
const modalTitle = $('.title')
const submitButton = $('#submit-button')


const formConfig = {
    fields: [
        {
            id: 'code_device',
            name: 'Kode Perangkat'
        },
        {
            id: 'owner_device',
            name: 'Nama Pemilik'
        },
        {
            id: 'id_residential_block',
            name: 'Nama Blok'
        },
        {
            id: 'house_number',
            name: 'Nomor Rumah'
        },
        {
            id: 'phone',
            name: 'Nomor HP'
        },
        {
            id: 'access',
            name: 'Access'
        },
    ]
}

const getInitData = () => {
    device.DataTable({
        processing: true,
        serverSide: true,
        ajax: deviceUrl,
        columns: [
            {
                "orderable": false,
                "searchable": false,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'code_device', name: 'code_device'},
            {data: 'owner_device', name: 'owner_device'},
            {data: 'name_residential', name: 'name_residential'},
            {data: 'name_residential_block', name: 'name_residential_block'},
            {data: 'house_number', name: 'house_number'},
            {data: 'phone', name: 'phone'},
            {data: 'access', name: 'access'},
            {data: 'aksi', name: 'aksi'},
        ]
    });
}

$(function () {
    getInitData()
})

const resetForm = () => formConfig.fields.forEach(({id}) => $(`#${id}`).val(''))

$(function () {
    addButton.on('click', function () {
        modalTitle.text('Tambah Perangkat')
        submitButton.text('Tambah')
        resetForm()
        $('#addDeviceButton').modal('show');
    })

    $('#addDeviceButton').on('hidden.bs.modal', function () {
        resetForm();
        $(this).find('.invalid-feedback').text('');
    });
})

submitButton.on('click', function () {
    const id = $('#id').val()
    $(this).text().toLowerCase() === "ubah" ? update(id) : store()
})
const store = () => {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: deviceUrl,
        method: 'POST',
        dataType: 'json',
        data: dataForm(),
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: res => {
            $('#addDeviceButton').modal('hide');
            resetForm();
            toastr.success(res.message, 'Success');
            reloadDatatable(device);
        },
        error: ({responseJSON}) => {
            handleError(responseJSON);
        }
    });
}

const update = id => {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const formData = dataForm();

    $.ajax({
        url: `${deviceUrl}/${id}`,
        method: 'PUT',
        dataType: 'json',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: res => {
            $('#addDeviceButton').modal('hide');
            resetForm();
            toastr.success(res.message, 'Success');
            reloadDatatable(device);
        },
        error: ({responseJSON, status}) => {
            handleError(responseJSON);
        }
    });
}

const dataForm = () => {
    console.log({
        code_device: $('#code_device').val(),
        id_residential_block: $('#id_residential_block').val(),
        owner_device: $('#owner_device').val(),
        phone: $('#phone').val(),
        house_number: $('#house_number').val(),
        access: $('#access').val(),
    });

    return {
        code_device: $('#code_device').val(),
        id_residential_block: $('#id_residential_block').val(),
        owner_device: $('#owner_device').val(),
        phone: $('#phone').val(),
        house_number: $('#house_number').val(),
        access: $('#access').val(),
    };

}

const reloadDatatable = table => table.DataTable().ajax.reload(null, false);

const handleError = (responseJSON) => {
    const {errors} = responseJSON


    formConfig.fields.forEach(({id}) => {
        if (!errors.hasOwnProperty(id)) {
            $('#' + id).removeClass('is-invalid')
        } else {
            $(`#${id}`).addClass("is-invalid").next().text(errors[id][0]);
        }
    })
}

$(document).on('click', '.btn-edit', function () {
    const deviceId = $(this).data('id');
    $.ajax({
        url: `${deviceUrl}/${deviceId}`,
        method: 'GET',
        dataType: 'json',
        success: res => {
            $('#id').val(res.id);
            submitButton.text('Ubah');
            modalTitle.text('Ubah Perangkat');

            $.each(res, function(key, value) {
                $(`#${key}`).val(value);
            });

            $('#device').val(res.id_device);

            $('#addDeviceButton').modal('show');
        },
        error: err => {
            console.log(err);
        }
    })
})

$(document).on('click', '.btn-delete', function () {
    const id = $(this).data('id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: 'Anda Yakin?',
        text: "Data yang dihapus tidak bisa dikembalikan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak',
        customClass: {
            confirmButton: 'btn btn-danger me-3 waves-effect waves-light',
            cancelButton: 'btn btn-label-secondary waves-effect'
        },
        buttonsStyling: false
    }).then(result => {
        if (result.value) {
            $.ajax({
                url: `${deviceUrl}/${id}`,
                method: 'DELETE',
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: res => {
                    toastr.success(res.message, 'Success');
                    reloadDatatable(device);
                }
            });
        }
    });
});


$(document).ready(function() {
    $('#access').on('change', function() {
        var selectedValue = $(this).val();
        $('#access').val(selectedValue);
        console.log('Nilai yang dipilih:', selectedValue);
    });
});
