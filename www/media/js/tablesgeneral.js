
    $('#consultas_general').DataTable( {
        "pageLength": 50,
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
        "language": {
        	"sEmptyTable": "Nenhum registro encontrado",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ Resultados por pagina",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "sInfo": "Mostrando do _START_ ate _END_ de _TOTAL_ registro(s)",
            "sInfoEmpty": "Mostrando 0 ate 0 de 0 registros",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
                "oPaginate": {
                "sNext": "Proximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Ultimo"

    },
        }
    } );
