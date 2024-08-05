const emergencyStateUrl = `${BASE_URL}/api/emergency-state`;
const emergencyState = $('.dataTable')


const getInitData = () => {
    emergencyState.DataTable({
        processing: true,
        serverSide: true,
        ajax: emergencyStateUrl,
        columns: [
            {
                "orderable": false,
                "searchable": false,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'owner_device', name: 'owner_device' },
            { data: 'location', name: 'location' },
            { data: 'phone', name: 'phone' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status' },
        ]
    });
}

$(function () {
    getInitData()
})


const reloadDatatable = table => table.DataTable().ajax.reload(null, false);
