<?php
include "js/repositorio.php";
?>
<div class="table-container">
    <div class="table-responsive" style="min-height: 115px; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
        <table id="tableSearchResult" class="table table-bordered table-striped table-condensed table-hover dataTable">
            <thead>
                <tr role="row">
                    <th class="text-left" style="min-width:30px;">Nome</th>
                    <th class="text-left" style="min-width:30px;">cpf</th>
                    <th class="text-left" style="min-width:35px;">Ativo</th>
                    <th class="text-left" style="min-width:35px;">data</th>
                    <th class="text-left" style="min-width:35px;">rg</th>    
                </tr>
            </thead>
            <tbody>
                <?php

                $where = "WHERE (0 = 0)";

                $nome = "";
                if ($_POST["nome"] != "") {
                    $nome = $_POST["nome"];
                    $where = $where . " AND ( nomeCompleto like '%' + " . "replace('" . $nome . "',' ','%') + " . "'%')";
                }
                $data = "";
                if ($_POST["dataDeNascimento"] != "") {
                    $data = $_POST["data"];
                    $where = $where . " AND dataDeNascimento = '" . $dataDeNascimento . "'" ;
                }
                $rg = "";
                 if ($_POST["rg"] != "") {
                    $rg = $_POST["rg"];
                 $where = $where . "AND rg = '". $rg . "'";
                }
                $cpf = "";
                if ($_POST["cpf"] != "") {
                    $cpf = $_POST["cpf"];
                    $where = $where . "AND cpf = '". $cpf . "'";
                }
                $ativo = "";
                if ($_POST["ativo"] != "") {
                    $ativo= (Int)$_POST["ativo"];
                    $where = $where . "AND ativo = '". $ativo . "'";
                }

                $sql = " SELECT [codigo], [ativo], [nomeCompleto], [dataDeNascimento], [cpf], [rg] FROM funcionario ";
                
                $where = $where ;

                $sql = $sql . $where;
                $reposit = new reposit();
                $result = $reposit->RunQuery($sql);

                foreach($result as $row) {
                    $id= (int) $row['codigo'];
                    $ativo = (int) $row['ativo'];
                    $nome = $row['nomeCompleto'];
                    $dataDeNascimento = $row['dataDeNascimento'];
                    $cpf = $row['cpf'];
                    $rg= $row['rg'];

                    $descricaoAtivo = "";
                    if ($ativo == 1) {
                        $descricaoAtivo = "Sim";
                    } else {
                        $descricaoAtivo = "Não";
                    };
                    //Converção de data
                    $dataDeNascimento = explode (" ",$dataDeNascimento);
                    $dataDeNascimento= explode("-" , $dataDeNascimento[0] );
                    $dataDeNascimento= $dataDeNascimento[2] ."/" . $dataDeNascimento[1]. "/" . $dataDeNascimento[0];
                    
                    echo '<tr >';
                    echo '<td class="text-left"><a href="funcionarioCadastro.php?id=' . $id. '">' .$nome . '</a></td>';
                    echo '<td class="text-left">' . $cpf  . '</td>';
                    echo '<td class="text-left">' . $descricaoAtivo  . '</td>';
                    echo '<td class="text-left">' . $dataDeNascimento. '</td>';
                    echo '<td class="text-left">' . $rg. '</td>';
                    echo '</tr >';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script>
    $(document).ready(function() {

        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        /* TABLETOOLS */
        $('#tableSearchResult').dataTable({
            // Tabletools options: 
            //   https://datatables.net/extensions/tabletools/button_options
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>',
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sLengthMenu": "_MENU_ Resultados por página",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            "oTableTools": {
                "aButtons": ["copy", "csv", "xls", {
                        "sExtends": "pdf",
                        "sTitle": "SmartAdmin_PDF",
                        "sPdfMessage": "SmartAdmin PDF Export",
                        "sPdfSize": "letter"
                    },
                    {
                        "sExtends": "print",
                        "sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
                    }
                ],
                "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
            },
            "autoWidth": true,
            "preDrawCallback": function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_tabletools) {
                    responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#tableSearchResult'), breakpointDefinition);
                }
            },
            "rowCallback": function(nRow) {
                responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
            },
            "drawCallback": function(oSettings) {
                responsiveHelper_datatable_tabletools.respond();
            }
        });

    });
</script>