const residential_block = $('.dataTable')
const residentialUrl = `${BASE_URL}/api/residential-block`
const addButton = $('#buttonAdd')
const modalTitle = $('.title')
const submitButton = $('#submit-button')


const formConfig = {
    fields: [
        {
            id: 'code_block',
            name: 'Kode Blok'
        },
        {
            id: 'id_residential',
            name: 'Nama Blok'
        },
        {
            id: 'name_block',
            name: 'Perumahan'
        },

    ]
}


const getInitData = () => {
    residential_block.DataTable({
        processing: true,
        serverSide: true,
        ajax: residentialUrl,
        columns: [
            {
                "orderable": false,
                "searchable": false,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'code_block', name: 'code_block'},
            {data: 'name_block', name: 'name_block'},
            {data: 'perumahan', name: 'perumahan'},
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
        modalTitle.text('Tambah Blok Perumahan')
        submitButton.text('Tambah')
        resetForm()
        $('#addResidentialBlockButton').modal('show');
    })

    $('#addResidentialBlockButton').on('hidden.bs.modal', function () {
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
        url: residentialUrl,
        method: 'POST',
        dataType: 'json',
        data: dataForm(),
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: res => {
            $('#addResidentialBlockButton').modal('hide');
            resetForm();
            toastr.success(res.message, 'Success');
            reloadDatatable(residential_block);
        },
        error: ({responseJSON}) => {
            toastr.error('Kode blok sudah digunakan', 'Error');
        }
    });
}

const update = id => {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const formData = dataForm();

    $.ajax({
        url: `${residentialUrl}/${id}`,
        method: 'PUT',
        dataType: 'json',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: res => {
            $('#addResidentialBlockButton').modal('hide');
            resetForm();
            toastr.success(res.message, 'Success');
            reloadDatatable(residential_block);
        },
        error: ({responseJSON, status}) => {
            console.error('Error updating residential block:', responseJSON, status);
            toastr.error('Kode blok sudah digunakan.', 'Error');
        }
    });
}

const dataForm = () => {
    return {
        code_block: $('#code_block').val(),
        id_residential: $('#residential').val(),
        name_block: $('#name_block').val(),
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
    const residentialId = $(this).data('id');
    $.ajax({
        url: `${residentialUrl}/${residentialId}`,
        method: 'GET',
        dataType: 'json',
        success: res => {
            $('#id').val(res.id);
            submitButton.text('Ubah');
            modalTitle.text('Ubah Blok Perumahan');

            $.each(res, function(key, value) {
                $(`#${key}`).val(value);
            });

            $('#residential').val(res.id_residential);

            $('#addResidentialBlockButton').modal('show');
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
                url: `${residentialUrl}/${id}`,
                method: 'DELETE',
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: res => {
                    toastr.success(res.message, 'Success');
                    reloadDatatable(residential_block);
                }
            });
        }
    });
});
