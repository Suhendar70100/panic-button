const histroyButtonUrl = `${BASE_URL}/api/history-button`;
let dt_filter_table = $('.dt-column-search');
let dt_filter;

$(document).ready(function() {
    if (dt_filter_table.length) {
        dt_filter = dt_filter_table.DataTable({
            processing: true,
            ajax: {
                url: histroyButtonUrl,
                type: 'GET',
                dataSrc: ''
            },
            columns: [
                { data: 'guid', name: 'guid' },
                { data: 'residential_name', name: 'residential_name' },
                { data: 'residential_block', name: 'residential_block.name_block' },
                { data: 'house_number', name: 'house_number' },
                { data: 'state', name: 'histroyButtons.state' },
                { data: 'time', name: 'histroyButtons.time' }
            ],
            initComplete: function() {
                $('.dt-column-search thead tr').clone(true).appendTo('.dt-column-search thead');
                $('.dt-column-search thead tr:eq(1) th').each(function (i) {
                    let title = $(this).text();

                    let select = $('<select class="form-control select2"><option value="">All</option></select>')
                        .appendTo($(this).empty())
                        .on('change', function () {
                            let val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            dt_filter.column(i)
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                        $('.select2').select2()

                    let uniqueOptions = getUniqueColumnOptions(i);

                    uniqueOptions.forEach(function (val) {
                        select.append('<option value="' + val + '">' + val + '</option>');
                    });
                });
            }
        });

        $('div.head-label').html('<h5 class="card-title mb-0">Daftar Jadwal Mengajar</h5>');
    }
});

function getUniqueColumnOptions(columnIndex) {
    let uniqueOptions = [];
    let columnData = dt_filter.column(columnIndex).data().toArray();

    if (columnData) {
        uniqueOptions = columnData.filter((value, index, self) => {
            return self.indexOf(value) === index;
        });
    }

    return uniqueOptions;
}

$(document).ready(function() {
    let dateInput = document.createElement('input');
    $(dateInput).addClass('form-control').attr('type', 'text').attr('id', 'daterange') .attr('placeholder', 'Pilih Rentang Tanggal').appendTo('.card-datatable .dataTables_filter');
    
    $(dateInput).daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
        let startDate = picker.startDate.format('YYYY-MM-DD');
        let endDate = picker.endDate.format('YYYY-MM-DD');

        $('#daterange').val(startDate + ' - ' + endDate);
        dt_filter.ajax.url(histroyButtonUrl + '?start_date=' + startDate + '&end_date=' + endDate).load();
    });

    $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        $('#daterange').val('');

        dt_filter.ajax.url(histroyButtonUrl).load();
    });
});
