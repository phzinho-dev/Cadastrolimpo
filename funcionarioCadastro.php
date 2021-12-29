<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

$condicaoAcessarOK = true;
$condicaoGravarOK = true;
$condicaoExcluirOK = true;
$condicaoRelatorioOK = true;

if ($condicaoAcessarOK == false) {
    unset($_SESSION['login']);
    header("Location:login.php");
}

$esconderBtnExcluir = "";
if ($condicaoExcluirOK === false) {
    $esconderBtnExcluir = "none";
}
$esconderBtnGravar = "";
if ($condicaoGravarOK === false) {
    $esconderBtnGravar = "none";
}
$esconderBtnRelario = "";
if ($condicaoRelatorioOK === false) {
    $esconderBtnRelario = "none";
}
/* ---------------- PHP Custom Scripts ---------

  YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
  E.G. $page_title = "Custom Title" */

$page_title = "Funcionario";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav['cadastro']['sub']["filtro"]["active"] = true;

include("inc/nav.php");
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php
    //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
    //$breadcrumbs["New Crumb"] => "http://url.com"
    $breadcrumbs["Cadastro"] = "";
    include("inc/ribbon.php");
    ?>

    <!-- MAIN CONTENT -->
    <div id="content">
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable centerBox">
                    <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"><i class="fa fa-cog"></i></span>
                            <h2>Funcionario</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <form class="smart-form client-form" id="formCliente" method="post" enctype="multipart/form-data">
                                    <div class="panel-group smart-accordion-default" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseCadastro" class="" id="accordionCadastro">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Cadastro
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseCadastro" class="panel-collapse collapse in">
                                                <div class="panel-body no-padding">
                                                    <fieldset>
                                                        <div class="row">
                                                            <section class="col col-1 col-auto">
                                                                <label class="label">Código</label>
                                                                <label class="input">
                                                                    <input id="codigo" name="codigo" readonly class="readonly" value="" autocomplete="off">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Ativo</label>
                                                                <label class="select">
                                                                    <select id="ativo" name="ativo" class="required">
                                                                        <option value="1" selected>Sim</option>
                                                                        <option value="0">Não</option>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>
                                                            <section class="col col-3 col-auto">
                                                                <label class="label" for="nomeCompleto">Nome</label>
                                                                <label class="input">
                                                                    <input id="nomeCompleto" type="text" class="required" maxlength="200" required autocomplete="off" placeholder="Nome">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2 col-auto">
                                                                <label class="label" for="rg">RG</label>
                                                                <label class="input">
                                                                    <input id="rg" type="text" class="required" maxlength="200" required autocomplete="off" placeholder="RG">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2 col-auto">
                                                                <label class="label" for="cpf">CPF</label>
                                                                <label class="input">
                                                                    <input id="cpf" type="text" class="required" maxlength="200" required autocomplete="off" placeholder="CPF">
                                                                </label>
                                                            </section>
                                                        </div>

                                                        <div class="row">
                                                            <section class="col col-2 ">
                                                                <label class="label">Estado Civil</label>
                                                                <label class="select">
                                                                    <select id="estadoCivil" name="estadoCivil" class="required" type="text" required autocomplete="off" placeholder="Estado Civil">
                                                                        <option hidden selected></option>
                                                                        <option value="1">Solteiro</option>
                                                                        <option value="2">Casado</option>
                                                                        <option value="3">Divorciado</opition>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>
                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Sexo</label>
                                                                <label class="select">
                                                                    <select id="sexo" name="sexo" class="required">
                                                                        <option hidden selected></option>
                                                                        <?php
                                                                        $reposit = new reposit();
                                                                        $sql = "SELECT codigo,descricao
                                                                        FROM dbo.sexo
                                                                        WHERE ativo = 1 ";
                                                                        $result = $reposit->RunQuery($sql);
                                                                        foreach ($result as $row) {
                                                                            $id = $row['codigo'];
                                                                            $sexo = $row['descricao'];
                                                                            echo '<option value=' . $id . '>' . $sexo . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label" for="dataDeNascimento">Data De Nascimento</label>
                                                                <label class="input">
                                                                    <input id="dataDeNascimento" name="dataDeNascimento" autocomplete="off" type="text" data-dateformat="dd/mm/yy" class="datepicker required" style="text-align: center" value="" data-mask="99/99/9999" placeholder="Data De Nascimento" autocomplete="off">
                                                                </label>
                                                            </section>

                                                            <section class="col col-1 col-auto">
                                                                <label class="label">Idade</label>
                                                                <label class="input">
                                                                    <input id="idade" name="idade" readonly class="readonly" value="" autocomplete="off">
                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Primeiro Emprego</label>
                                                                <label class="select">
                                                                    <select id="primeiroEmprego" name="primeiroEmprego" class="required" placeholder="Primeiro Emprego">
                                                                        <option hidden selected></option>
                                                                        <option value="1">Sim</option>
                                                                        <option value="0">Não</option>
                                                                    </select> <i></i>
                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label">PisPasep</label>
                                                                <label class="input">
                                                                    <input id="pisPasep" type="text" maxlength="14" required autocomplete="off" disabled class="" data-mask="999.99999.99.9">
                                                                </label>
                                                            </section>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseContato" class="" id="accordionContato">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Contato
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseContato" class="panel-collapse collapse">
                                                <div class="panel-body no-padding">
                                                    <fieldset>
                                                        <input id="jsonTelefone" name="jsonTelefone" type="hidden" value="[]">
                                                        <div id="formTelefone" class="col-sm-6">
                                                            <input id="sequencialTelefone" name="sequencialTelefone" type="hidden" value="">
                                                            <input id="descricaoTelefonePrincipal" name="descricaoTelefonePrincipal" type="hidden" value="">
                                                            <input id="descricaoTelefoneWhatsapp" name="descricaoTelefoneWhatsapp" type="hidden" value="">
                                                            <div class="row">
                                                                <section class="col col-5">
                                                                    <label class="label" for="telefone">Telefone</label>
                                                                    <label class="input">
                                                                        <input type="text" id="telefone" name="telefone" class="required" data-mask="(99) 99999-9999" data-mask-selectonmfocus="true" placeholder="Telefone" />
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label id="labeltelefonePrincipal" class="checkbox ">
                                                                        <input id="telefonePrincipal" name="telefonePrincipal" type="checkbox" value="true" checked="checked"><i></i>
                                                                        Principal
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label id="labeltelefoneWhatsapp" class="checkbox ">
                                                                        <input id="telefoneWhatsapp" name="telefoneWhatsapp" type="checkbox" value="true" checked="checked"><i></i>
                                                                        Whatsapp
                                                                    </label>
                                                                </section>
                                                                <Section class="col col-md-3">
                                                                    <label class="label">&nbsp;</label>
                                                                    <button id="btnAddTelefone" type="button" class="btn btn-primary">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    <button id="btnExclTelefone" type="button" class="btn btn-danger">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </section>
                                                            </div>

                                                            <div class="table-responsive" style="min-height: 115px; width:95%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
                                                                <table id="tableTelefone" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th style="width: 2px"></th>
                                                                            <th class="text-center">Telefone</th>
                                                                            <th class="text-center">Principal</th>
                                                                            <th class="text-center">Whatsapp</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>
                                                        <input id="jsonEmail" name="jsonEmail" type="hidden" value="[]">
                                                        <div id="formEmail" class="col-sm-6">
                                                            <input id="sequencialEmail" name="sequencialEmail" type="hidden" value="">
                                                            <input id="descricaoEmailPrincipal" name="descricaoEmailPrincipal" type="hidden" value="">
                                                            <div class="row">
                                                                <section class="col col-6">
                                                                    <label class="label">Email</label>
                                                                    <label class="input">
                                                                        <input type="text" id="email" name="email" class="" placeholder="Email" />
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label id="labelemailPrincipal" class="checkbox ">
                                                                        <input id="emailPrincipal" name="emailPrincipal" type="checkbox" value="true" checked="checked"><i></i>
                                                                        Principal
                                                                    </label>
                                                                </section>
                                                                <Section class="col col-md-3">
                                                                    <label class="label">&nbsp;</label>
                                                                    <button id="btnAddEmail" type="button" class="btn btn-primary">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    <button id="btnExclEmail" type="button" class="btn btn-danger">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </section>
                                                            </div>

                                                            <div class="table-responsive" style="min-height: 115px; width:95%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
                                                                <table id="tableEmail" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th style="width: 2px"></th>
                                                                            <th class="text-center" style="min-width:35px">Email</th>
                                                                            <th class="text-center" style="min-width:20px">Principal</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <button id="btnRelatorio" type="button" class="btn btn-danger pull-right hidden" title="relatorio" style="display:<?php echo $esconderBtnRelatorio ?>">
                                                                <span class="fa fa-file-pdf-o"></span>
                                                            </button>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseEndereco" class="" id="accordionEndereco">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Endereço
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseEndereco" class="panel-collapse collapse">
                                                <div class="panel-body no-padding">
                                                    <fieldset>
                                                        <div class="row">
                                                            <section class="col col-2">
                                                                <label class="label" for="cep">CEP</label>
                                                                <label class="input">
                                                                    <input type="text" id="cep" name="cep" class="required" placeholder="CEP" data-mask="99999-999">
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label" for="logradouro">Logradouro</label>
                                                                <label class="input">
                                                                    <input type="text" id="logradouro" name="logradouro" placeholder="Logradouro" />
                                                                </label>
                                                            </section>
                                                            <section class="col col-1">
                                                                <label class="label" for="numero">Numero</label>
                                                                <label class="input">
                                                                    <input type="text" id="numero" name="numero" class="required" placeholder="Numero" />
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label" for="complemento">Complemento</label>
                                                                <label class="input">
                                                                    <input type="text" id="complemento" name="complemento" class="" placeholder="Complemento" />
                                                                </label>
                                                            </section>
                                                            <section class="col col-1">
                                                                <label class="label" for="uf">UF</label>
                                                                <label class="input">
                                                                    <input type="text" id="uf" name="uf" placeholder="UF" />
                                                                </label>
                                                            </section>
                                                        </div>
                                                        <div class="row">
                                                            <section class="col col-2-auto">
                                                                <label class="label" for="bairro">Bairro</label>
                                                                <label class="input">
                                                                    <input type="text" id="bairro" name="bairro" placeholder="Bairro" />
                                                                </label>
                                                            </section>
                                                            <section class="col col-2">
                                                                <label class="label" for="cidade">Cidade</label>
                                                                <label class="input">
                                                                    <input type="text" id="cidade" name="cidade" placeholder="Cidade">
                                                                </label>
                                                            </section>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseDependente" class="" id="accordionDependente">
                                                            <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                            <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                            Dependente
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseDependente" class="panel-collapse collapse">
                                                    <div class="panel-body no-padding">
                                                        <fieldset>
                                                            <input id="jsonDependente" name="jsonDependente" type="hidden" value="[]">
                                                            <div id="formDependente" class="col-sm-12">
                                                                <input id="sequencialDependente" name="sequencialDependente" type="hidden" value="">
                                                                <input id="descricaoDependente" name="descricaoDependente" type="hidden" value="">
                                                                <div class="row">
                                                                    <section class="col col-3 col-auto">
                                                                        <label class="label" for="nomeDependente">Nome</label>
                                                                        <label class="input">
                                                                            <input id="nomeDependente" name="nomeDependente" type="text" class="" maxlength="200" required autocomplete="off" placeholder="Nome">
                                                                        </label>
                                                                    </section>
                                                                    <section class="col col-2">
                                                                        <label class="label" for="cpfDependente">CPF</label>
                                                                        <label class="input">
                                                                            <input id="cpfDependente" name="cpfDependente" type="text" class="" maxlength="200" required autocomplete="off" placeholder="CPF">
                                                                        </label>
                                                                    </section>
                                                                    <section class="col col-2 col-auto">
                                                                        <label class="label" for="dataNascimento">Data De Nascimento</label>
                                                                        <label class="input">
                                                                            <input id="dataNascimento" name="dataNascimento" autocomplete="off" type="text" data-dateformat="dd/mm/yy" class="datepicker" style="text-align: center" value="" data-mask="99/99/9999" placeholder="Data De Nascimento" autocomplete="off">
                                                                        </label>
                                                                    </section>
                                                                    <section class="col col-3 col-auto">
                                                                        <label class="label">Tipo de Dependente</label>
                                                                        <label class="select">
                                                                            <select id="tipoDependente" name="tipoDependente" class="">
                                                                                <option hidden selected></option>
                                                                                <?php
                                                                                $reposit = new reposit();
                                                                                $sql = "SELECT codigo, descricao 
                                                                                FROM dbo.tipoDependente
                                                                                WHERE ativo = 1 ";
                                                                                $result = $reposit->RunQuery($sql);
                                                                                foreach ($result as $row) {
                                                                                    $id = $row['codigo'];
                                                                                    $descricao = $row['descricao'];
                                                                                    echo '<option value=' . $id . '>' . $descricao . '</option>';
                                                                                }
                                                                                ?>
                                                                            </select><i></i>
                                                                        </label>
                                                                    </section>
                                                                    <Section class="col col-md-2">
                                                                        <label class="label">&nbsp;</label>
                                                                        <button id="btnAddDependente" type="button" class="btn btn-primary">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                        <button id="btnExclDependente" type="button" class="btn btn-danger">
                                                                            <i class="fa fa-minus"></i>
                                                                        </button>
                                                                    </section>

                                                                </div>
                                                                <div class="table-responsive" style="min-height: 115px; width: 95%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
                                                                    <table id="tableDependente" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                        <thead>
                                                                            <tr role="row">
                                                                                <th style="width: 3%"></th>
                                                                                <th class="text-center" style="width: 20%">Nome</th>
                                                                                <th class="text-center" style="width: 20%">CPF</th>
                                                                                <th class="text-center" style="width: 20%">Data de Nascimento</th>
                                                                                <th class="text-center" style="width: 20%">Tipo de Dependente</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <footer>
                                            <button type="button" id="btnExcluir" class="btn btn-danger" aria-hidden="true" title="Excluir" style="display:<?php echo $esconderBtnExcluir ?>">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                            <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front ui-dialog-buttons ui-draggable" tabindex="-1" role="dialog" aria-describedby="dlgSimpleExcluir" aria-labelledby="ui-id-1" style="height: auto; width: 600px; top: 220px; left: 262px; display: none;">
                                                <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
                                                    <span id="ui-id-2" class="ui-dialog-title">
                                                    </span>
                                                </div>
                                                <div id="dlgSimpleExcluir" class="ui-dialog-content ui-widget-content" style="width: auto; min-height: 0px; max-height: none; height: auto;">
                                                    <p>CONFIRMA A EXCLUSÃO ? </p>
                                                </div>
                                                <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
                                                    <div class="ui-dialog-buttonset">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" id="btnGravar" class="btn btn-success" aria-hidden="true" title="Gravar" style="display:<?php echo $esconderBtnGravar ?>">
                                                <span class="fa fa-floppy-o"></span>
                                            </button>
                                            <button type="button" id="btnNovo" class="btn btn-primary" aria-hidden="true" title="Novo" style="display:<?php echo $esconderBtnGravar ?>">
                                                <span class="fa fa-file-o"></span>
                                            </button>
                                            <button type="button" id="btnVoltar" class="btn btn-default" aria-hidden="true" title="Voltar">
                                                <span class="fa fa-backward "></span>
                                            </button>
                                        </footer>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
        <!-- end widget grid -->

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->

<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
include("inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php
//include required scripts
include("inc/scripts.php");
?>

<script src="<?php echo ASSETS_URL; ?>/js/businessFuncionarioCadastro.js" type="text/javascript"></script>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->
<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.cust.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.time.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.tooltip.min.js"></script>
<!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- Full Calendar -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/moment/moment.min.js"></script>
<!--<script src="/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>-->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/fullcalendar.js"></script>
<!--<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/locale-all.js"></script>-->
<!-- Validador de CPF -->
<script src="js/plugin/cpfcnpj/jquery.cpfcnpj.js"></script>

<!-- Form to json -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/form-to-json/form2js.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/form-to-json/jquery.toObject.js"></script>

<script language="JavaScript" type="text/javascript">
    $(document).ready(function() {
        $('#dlgSimpleExcluir').dialog({

            autoOpen: false,
            width: 400,
            resizable: false,
            modal: true,
            title: "Atenção",
            buttons: [{
                html: "Excluir registro",
                "class": "btn btn-success",
                click: function() {
                    $(this).dialog("close");
                    excluir();
                }
            }, {
                html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
                "class": "btn btn-default",
                click: function() {
                    $(this).dialog("close");
                }
            }]
        });

        jsonTelefoneArray = JSON.parse($("#jsonTelefone").val());

        $("#btnAddTelefone").on("click", function() {
            var telefone = $("#telefone").val();
            var existe = true;

            if (!telefone) {
                smartAlert("Atenção", "Escolha um Telefone", "error")
                return;
            }
            if (validaTelefone()) {
                addTelefone();
            }

        });

        $("#btnExclTelefone").on("click", function() {
            excluirTelefone();
        });

        jsonEmailArray = JSON.parse($("#jsonEmail").val());

        $("#btnAddEmail").on("click", function() {
            var email = $("#email").val();
            var existe = true;

            if (!email) {
                smartAlert("Atenção", "Informe um E-mail Valido!!!.", "error")
                return;
            }
            if (validaEmail()) {
                addEmail();
            }

        });

        $("#btnExclEmail").on("click", function() {
            excluirEmail();
        });

        jsonDependenteArray = JSON.parse($("#jsonDependente").val());

        $("#btnAddDependente").on("click", function() {
            var tipoDependente = $("#tipoDependente").text();
            var existe = true;

            if (!tipoDependente) {
                smartAlert("Atenção", "Escolha um Tipo De Dependente", "error")
                return;
            }
            if (validaDependente()) {
                addDependente();
            }
        });

        $("#btnExclDependente").on("click", function() {
            excluirDependente();
        });

        $("#btnExcluir").on("click", function() {
            var id = $("#codigo").val();

            if (id === 0) {
                smartAlert("Atenção", "Selecione um registro para excluir !", "error");
                $("#nome").focus();
                return;
            }
            if (id !== 0) {
                $('#dlgSimpleExcluir').dialog('open');
            }

        });

        $("#nomeCompleto").on("change", function() {      
            var nomeCompleto = $('#nomeCompleto').val().trim();
            $("#nomeCompleto").val(nomeCompleto);
            validanome()
        });

        $("#dataDeNascimento").on("change", function() {
            calculaIdade()
        });

        $("#btnNovo").on("click", function() {
            novo();
        });

        $("#btnGravar").on("click", function() {
            var ativo = +$('#ativo').val();
            if (ativo == 1) {} else {
                (ativo == 0)
                smartAlert("Atenção", "Não é possivel cadastrar um Funcionario INATIVO!!", "error");
                $('#ativo').val(0);
                return
            }
            gravar()
        });

        $("#btnVoltar").on("click", function() {
            voltar();
        });

        $("#btnRelatorio").on("click", function() {
            gerarPdf();
        });
        $("#nomeCompleto").on("change", function() {
            validaNome();
        }); 

        $("#rg").on("focusout", function() {
            var rg = $('#rg').val();

            if (verificarRG(rg)) {
                smartAlert("Atençao", "Informe um Rg valido", "error");
                $('#rg').val('');
                return

            };
        });

        $("#cpf").on("focusout", function() {
            var cpf = $("#cpf").val()

            if (!validarCPF(cpf)) {
                smartAlert("Atenção", "Informe um CPF valido", "error");
                $('#cpf').val('');
                return
            }
        });

        $("#primeiroEmprego").on("change", function() {
            var primeiroEmprego = +$('#primeiroEmprego').val();
            if (primeiroEmprego == 1) {
                $("#pisPasep").addClass('readonly', true);
                $("#pisPasep").attr('disabled', true);
                $("#pisPasep").val('');
            } else {
                $("#pisPasep").removeAttr('disabled', true);
                $("#pisPasep").removeClass('readonly', true);
                $("#pisPasep").addClass('required', true);
            }
        });

        $("#cep").on("change", function() {
            enderecoCep()

            $('#logradouro').addClass('readonly', true);
            $("#logradouro").attr('disabled', true);
            $('#uf').addClass('readonly', true);
            $('#uf').attr('disabled', true);
            $('#bairro').addClass('readonly', true);
            $('#bairro').attr('disabled', true);
            $('#cidade').addClass('readonly', true);
            ('#cidade').attr('disable', true);
        });

        $("#pisPasep").on("change", function() {
            if (!verificarPisPasep()) {};
        });

        $("#nomeDependente").on("change", function() {
            var nomeDependente = $('#nomeDependente').val().trim();
            $("#nomeDependente").val(nomeDependente);
            validaNomedependente();
        });

        $("#cpfDependente").on("change", function() {
            var cpfDependente = $('#cpfDependente').val();

            if (!validarCPFDependente(cpfDependente)) {
                smartAlert("Atenção", "Informe um CPF valido", "error");
                $('#cpfDependente').val('')
            }
        })

        $("#dataNascimento").on("change", function() {
            calculaIdadeDependente()
        });

        $("#email").on("change", function() {
            validarEmail();
        });

        $("#cpf").mask("999.999.999-99")

        $("#dataDeNascimento").mask("99/99/9999")

        $("#rg").mask("99.999.999-9")

        $("#cep").mask("99999-999")

        $("#cpfDependente").mask("999.999.999-99")

        carregaPagina();


    });

    function validaNome() {
        var filterNome = /^([a-zA-Zà-úÀ-Ú]|\s+)+$/;
        if (!filterNome.test(document.getElementById("nomeCompleto").value)) {
            document.getElementById("nomeCompleto").style.borderColor = "#ff0000";
            document.getElementById("nomeCompleto").style.outline = "#ff0000";
            document.getElementById("nomeCompleto").focus();
            document.getElementById("nomeCompleto").onkeydown = function keydownNome() {
                document.getElementById("nomeCompleto").placeholder = "";
                document.getElementById("nomeCompleto").style.borderColor = "#999999";
                document.getElementById("nomeCompleto").style.outline = null;
            } 
            smartAlert("Atenção","Nome Invalido !!","error");
            return $("#nomeCompleto").val('');
        }
        return true;
    }

    function validaNomeDependente() {
        var nomeDependente = $("#nomeDependente").val();
        var filterNome = /^([a-zA-Zà-úÀ-Ú]|\s+)+$/;
        if (!filterNome.test(document.getElementById("nomeDependente").value)) {
            document.getElementById("nomeDependente").style.borderColor = "#ff0000";
            document.getElementById("nomeDependente").style.outline = "#ff0000";
            document.getElementById("nomeDependente").focus();
            document.getElementById("nomeDependente").onkeydown = function keydownNome() {
                document.getElementById("nomeDependente").placeholder = "";
                document.getElementById("nomeDependente").style.borderColor = "#999999";
                document.getElementById("nomeDependente").style.outline = null;
            }
            smartAlert("Atenção","Nome Invalido !!","error");
            return $("#nomeDependente").val('');
        }
        return true;
    }

    function carregaPagina() {
        var urlx = window.document.URL.toString();
        var params = urlx.split("?");
        if (params.length === 2) {
            var id = params[1];
            var idx = id.split("=");
            var idd = idx[1];
            if (idd !== "") {
                recuperaFuncionarioCadastro(idd,
                    function(data) {
                        if (data.indexOf('failed') > -1) {
                            return;
                        } else {
                            data = data.replace(/failed/g, '');
                            var piece = data.split("#");
                            var mensagem = piece[0];
                            var out = piece[1];
                            var strArrayTelefone = piece[2];
                            var strArrayEmail = piece[3];
                            var strArrayDependente = piece[4];
                            piece = out.split("^");

                            // Atributos de vale transporte unitário que serão recuperados: 
                            var codigo = piece[0];
                            var ativo = piece[1];
                            var nomeCompleto = piece[2];
                            var estadoCivil = piece[3]
                            var dataDeNascimento = piece[4];
                            var cpf = piece[5];
                            var rg = piece[6];
                            var descricao = piece[7];

                            var cep = piece[8];
                            var logradouro = piece[9];
                            var numero = piece[10];
                            var complemento = piece[11];
                            var uf = piece[12];
                            var bairro = piece[13];
                            var cidade = piece[14];
                            var primeiroEmprego = piece[15];
                            var pisPasep = piece[16];


                            //Associa as varíaveis recuperadas pelo javascript com seus respectivos campos html.
                            $("#codigo").val(codigo);
                            $("#ativo").val(ativo);
                            $("#nomeCompleto").val(nomeCompleto);
                            $("#estadoCivil").val(estadoCivil);
                            $("#dataDeNascimento").val(dataDeNascimento);
                            $("#cpf").val(cpf);
                            $("#rg").val(rg);
                            $("#sexo").val(descricao);
                            $("#cep").val(cep);
                            $("#logradouro").val(logradouro);
                            $("#numero").val(numero);
                            $("#complemento").val(complemento);
                            $("#uf").val(uf);
                            $("#bairro").val(bairro);
                            $("#cidade").val(cidade);
                            $("#primeiroEmprego").val(primeiroEmprego);
                            $("#pisPasep").val(pisPasep);

                            $("#jsonTelefone").val(strArrayTelefone);
                            jsonTelefoneArray = JSON.parse($("#jsonTelefone").val());

                            $("#jsonEmail").val(strArrayEmail);
                            jsonEmailArray = JSON.parse($("#jsonEmail").val());

                            $("#jsonDependente").val(strArrayDependente);
                            jsonDependenteArray = JSON.parse($("#jsonDependente").val());

                            fillTableTelefone();
                            fillTableEmail();
                            fillTableDependente();
                            calculaIdade();
                            geraPDF();


                            return;

                        }
                    }
                );
            }
        }
    }


    function gravar() {
        //Botão que desabilita a gravação até que ocorra uma mensagem de erro ou sucesso.
        // $("#btnGravar").prop('disabled', true);
        // Variáveis que vão ser gravadas no banco:
        var id = +$('#codigo').val();
        var nomeCompleto = $('#nomeCompleto').val().trim();
        var estadoCivil = $('#estadoCivil').val();
        var ativo = $('#ativo').val();
        var rg = $('#rg').val();
        var cpf = $('#cpf').val();
        var dataDeNascimento = $('#dataDeNascimento').val();
        var sexo = +$('#sexo').val();

        var cep = $('#cep').val();
        var logradouro = $('#logradouro').val();
        var numero = $('#numero').val();
        var uf = $('#uf').val();
        var bairro = $('#bairro').val();
        var cidade = $('#cidade').val();
        var primeiroEmprego = +$('#primeiroEmprego').val();
        var pisPasep = $('#pisPasep').val();

        var jsonTelefoneArray = $('#jsonTelefone').val();
        var jsonEmailArray = $('#jsonEmail').val();
        var jsonDependenteArray = $('#jsonDependente').val();

        // Mensagens de aviso caso o usuário deixe de digitar algum campo obrigatório:

        if (ativo === "") {
            smartAlert("Atenção", "Informe a Ativo", "error");
            $("#btnGravar").prop('disabled', false);
        }

        if (!nomeCompleto) {
            smartAlert("Atenção", "Informe o nome", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }

        if (!rg) {
            smartAlert("Atenção", "Informe o Rg", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }

        if (!cpf || cpf == "___.___.___-__") {
            smartAlert("Atenção", "Informe o cpf", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }

        if (!estadoCivil) {
            smartAlert("Atenção", "Informe o seu Estado Civil", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }

        if (!sexo) {
            smartAlert("Atenção", "Informe um Sexo", "error");
            $("#btnGravar").prop('disabled', false);
        }

        if (!dataDeNascimento) {
            smartAlert("Atenção", "Informe a Data de Nascimento", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }

        if (primeiroEmprego === "") {
            smartAlert("Atenção", "Informe se é seu primeiro emprego ou não", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if ((primeiroEmprego == 0) && (!pisPasep)) {
            smartAlert("Atenção", "Informe seu PisPasep!!", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }

        if (!cep) {
            smartAlert("Atenção", "Informe o CEP", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }

        if (!numero) {
            smartAlert("Atenção", "Informe o Numero ", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }

        if (jsonTelefoneArray.length <= 0) {
            smartAlert("Atenção", "Informe Pelo menos 1 telefone", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }

        gravarFuncionarioCadastro(id, ativo, nomeCompleto, estadoCivil, cpf, rg, dataDeNascimento, descricao, cep, logradouro, numero, uf, bairro, cidade, primeiroEmprego, pisPasep, jsonTelefoneArray, jsonEmailArray, jsonDependenteArray,
            function(data) {
                if (data.indexOf('sucess') < 0) {
                    var piece = data.split("#");
                    var mensagem = piece[1];
                    if (mensagem !== "") {
                        smartAlert("Atenção", mensagem, "error");
                        $("#btnGravar").prop('disabled', false);
                    } else {
                        smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
                        $("#btnGravar").prop('disabled', false);
                    }
                    return '';
                } else {

                    //Verifica se a função de recuperar os campos foi executada.
                    var verificaRecuperacao = +$("#verificaRecuperacao").val();
                    smartAlert("Sucesso", "Operação realizada com sucesso!", "success");

                    if (verificaRecuperacao === 1) {
                        voltar();
                    } else {
                        novo();

                    }

                }
            }
        );
    }


    function calculaIdade() {
        var dataDeNascimento = $('#dataDeNascimento').val();
        var y = (parseInt(dataDeNascimento.split('/')[2]));
        var m = (parseInt(dataDeNascimento.split('/')[1]));
        var d = (parseInt(dataDeNascimento.split('/')[0]));

        var dataHoje = moment().format('DD/MM/YYYY');
        var yH = (parseInt(dataHoje.split('/')[2]));
        var mH = (parseInt(dataHoje.split('/')[1]));
        var dH = (parseInt(dataHoje.split('/')[0]));

        var dataValida = moment(dataDeNascimento, 'DD/MM/YYYY').isValid();
        if (!dataValida) {
            smartAlert("Atenção", "DATA INVALIDA!", "error");
            $('#idade').val('');
            $('#dataDeNascimento').val('');
            return;
        }
        if (moment(dataDeNascimento, 'DD/MM/YYYY').diff(moment()) > 0) {
            smartAlert("Atenção", "DATA NÃO PODE SER MAIOR QUE HOJE!", "error");
            $('#idade').val('');
            $('#dataDeNascimento').val('');
            return;

        }

        var idade = yH - y;

        if (mH < m) {
            idade--;
        }
        if (dH < d && mH == m) {
            idade--;
        }

        $('#idade').val(idade);
        return idade;
    }

    function calculaIdadeDependente() {
        var dataNascimento = $('#dataNascimento').val();
        var y = (parseInt(dataNascimento.split('/')[2]));
        var m = (parseInt(dataNascimento.split('/')[1]));
        var d = (parseInt(dataNascimento.split('/')[0]));

        var dataHoje = moment().format('DD/MM/YYYY');
        var yH = (parseInt(dataHoje.split('/')[2]));
        var mH = (parseInt(dataHoje.split('/')[1]));
        var dH = (parseInt(dataHoje.split('/')[0]));

        var dataValida = moment(dataNascimento, 'DD/MM/YYYY').isValid();
        if (!dataValida) {
            smartAlert("Atenção", "DATA INVALIDA!", "error");
            $('#idade').val('');
            $('#dataNascimento').val('');
            return;
        }
        if (moment(dataNascimento, 'DD/MM/YYYY').diff(moment()) > 0) {
            smartAlert("Atenção", "DATA NÃO PODE SER MAIOR QUE HOJE!", "error");
            $('#idade').val('');
            $('#dataNascimento').val('');
            return;

        }

        var idade = yH - y;

        if (mH < m) {
            idade--;
        }
        if (dH < d && mH == m) {
            idade--;
        }

        $('#idade').val(idade);
        return idade;
    }

    function novo() {
        $(location).attr('href', 'funcionarioCadastro.php');
    }

    function voltar() {
        $(location).attr('href', 'funcionarioFiltro.php');
    }

    function excluir() {
        var id = $("#codigo").val();
        if (id === 0) {
            smartAlert("Atenção", "Selecione um registro para excluir!", "error");
            return;
        }

        excluirFuncionarioCadastro(id,
            function(data) {
                if (data.indexOf('failed') > 0) {
                    var piece = data.split("#");
                    var mensagem = piece[1];
                    if (mensagem !== "") {
                        smartAlert("Atenção", mensagem, "error");
                    } else {
                        smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
                    }
                    voltar();
                } else {
                    smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
                    voltar();
                    return '';
                }
            });
    }

    function geraPDF() {
        var id = $("#codigo").val();
        if (id != 0) {
            $("#btnRelatorio").removeClass('hidden');
        }
    }

    function gerarPdf() {
        var id = $('#codigo').val();
        var parametrosUrl = '&codigo=' + id; // - > PASSAGEM DE PARAMETRO
        window.open("funcionarioContatoPDF.php?'" + parametrosUrl); // - > ABRE O RELATÓRIO EM UMA NOVA GUIA

    }


    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g, '');
        if (cpf == '') return false;
        // Elimina CPFs invalidos conhecidos	
        if (cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999")
            return false;
        // Valida 1o digito	
        add = 0;
        for (i = 0; i < 9; i++)
            add += parseInt(cpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            return false;
        // Valida 2o digito	
        add = 0;
        for (i = 0; i < 10; i++)
            add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10))) {
            return false;
        } else {
            verificarCPF();
        }
        return true;
    }

    function verificarCPF() {
        var cpf = $("#cpf").val();

        verificaCPF(cpf,
            function(data) {
                if (data.indexOf('failed') > -1) {
                    var piece = data.split("#");
                    var mensagem = piece[1];

                    if (mensagem !== "") {
                        smartAlert("Atenção", mensagem, "error");
                    } else {
                        smartAlert("Atenção", "Cpf ja cadastrado no sistema", "error");
                        $("#cpf").val('')
                    }
                }
            });
    }

    function verificarPisPasep() {
        var pisPasep = $("#pisPasep").val();

        verificaPisPasep(pisPasep,
            function(data) {
                if (data.indexOf('failed') > -1) {
                    var piece = data.split("#");
                    var mensagem = piece[1];

                    if (mensagem !== "") {
                        smartAlert("Atenção", mensagem, "error");
                    } else {
                        smartAlert("Atenção", "PisPasep ja cadastrado no sistema", "error");
                        $("#PisPasep").val('')
                    }
                }
            });
    }


    function validarCPFDependente(cpfDependente) {
        cpfDependente = cpfDependente.replace(/[^\d]+/g, '');
        if (cpfDependente == '') return false;
        // Elimina CPFs invalidos conhecidos	
        if (cpfDependente.length != 11 ||
            cpfDependente == "___.___.___-__" ||
            cpfDependente == "00000000000" ||
            cpfDependente == "11111111111" ||
            cpfDependente == "22222222222" ||
            cpfDependente == "33333333333" ||
            cpfDependente == "44444444444" ||
            cpfDependente == "55555555555" ||
            cpfDependente == "66666666666" ||
            cpfDependente == "77777777777" ||
            cpfDependente == "88888888888" ||
            cpfDependente == "99999999999")
            return false;
        // Valida 1o digito	
        add = 0;
        for (i = 0; i < 9; i++)
            add += parseInt(cpfDependente.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpfDependente.charAt(9)))
            return false;
        // Valida 2o digito	
        add = 0;
        for (i = 0; i < 10; i++)
            add += parseInt(cpfDependente.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpfDependente.charAt(10))) {
            return false;
        } else {
            verificarCPFDependente();
        }
        return true;
    }

    function verificarCPFDependente() {
        var cpfDependente = $("#cpfDependente").val();

        verificaCPFDependente(cpfDependente,
            function(data) {
                if (data.indexOf('failed') > -1) {
                    var piece = data.split("#");
                    var mensagem = piece[1];

                    if (mensagem !== "") {
                        smartAlert("Atenção", mensagem, "error");
                    } else {
                        smartAlert("Atenção", "Cpf ja cadastrado no sistema", "error");
                        $("#cpfDependente").val('')
                    }
                }
            });
    }

    function verificarRG() {
        var rg = $("#rg").val();

        verificaRG(rg,
            function(data) {
                if (data.indexOf('failed') > -1) {
                    var piece = data.split("#");
                    var mensagem = piece[1];

                    if (mensagem !== "") {
                        smartAlert("Atenção", mensagem, "error");
                    } else {
                        smartAlert("Atenção", "Rg ja cadastrado no sistema", "error");
                        $("#rg").val('')
                    }
                }
            });
    }

    function validarEmail() {
        if (document.forms[0].email.value == (" ") ||
            document.forms[0].email.value.indexOf('@') == -1 ||
            document.forms[0].email.value.indexOf('.') == -1) {
            $("#email").val('')
        }
    }


    function validaTelefone() {
        var existe = false;
        var achou = false;

        var telefone = $('#telefone').val();
        var sequencial = +$('#sequencialTelefone').val();
        var telefoneValido = false;
        var telefonePrincipalMarcado = 0;

        if ($("#telefonePrincipal").is(':checked') === true) {
            telefonePrincipalMarcado = 1;
        }
        if (telefone === '') {
            smartAlert("Erro", "Informe um telefone.", "error");
            return false;
        }

        for (i = jsonTelefoneArray.length - 1; i >= 0; i--) {
            if (telefonePrincipalMarcado === 1) {
                if ((jsonTelefoneArray[i].telefonePrincipal === 1) && (jsonTelefoneArray[i].sequencialTelefone !== sequencial)) {
                    achou = true;
                    break;
                }
            }
            if ((jsonTelefoneArray[i].telefone === telefone) && (jsonTelefoneArray[i].sequencialTelefone !== sequencial)) {
                existe = true;
                break;
            }
        }
        if (telefone === "(XX) XXXXX-XXXX") {
            smartAlert("Erro", "Informe um Telefone valido", "error")
            return false;
        }
        if ((achou === true) && (telefonePrincipalMarcado === 1)) {
            smartAlert("Erro", "Já existe um telefone principal na lista.", "error");
            return false;
        }
        if (existe === true) {
            smartAlert("Erro", "telefone já cadastrado.", "error");
            return false;
        }
        return true;
    }

    function addTelefone() {

        var item = $("#formTelefone").toObject({
            mode: 'combine',
            skipEmpty: false,
            nodeCallback: processDataTelefone
        });

        if (item["sequencialTelefone"] === '') {
            if (jsonTelefoneArray.length === 0) {
                item["sequencialTelefone"] = 1;
            } else {
                item["sequencialTelefone"] = Math.max.apply(Math, jsonTelefoneArray.map(function(o) {
                    return o.sequencialTelefone;
                })) + 1;
            }
            item["telefoneId"] = 0;
        } else {
            item["sequencialTelefone"] = +item["sequencialTelefone"];
        }

        var index = -1;
        $.each(jsonTelefoneArray, function(i, obj) {
            if (+$('#sequencialTelefone').val() === obj.sequencialTelefone) {
                index = i;
                return false;
            }
        });
        var telefonePrincipal = $("#telefonePrincipal").val();
        if (telefonePrincipal == "true") {
            $("#telefonePrincipal").prop('checked', false)
        }
        var telefoneWhatsapp = $("#telefoneWhatsapp").val();
        if (telefoneWhatsapp == "true") {
            $("#telefoneWhatsapp").prop('checked', false)
        }
        if (index >= 0)
            jsonTelefoneArray.splice(index, 1, item);
        else
            jsonTelefoneArray.push(item);
        console.log(jsonTelefoneArray)
        $("#jsonTelefone").val(JSON.stringify(jsonTelefoneArray));


        fillTableTelefone();
        clearFormTelefone();

    }

    function clearFormTelefone() {
        $("#telefone").val('');
        $("#sequencialTelefone").val('');
        $("#descricaoTelefonePrincipal").val('');
        $("#telefoneWhatsapp").val('');
        $("#descricaoTelefoneWhatsapp").val('');
        $("#telefonePrincipal").val('');
    }

    function fillTableTelefone() {
        $("#tableTelefone tbody").empty();

        for (var i = 0; i < jsonTelefoneArray.length; i++) {

            var row = $('<tr />');
            $("#tableTelefone tbody").append(row);
            row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonTelefoneArray[i].sequencialTelefone + '"><i></i></label></td>'));
            row.append($('<td class="text-center" onclick="carregaTelefone(' + jsonTelefoneArray[i].sequencialTelefone + ');">' + jsonTelefoneArray[i].telefone + '</td>'));
            row.append($('<td class="text-center" "">' + jsonTelefoneArray[i].descricaoTelefonePrincipal + '</td>'));
            row.append($('<td class="text-center" "">' + jsonTelefoneArray[i].descricaoTelefoneWhatsapp + '</td>'));

        }
    }

    function processDataTelefone(node) {
        var fieldId = node.getAttribute ? node.getAttribute('id') : '';
        var fieldName = node.getAttribute ? node.getAttribute('name') : '';


        if (fieldName !== '' && (fieldId === "telefonePrincipal")) {
            var valorTelefonePrincipal = 0;
            if ($("#telefonePrincipal").is(':checked') === true) {
                valorTelefonePrincipal = 1;
            }
            return {
                name: fieldName,
                value: valorTelefonePrincipal
            };
        }

        if (fieldName !== '' && (fieldId === "descricaoTelefonePrincipal")) {
            var valorDescricaoTelefonePrincipal = "Não";
            if ($("#telefonePrincipal").is(':checked') === true) {
                valorDescricaoTelefonePrincipal = "Sim";
            }
            return {
                name: fieldName,
                value: valorDescricaoTelefonePrincipal
            };
        }

        if (fieldName !== '' && (fieldId === "telefoneWhatsapp")) {
            var valorTelefoneWhatsapp = 0;
            if ($("#telefoneWhatsapp").is(':checked') === true) {
                valorTelefoneWhatsapp = 1;
            }
            return {
                name: fieldName,
                value: valorTelefoneWhatsapp
            };
        }
        if (fieldName !== '' && (fieldId === "descricaoTelefoneWhatsapp")) {
            var valorDescricaoTelefoneWhatsapp = "Não";
            if ($("#telefoneWhatsapp").is(':checked') === true) {
                valorDescricaoTelefoneWhatsapp = "Sim";
            }
            return {
                name: fieldName,
                value: valorDescricaoTelefoneWhatsapp
            };
        }

        return false;
    }

    function carregaTelefone(sequencialTelefone) {
        var arr = jQuery.grep(jsonTelefoneArray, function(item, i) {
            return (item.sequencialTelefone === sequencialTelefone);

        });

        clearFormTelefone();

        if (arr.length > 0) {
            var item = arr[0];
            $("#telefone").val(item.telefone);
            $("#sequencialTelefone").val(item.sequencialTelefone);
            $("#telefonePrincipal").val(item.telefonePrincipal);
            $("#descricaoTelefonePrincipal").val(item.descricaoTelefonePrincipal);
            $("#telefoneWhatsapp").val(item.TelefoneWhatsapp);
            $("#descricaoTelefoneWhatsapp").val(item.descricaoTelefoneWhatsapp);

            if (item.telefonePrincipal == 1) {
                $("#telefonePrincipal").prop('checked', true)
                $("#descricaoTelefonePrincipal").val("Sim")
            } else {
                $("#telefonePrincipal").prop('checked', false)
                $("#descricaoTelefonePrincipal").val("Não")
            }
            $("#telefoneWhatsapp").val(item.telefoneWhatsapp);

            if (item.telefoneWhatsapp == 1) {
                $("#telefoneWhatsapp").prop('checked', true)
                $("#descricaoTelefoneWhatsapp").val("Sim")
            } else {
                $("#telefoneWhatsapp").prop('checked', false)
                $("#descricaoTelefoneWhatsapp").val("Não")

            }
        }
    }

    function excluirTelefone() {
        var arrSequencial = [];
        $('#tableTelefone input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonTelefoneArray.length - 1; i >= 0; i--) {
                var obj = jsonTelefoneArray[i];
                if (jQuery.inArray(obj.sequencialTelefone, arrSequencial) > -1) {
                    jsonTelefoneArray.splice(i, 1);
                }
            }
            $("#jsonTelefone").val(JSON.stringify(jsonTelefoneArray));
            fillTableTelefone();
        } else
            smartAlert("Erro", "Selecione pelo menos 1 Telefone para excluir.", "error");
    }


    function validaEmail() {
        var existe = false;
        var achou = false;

        var email = $('#email').val();
        var sequencial = +$('#sequencialEmail').val();
        var emailValido = false;
        var emailPrincipalMarcado = 0;

        if ($("#emailPrincipal").is(':checked') === true) {
            emailPrincipalMarcado = 1;
        }
        if (email === '') {
            smartAlert("Erro", "Informe um email.", "error");
            return false;
        }

        for (i = jsonEmailArray.length - 1; i >= 0; i--) {
            if (emailPrincipalMarcado === 1) {
                if ((jsonEmailArray[i].emailPrincipal === 1) && (jsonEmailArray[i].sequencialEmail !== sequencial)) {
                    achou = true;
                    break;
                }
            }
            if ((jsonEmailArray[i].email === email) && (jsonEmailArray[i].sequencialEmail !== sequencial)) {
                existe = true;
                break;
            }
        }
        if ((achou === true) && (emailPrincipalMarcado === 1)) {
            smartAlert("Erro", "Já existe um email principal na lista.", "error");
            return false;
        }
        if (existe === true) {
            smartAlert("Erro", "email já cadastrado.", "error");
            return false;
        }
        return true;
    }

    function addEmail() {

        var item = $("#formEmail").toObject({
            mode: 'combine',
            skipEmpty: false,
            nodeCallback: processDataEmail
        });

        if (item["sequencialEmail"] === '') {
            if (jsonEmailArray.length === 0) {
                item["sequencialEmail"] = 1;
            } else {
                item["sequencialEmail"] = Math.max.apply(Math, jsonEmailArray.map(function(o) {
                    return o.sequencialEmail;
                })) + 1;
            }
            item["emailId"] = 0;
        } else {
            item["sequencialEmail"] = +item["sequencialEmail"];
        }

        var index = -1;
        $.each(jsonEmailArray, function(i, obj) {
            if (+$('#sequencialEmail').val() === obj.sequencialEmail) {
                index = i;
                return false;
            }
        });

        var emailPrincipal = $("#emailPrincipal").val();
        if (emailPrincipal == "true") {
            $("#emailPrincipal").prop('checked', false)
        }

        if (index >= 0)
            jsonEmailArray.splice(index, 1, item);
        else
            jsonEmailArray.push(item);
        console.log(jsonEmailArray)
        $("#jsonEmail").val(JSON.stringify(jsonEmailArray));
        fillTableEmail();
        clearFormEmail();

    }

    function clearFormEmail() {
        $("#email").val('');
        $("#sequencialEmail").val('');
        $("#emailPrincipal").val('');
        $("#descricaoEmailPrincipal").val('');

    }

    function fillTableEmail() {
        $("#tableEmail tbody").empty();

        for (var i = 0; i < jsonEmailArray.length; i++) {

            var row = $('<tr />');
            $("#tableEmail tbody").append(row);
            row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonEmailArray[i].sequencialEmail + '"><i></i></label></td>'));
            row.append($('<td class="text-center" onclick="carregaEmail(' + jsonEmailArray[i].sequencialEmail + ');">' + jsonEmailArray[i].email + '</td>'));
            row.append($('<td class="text-center" "">' + jsonEmailArray[i].descricaoEmailPrincipal + '</td>'));

        }
    }

    function processDataEmail(node) {
        var fieldId = node.getAttribute ? node.getAttribute('id') : '';
        var fieldName = node.getAttribute ? node.getAttribute('name') : '';


        if (fieldName !== '' && (fieldId === "emailPrincipal")) {
            var valorEmailPrincipal = 0;
            if ($("#emailPrincipal").is(':checked') === true) {
                valorEmailPrincipal = 1;
            }
            return {
                name: fieldName,
                value: valorEmailPrincipal
            };
        }

        if (fieldName !== '' && (fieldId === "descricaoEmailPrincipal")) {
            var valorDescricaoEmailPrincipal = "Não";
            if ($("#emailPrincipal").is(':checked') === true) {
                valorDescricaoEmailPrincipal = "Sim";
            }
            return {
                name: fieldName,
                value: valorDescricaoEmailPrincipal
            };
        }

        return false;
    }

    function carregaEmail(sequencialEmail) {
        var arr = jQuery.grep(jsonEmailArray, function(item, i) {
            return (item.sequencialEmail === sequencialEmail);

        });

        clearFormEmail();

        if (arr.length > 0) {
            var item = arr[0];
            $("#email").val(item.email);
            $("#sequencialEmail").val(item.sequencialEmail);
            $("#emailPrincipal").val(item.emailPrincipal);
            $("#descricaoEmailPrincipal").val(item.descricaoEmailPrincipal);

            if (item.emailPrincipal == 1) {
                $("#emailPrincipal").prop('checked', true)
                $("#descricaoEmailPrincipal").val("Sim")
            } else {
                $("#emailPrincipal").prop('checked', false)
                $("#descricaoEmailPrincipal").val("Não")
            }
        }
    }

    function excluirEmail() {
        var arrSequencial = [];
        $('#tableEmail input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonEmailArray.length - 1; i >= 0; i--) {
                var obj = jsonEmailArray[i];
                if (jQuery.inArray(obj.sequencialEmail, arrSequencial) > -1) {
                    jsonEmailArray.splice(i, 1);
                }
            }
            $("#jsonEmail").val(JSON.stringify(jsonEmailArray));
            fillTableEmail();
        } else
            smartAlert("Erro", "Selecione pelo menos 1 Email para excluir.", "error");
    }


    function enderecoCep() {
        // Se o campo CEP não estiver vazio
        if ($.trim($("#cep").val()) != "") {
            /*
                 Para conectar no serviço e executar o json, precisa usar uma função
                 getScript do jQuery, o getScript e o dataType: "jsonp" conseguir fazer o cross-domain, os outros
                 dataTypes não possibilitam esta interação entre domínios diferentes
                 Estou chamando a url do serviço passando o parâmetro "formato = javascript" e o CEP digitado no formulário
                 http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep= "+ $ (" #cep ") .val ()
            */
            $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep=" + $("#cep").val(),
                function() {
                    // o getScript dá um eval no script, então é só ler!
                    // Se o resultado for igual a 1
                    if (resultadoCEP["resultado"]) {
                        // troca o valor dos elementos
                        $("#logradouro").val(unescape(resultadoCEP["logradouro"]));
                        //$("#campoBoporto").val(unescape(resultadoCEP["b bloco "]));
                        $("#uf").val(unescape(resultadoCEP["uf"]));
                        $("#bairro").val(unescape(resultadoCEP["bairro"]));
                        //$("#enderecoCompleto").show("slow ");
                        $("#cidade").val(unescape(resultadoCEP["cidade"]));
                    } else {
                        alerta("Endereço não encontrado");
                        return false;
                    }
                });
        } else {
            alert('Antes, preencha o campo CEP!')
        }

    }


    function validaDependente() {
        var existe = false;
        var achou = false;

        var nomeDependente = $('#nomeDependente').val();
        var cpfDependente = $('#cpfDependente').val();
        var dataNascimento = $('#dataNascimento').val();
        var tipoDependente = $('#tipoDependente').val();
        var sequencial = +$('#sequencialDependente').val();

        if (nomeDependente === '') {
            smartAlert("Erro", "Informe o Nome do Dependente.", "error");
            return false;
        }
        if (cpfDependente === '') {
            smartAlert("Erro", "Informe o CPF do Dependente.", "error");
            return false;
        }
        if (dataNascimento === '') {
            smartAlert("Erro", "Informe a Data de Nascimento do Dependente.", "error");
            return false;
        }
        if (tipoDependente === '') {
            smartAlert("Erro", "Informe um Dependente.", "error");
            return false;
        }

        for (i = jsonDependenteArray.length - 1; i >= 0; i--) {
            if ((jsonDependenteArray[i].cpfDependente === cpfDependente) && (jsonDependenteArray[i].sequencialDependente !== sequencial)) {
                achou = true;
                break;
            }
        }
        if (cpfDependente === "___.___.___-__") {
            smartAlert("Erro", "Informe um CPF valido", "error")
            return false;
        }
        if (achou === true) {
            smartAlert("Erro", "Este CPF ja esta na lista.", "error");
            return false;
        }
        return true;
    }

    function addDependente() {

        var item = $("#formDependente").toObject({
            mode: 'combine',
            skipEmpty: false,
        });
        const descricaoDependente = $("#tipoDependente option:selected").text();

        if (item["sequencialDependente"] === '') {
            if (jsonDependenteArray.length === 0) {
                item["sequencialDependente"] = 1;
            } else {
                item["sequencialDependente"] = Math.max.apply(Math, jsonDependenteArray.map(function(o) {
                    return o.sequencialDependente;
                })) + 1;
            }
            item["dependenteId"] = 0;
        } else {
            item["sequencialDependente"] = +item["sequencialDependente"];
        }
        item["descricaoDependente"] = descricaoDependente;

        var index = -1;
        $.each(jsonDependenteArray, function(i, obj) {
            if (+$('#sequencialDependente').val() === obj.sequencialDependente) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonDependenteArray.splice(index, 1, item);
        else
            jsonDependenteArray.push(item);

        $("#jsonDependente").val(JSON.stringify(jsonDependenteArray));
        fillTableDependente();
        clearFormDependente();

    }

    function fillTableDependente() {
        $("#tableDependente tbody").empty();

        for (var i = 0; i < jsonDependenteArray.length; i++) {
            var row = $('<tr />');
            var descricaoDependente = $("#tipoDependente option[value ='" + jsonDependenteArray[i].tipoDependente + "']").text();

            $("#tableDependente tbody").append(row);
            row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonDependenteArray[i].sequencialDependente + '"><i></i></label></td>'));
            row.append($('<td class="text-center" onclick="carregaDependente(' + jsonDependenteArray[i].sequencialDependente + ');">' + jsonDependenteArray[i].nomeDependente + '</td>'));
            row.append($('<td class="text-center" "">' + jsonDependenteArray[i].cpfDependente + '</td>'));
            row.append($('<td class="text-center" "">' + jsonDependenteArray[i].dataNascimento + '</td>'));
            row.append($('<td class="text-center" "">' + descricaoDependente + '</td>'));

        }
    }

    function clearFormDependente() {
        $("#sequencialDependente").val('');
        $("#nomeDependente").val('');
        $("#cpfDependente").val('');
        $("#dataNascimento").val('');
        $("#tipoDependente").val('');

    }

    function carregaDependente(sequencialDependente) {
        var arr = jQuery.grep(jsonDependenteArray, function(item, i) {
            return (item.sequencialDependente === sequencialDependente);

        });

        clearFormDependente();

        if (arr.length > 0) {
            var item = arr[0];
            $("#sequencialDependente").val(item.sequencialDependente);
            $("#nomeDependente").val(item.nomeDependente);
            $("#cpfDependente").val(item.cpfDependente);
            $("#dataNascimento").val(item.dataNascimento);
            $("#tipoDependente").val(item.tipoDependente);

        }
    }

    function excluirDependente() {
        var arrSequencial = [];
        $('#tableDependente input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonDependenteArray.length - 1; i >= 0; i--) {
                var obj = jsonDependenteArray[i];
                if (jQuery.inArray(obj.sequencialDependente, arrSequencial) > -1) {
                    jsonDependenteArray.splice(i, 1);
                }
            }
            $("#jsonDependente").val(JSON.stringify(jsonDependenteArray));
            fillTableDependente();
        } else
            smartAlert("Erro", "Selecione pelo menos 1 Dependente para excluir.", "error");
    }
</script>