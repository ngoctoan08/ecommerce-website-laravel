$(document).ready(function () {
    $('.list-menu').DataTable({
        order: [[1, 'asc']],
    });

    $('.list-category').DataTable({
        order: [[1, 'asc']],
    });

    $('.list-product').DataTable({
        order: [[0, 'asc']],
    });

    $('.list-ieProduct').DataTable({
        order: [[7, 'asc']],
    });

    
    
    $('.list_bill').DataTable({
        order: [[1, 'asc']],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                autoFilter: true,
                title: 'Danh sách hóa đơn',
                messageTop: 'Danh sách hóa đơn'
            },
            {
                extend: 'pdfHtml5',
                autoFilter: true,
                title: 'Danh sách hóa đơn',
                messageTop: 'Danh sách hóa đơn'
            },
            {
                extend: 'print',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            '<img src="./images/icon/icon-shortcut-logo.png" style="position:absolute; top:0; left:0;" />'
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            }
        ]
    });
});
