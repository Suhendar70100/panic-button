const emergency_report = $('.dataTable')
const emergencyReportUrl = `${BASE_URL}/api/emergency-report`
const addButton = $('#buttonAdd')
const modalTitle = $('.title')
const submitButton = $('#submit-button')


const formConfig = {
    fields: [
        {
            id: 'id_emergency_state',
            name: 'Keadaan Darurat'
        },
        {
            id: 'description',
            name: 'Deskripsi'
        },

    ]
}


const getInitData = () => {
    emergency_report.DataTable({
        processing: true,
        serverSide: true,
        ajax: emergencyReportUrl,
        columns: [
            {
                "orderable": false,
                "searchable": false,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'owner_device', name: 'owner_device'},
            {data: 'location', name: 'location'},
            {data: 'description', name: 'description'},
            {data: 'created_at', name: 'created_at'},
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
        modalTitle.text('Tambah Laporan')
        submitButton.text('Tambah')
        resetForm()
        $('#addEmergencyReportButton').modal('show');
    })

    $('#addEmergencyReportButton').on('hidden.bs.modal', function () {
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
        url: emergencyReportUrl,
        method: 'POST',
        dataType: 'json',
        data: dataForm(),
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: res => {
            $('#addEmergencyReportButton').modal('hide');
            resetForm();
            toastr.success(res.message, 'Success');
            reloadDatatable(emergency_report);
        },
        error: ({responseJSON}) => {
            console.error('Error storing Laporan:', responseJSON);
        }
    });
}

const update = id => {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const formData = dataForm();

    $.ajax({
        url: `${emergencyReportUrl}/${id}`,
        method: 'PUT',
        dataType: 'json',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: res => {
            $('#addEmergencyReportButton').modal('hide');
            resetForm();
            toastr.success(res.message, 'Success');
            reloadDatatable(emergency_report);
        },
        error: ({responseJSON, status}) => {
            console.error('Error updating Laporan:', responseJSON, status);
        }
    });
}

const dataForm = () => {
    return {
        id_emergency_state: $('#id_emergency_state').val(),
        description: $('#description').val(),
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
    const emergencyReportId = $(this).data('id');
    $.ajax({
        url: `${emergencyReportUrl}/${emergencyReportId}`,
        method: 'GET',
        dataType: 'json',
        success: res => {
            $('#id').val(res.id);
            submitButton.text('Ubah');
            modalTitle.text('Ubah Laporan');

            $.each(res, function(key, value) {
                $(`#${key}`).val(value);
            });

            $('#addEmergencyReportButton').modal('show');
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
                url: `${emergencyReportUrl}/${id}`,
                method: 'DELETE',
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: res => {
                    toastr.success(res.message, 'Success');
                    reloadDatatable(emergency_report);
                }
            });
        }
    });
});
