const deviceActivityUrl = `${BASE_URL}/api/device-activity`;
const deviceActivity = $('.dataTable')


const getInitData = () => {
    deviceActivity.DataTable({
        processing: true,
        serverSide: true,
        ajax: deviceActivityUrl,
        columns: [
            {
                "orderable": false,
                "searchable": false,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'code_device', name: 'code_device' },
            { data: 'owner_device', name: 'owner_device' },
            { data: 'location', name: 'location' },
            { data: 'created_at', name: 'created_at' },
            { data: 'button_condition', name: 'button_condition' },
        ]
    });
}

$(function () {
    getInitData()
})


const reloadDatatable = table => table.DataTable().ajax.reload(null, false);
