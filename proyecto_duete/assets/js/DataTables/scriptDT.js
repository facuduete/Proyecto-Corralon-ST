//script para agregar funcionalidades a la tabla de productos.
let table = new DataTable('#lista-productos', {
    "destroy": true,
    "ordering": false,
    "pageLength": 10,
    "lengthMenu": [5, 10, 25, 50],
    "searching": false,
    "language": {
        "lengthMenu": "Mostrar _MENU_ productos por página",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "No hay datos disponibles en la tabla",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrado de _MAX_ productos totales)",
        "loadingRecords": "Cargando...",
        "paginate": {
            "first": '<i class="bi bi-chevron-double-left"></i>',
            "last": '<i class="bi bi-chevron-double-right"></i>',
            "next": '<i class="py-0 bi bi-chevron-right"></i>',
            "previous": '<i class="py-0 bi bi-chevron-left"></i>'
        }
    }      
}
);

let table2 = new DataTable('#tabla-usuarios', {
    "destroy": true,
    "ordering": false,
    "pageLength": 10,
    "lengthMenu": [5, 10, 25, 50],
    "searching": false,
    "language": {
        "lengthMenu": "Mostrar _MENU_ usuarios por página",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "No hay datos disponibles en la tabla",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrado de _MAX_ usuarios totales)",
        "loadingRecords": "Cargando...",
        "paginate": {
            "first": '<i class="bi bi-chevron-double-left"></i>',
            "last": '<i class="bi bi-chevron-double-right"></i>',
            "next": '<i class="py-0 bi bi-chevron-right"></i>',
            "previous": '<i class="py-0 bi bi-chevron-left"></i>'
        }
    }
});

let table3 = new DataTable('#tabla-consultas', {
    "destroy": true,
    "ordering": false,
    "pageLength": 10,
    "lengthMenu": [5, 10, 25, 50],
    "searching": false,
    "language": {
        "lengthMenu": "Mostrar _MENU_ consultas por página",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "No hay datos disponibles en la tabla",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrado de _MAX_ consultas totales)",
        "loadingRecords": "Cargando...",
        "paginate": {
            "first": '<i class="bi bi-chevron-double-left"></i>',
            "last": '<i class="bi bi-chevron-double-right"></i>',
            "next": '<i class="py-0 bi bi-chevron-right"></i>',
            "previous": '<i class="py-0 bi bi-chevron-left"></i>'
        }
    }
});

let table4 = new DataTable('#tabla-usuarios-promociones', {
    "destroy": true,
    "ordering": false,
    "pageLength": 10,
    "lengthMenu": [5, 10, 25, 50],
    "searching": false,
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros por página",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "No hay datos disponibles en la tabla",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrado de _MAX_ registros totales)",
        "loadingRecords": "Cargando...",
        "paginate": {
            "first": '<i class="bi bi-chevron-double-left"></i>',
            "last": '<i class="bi bi-chevron-double-right"></i>',
            "next": '<i class="py-0 bi bi-chevron-right"></i>',
            "previous": '<i class="py-0 bi bi-chevron-left"></i>'
        }
    }
});

let table5 = new DataTable('#tabla-ventas', {
    "destroy": true,
    "ordering": false,
    "pageLength": 10,
    "lengthMenu": [5, 10, 25, 50],
    "searching": false,
    "language": {
        "lengthMenu": "Mostrar _MENU_ ventas por página",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "No hay datos disponibles en la tabla",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrado de _MAX_ registros totales)",
        "loadingRecords": "Cargando...",
        "paginate": {
            "first": '<i class="bi bi-chevron-double-left"></i>',
            "last": '<i class="bi bi-chevron-double-right"></i>',
            "next": '<i class="py-0 bi bi-chevron-right"></i>',
            "previous": '<i class="py-0 bi bi-chevron-left"></i>'
        }
    }
});
