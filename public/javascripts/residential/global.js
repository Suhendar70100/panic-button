const residential = $('.dataTable')
const residentialUrl = `${BASE_URL}/api/residential`


const getInitData = () => {
    residential.DataTable({
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
            {data: 'name', name: 'name'},
            {data: 'address', name: 'address'},
            {data: 'aksi', name: 'aksi'},
        ]
    });
}

$(function () {
    getInitData()
})
