<?php
include "js/repositorio.php";
?>
<div class="table-container">
    <div class="table-responsive" style="min-height: 115px; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
        <table id="tableSearchResult" class="table table-bordered table-striped table-condensed table-hover dataTable">
            <thead>
                <tr role="row">
                    <th class="text-left" style="min-width:30px;">Funcionario</th>
                    <th class="text-left" style="min-width:30px;">EstadoCivil</th>
                    <th class="text-left" style="min-width:30px;">cpf</th>
                    <th class="text-left" style="min-width:35px;">Ativo</th>
                    <th class="text-left" style="min-width:35px;">data</th>
                    <th class="text-left" style="min-width:35px;">rg</th>
                    <th class="text-left" style="min-width:35px;">Sexo</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $where = "where (0 = 0)";

                $ativo = "";
                if ($_POST["ativo"] != "") {
                    $ativo = (int)$_POST["ativo"];
                    $where = $where . " AND USU.ativo = '" . $ativo . "'";
                }
                $nome = "";
                if ($_POST["nome"] != "") {
                    $nome = $_POST["nome"];
                    $where = $where . " AND ( USU.nomeCompleto like '%' + " . "replace('" . $nome . "',' ','%') + " . "'%')";
                }
                $estadoCivil = "";
                if ($_POST["estadoCivil"] != "") {
                    $nome = $_POST["estadoCivil"];
                    $where = $where . " AND ( USU.estadoCivil like '%' + " . "replace('" . $estadoCivil . "',' ','%') + " . "'%')";
                }
                $dataDeNascimento = "";
                if ($_POST["dataDeNascimento"] != "") {
                    $dataDeNascimento = $_POST["dataDeNascimento"];

                    $dataDeNascimento = explode("/", $dataDeNascimento);
                    $dataDeNascimento = "'" . $dataDeNascimento[2] . "-" . $dataDeNascimento[1] . "-" . $dataDeNascimento[0] . "'";
                    $where = $where . " AND USU.dataDeNascimento =" . $dataDeNascimento . "";
                }
                $rg = "";
                if ($_POST["rg"] != "") {
                    $rg = $_POST["rg"];
                    $where = $where . " AND USU.rg = '" . $rg . "'";
                }
                $cpf = "";
                if ($_POST["cpf"] != "") {
                    $cpf = $_POST["cpf"];
                    $where = $where . " AND USU.cpf = '" . $cpf . "'";
                }
                $sexo = "";
                if ($_POST["sexo"] != "") {
                    $sexo = $_POST["sexo"];
                    $where = $where . " AND ( USU.sexo like '%' + " . "replace('" . $sexo . "',' ','%') + " . "'%')";
                }
                $dataInicio = "";
                if ($_POST["dataInicio"] != "") {
                    $dataInicio = $_POST["dataInicio"];

                    $dataInicio = explode("/", $dataInicio);
                    $dataInicio = "'" . $dataInicio[2] . "-" . $dataInicio[1] . "-" . $dataInicio[0] . "'";
                    $where = $where . "AND USU.dataDeNascimento >=" . $dataInicio . "";
                }
                $dataFim = "";
                if ($_POST["dataFim"] != "") {
                    $dataFim = $_POST["dataFim"];

                    $dataFim = explode("/", $dataFim);
                    $dataFim = "'" . $dataFim[2] . "-" . $dataFim[1] . "-" . $dataFim[0] . "'";
                    $where = $where . "AND USU.dataDeNascimento < " . $dataFim . "";
                }

                $sql = " SELECT USU.codigo, USU.ativo, USU.nomeCompleto, USU.estadoCivil, USU.dataDeNascimento, USU.cpf, USU.rg , USUG.descricao,
                USU.cep, USU.logradouro, USU.numero, USU.complemento, USU.uf, USU.bairro, USU.cidade
                FROM dbo.funcionario USU
                LEFT JOIN dbo.sexo USUG on USUG.codigo = USU.sexo ";

                $sql = $sql . $where;

                $reposit = new reposit();
                $result = $reposit->RunQuery($sql);

                foreach ($result as $row) {

                    $id = (int) $row['codigo'];
                    $ativo = (int) $row['ativo'];
                    $nome = $row['nomeCompleto'];
                    $estadoCivil = $row['estadoCivil'];
                    $cpf = $row['cpf'];
                    $rg = $row['rg'];

                    $descricaoAtivo = "";
                    if ($ativo == 1) {
                        $descricaoAtivo = "Sim";
                    } else {
                        $descricaoAtivo = "Não";
                    };

                    $descricao = $row['descricao'];
                    $dataDeNascimento = $row['dataDeNascimento'];
                    //Converção de data
                    $dataDeNascimento = explode(" ", $dataDeNascimento);
                    $dataDeNascimento = explode("-", $dataDeNascimento[0]);
                    $dataDeNascimento = $dataDeNascimento[2] . "/" . $dataDeNascimento[1] . "/" . $dataDeNascimento[0];


                    echo '<tr >';
                    echo '<td class="text-left"><a href="funcionarioCadastro.php?id=' . $id . '">' . $nome . '</a></td>';
                    echo '<td class="text-left">' . $estadoCivil  . '</td>';
                    echo '<td class="text-left">' . $cpf  . '</td>';
                    echo '<td class="text-left">' . $descricaoAtivo  . '</td>';
                    echo '<td class="text-left">' . $dataDeNascimento . '</td>';
                    echo '<td class="text-left">' . $rg . '</td>';
                    echo '<td class="text-left">' . $descricao . '</td>';
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