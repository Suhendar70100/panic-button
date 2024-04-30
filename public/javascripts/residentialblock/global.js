const resindential_block = $('.dataTableBlock')
const residentialBlockUrl = `${BASE_URL}/api/residential-block`
const addButtonBlock = $('#buttonAddBlok')
const modalTitleBlock = $('.title')
const submitButtonBlock = $('#submit-block-button')


const blockFormConfig = {
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
const getInitDataBlock = () => {
    resindential_block.DataTable({
        processing: true,
        serverSide: true,
        ajax: residentialBlockUrl,
        columns: [
            {
                "orderable": false,
                "searchable": false,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'code_block', name: 'code_block'},
            {data: 'id_residential', name: 'id_residential'},
            {data: 'name_block', name: 'name_block'},
            {data: 'aksi', name: 'aksi'},
        ]
    });
}

$(function () {
    getInitDataBlock()
})

const resetFormBlock = () => blockFormConfig.fields.forEach(({id}) => $(`#${id}`).val(''))

$(function () {
    addButtonBlock.on('click', function () {
        modalTitleBlock.text('Tambah Blok Perumahan')
        submitButtonBlock.text('Tambah')
        resetFormBlock()
        $('#addResidentialBlockButton').modal('show');
    })

    $('#addResidentialBlockButton').on('hidden.bs.modal', function () {
        resetFormBlock();
        $(this).find('.invalid-feedback').text('');
    });
})

submitButtonBlock.on('click', function () {
    const id = $('#id').val()
    $(this).text().toLowerCase() === "ubah" ? updateBlock(id) : storeBlock()
})

const storeBlock = () => {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: residentialBlockUrl,
        method: 'POST',
        dataType: 'json',
        data: dataFormBlock(), 
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: res => {
            $('#addResidentialBlockButton').modal('hide');
            resetFormBlock();
            toastr.success(res.message, 'Success');
            reloadDatatableBlock(resindential_block);
        },
        error: ({responseJSON}) => {
            handleErrorBlock(responseJSON); 
        }
    });
}

const updateBlock = id => {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: `${residentialBlockUrl}/${id}`,
        method: 'PUT',
        dataType: 'json',
        data: dataFormBlock(), 
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: res => {
            $('#addResidentialBlockButton').modal('hide');
            resetFormBlock();
            toastr.success(res.message, 'Success');
            reloadDatatable(resindential_block);
        },
        error: ({responseJSON}) => {
            handleErrorBlock(responseJSON); 
        }
    })
}


const dataFormBlock = () => {
    return {
        code_block: $('#code_block').val(),
        id_residential: $('#id_residential').val(),
        name_block: $('#name_block').val(),
    };
}

const reloadDatatableBlock = table => table.DataTable().ajax.reload(null, false);

const handleErrorBlock = (responseJSON) => {
    if (responseJSON && responseJSON.errors) {
        const {errors} = responseJSON;
        blockFormConfig.fields.forEach(({id}) => {
            if (!errors.hasOwnProperty(id)) {
                $('#' + id).removeClass('is-invalid');
            } else {
                $(`#${id}`).addClass("is-invalid").next().text(errors[id][0]);
            }
        });
    }
};


$(document).on('click', '.btn-edit', function () {
    const residentialId = $(this).data('id')
    $.ajax({
        url: `${residentialBlockUrl}/${residentialId}`,
        method: 'GET',
        dataType: 'json',
        success: res => {
            $('#id').val(res.id)
            submitButtonBlock.text('Ubah')
            modalTitleBlock.text('Ubah Blok Perumahan')
            blockFormConfig.fields.forEach(({id}) => {
                $(`#${id}`).val(res?.[id]);
            })
            $('#addResidentialBlockButton').modal('show');
        },
        error: err => {
            console.log(err)
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
                url: `${residentialBlockUrl}/${id}`,
                method: 'DELETE',
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: res => {
                    toastr.success(res.message, 'Success');
                    reloadDatatable(resindential_block);
                }
            });
        }
    });
});
