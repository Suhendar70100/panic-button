const device = $('.dataTable')
const deviceUrl = `${BASE_URL}/api/device`
const addButton = $('#buttonAdd')
const modalTitle = $('.title')
const submitButton = $('#submit-button')


const formConfig = {
    fields: [
        {
            id: 'guid',
            name: 'Guid'
        },
        {
            id: 'name_residential',
            name: 'Nama Perumahan'
        },
        {
            id: 'code_block_residential',
            name: 'Nama Blok'
        },
        {
            id: 'house_number',
            name: 'Nama Perumahan'
        },
        {
            id: 'status',
            name: 'Status'
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
            // {
            //     "orderable": false,
            //     "searchable": false,
            //     "render": function (data, type, row, meta) {
            //         return meta.row + meta.settings._iDisplayStart + 1;
            //     }
            // },
            {data: 'guid', name: 'guid'},
            {data: 'name_residential', name: 'name_residential'},
            {data: 'code_block_residential', name: 'code_block_residential'},
            {data: 'house_number', name: 'house_number'},
            {data: 'status', name: 'status'},
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
        modalTitle.text('Tambah Perangkat Perumahan')
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
        guid: $('#guid').val(),
        code_block_residential: $('#code_block_residential').val(),
        house_number: $('#house_number').val(),
        status: $('#status').val(),
        access: $('#access').val(),
    });

    return {
        guid: $('#guid').val(),
        code_block_residential: $('#code_block_residential').val(),
        house_number: $('#house_number').val(),
        status: $('#status').val(),
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
            modalTitle.text('Ubah Blok Perumahan');

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
    $('#status').on('change', function() {
        var selectedValue = $(this).val();
        $('#status').val(selectedValue);
        console.log('Nilai yang dipilih:', selectedValue);
    });
});

$(document).ready(function() {
    $('#access').on('change', function() {
        var selectedValue = $(this).val();
        $('#access').val(selectedValue);
        console.log('Nilai yang dipilih:', selectedValue);
    });
});
