
<?php
$location = "-1";
//$company_id = "429";


$company_locations = q(" select * from  tb_location where company_id = '{$company_id}' ORDER BY id  DESC ");

$db = Db::__d();
$query = "select * from  tb_team where company_id = '{$company_id}' ";
//d($query);
$company_teams = $db->format_data($db->query($query), 'id');
////d($company_teams);die;
//
//if ($location != '-1') {
//    $team = q("select * from tb_team where location_id='{$location}'");
//    $emp = q("select * from tb_employee  where location='{$location}'");
//} else {
//    $company = "275";
//    $team = q("select * from tb_team where company_id='{$company}'");
//    $emp = q("select * from tb_employee where team_id in (SELECT id FROM `tb_team` where company_id = '{$company}')");
//}
//$team_wise_emp = [];
//foreach ($emp as $each_emp) {
//    $team_wise_emp[$each_emp['team_id']][] = $each_emp;
//}
//d($team_wise_emp);die;
//$jsInclude = "temp_summary.js.php";
?>
<div class="row" style="padding: 0px 10px;">
    <div class="col-lg-8"></div> 
    <div class="col-lg-4">
        <div class="form-group">
            <div class="input-group">
                <input type="text" value="" name="SearchAll" id="SearchAll" class="form-control"  placeholder="Search"/>    

            </div> 
        </div> 
    </div> 
</div>
<div class="" id="accordion" style="margin: 0px 0px;">
    <?php
    $accordion_cnt = 0;
    $remotes = array();
    $remotes['id'] = "-1";
    $remotes['name'] = "Remote";
    $remotes['company_id'] = $company_id;
    $company_locations[count($company_locations) + 1] = $remotes;
//    d($company_locations);
//    die;


    foreach ($company_locations as $each_location):
        ?>
        <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist" id="LOC_<?= $each_location['id'] ?>">
            <h3 class="ui-accordion-header ui-state-default ui-accordion-icons ui-corner-all" role="tab" id="ui-id-1" aria-controls="ui-id-2" aria-selected="false" aria-expanded="false" tabindex="-1"><?= $each_location['name']; ?></h3>
            <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" style="display: none; height: auto" id="ui-id-2" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="true">
                <?php
                $team = q("select * from tb_team where  company_id='{$each_location['company_id']}' ORDER BY id ASC");
                $accordion_cnt = 0;
                $idcount = 0;
                $isNotValue = 0;
                foreach ($team as $each_team):
                    ?>
                    <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist" id="Team_<?= $each_location['id'] ?>_<?= $each_team['id'] ?>">
                        <h3 class="ui-accordion-header ui-state-default ui-accordion-icons ui-corner-all" role="tab" id="ui-id-1" aria-controls="ui-id-2" aria-selected="false" aria-expanded="false" tabindex="-1"><?= $each_team['name']; ?></h3>
                        <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" style="display: none;" id="ui-id-2" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="true">
                            <?php
                            $emp = q("select * from tb_employee  where location='{$each_location['id']}' and team_id='{$each_team['id']}'");

                            if (count($emp) > 0):
                                ?>
                                <table  style="width:100%;" class="table summaryTable ">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Title</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($emp as $each_emp):
//                            if ($each_emp['location'] > 0) {
                                            ?>
                                            <tr>
                                                <td style="width: 25%"><?= $each_emp['fname'] . ' ' . $each_emp['lname']; ?></td>
                                                <td style="width: 30%"><?= ($each_emp['email'] == '') ? "-" : $each_emp['email']; ?></td>
                                                <td style="width: 15%"><?=
                                                    ($each_emp['mobile'] == '') ? "-" : $each_emp['mobile'];
                                                    ?></td>
                                                <td style="width: 15%"><?= ($each_emp['access_level'] == '') ? "-" : $each_emp['access_level']; ?></td>
                                                <td style="width: 15%">
                                                    <span><i style="padding-top: 9px;" class="btn btn-primary fa fa-edit empEdit TeamSummary"  data-id="<?php echo $each_emp['id']; ?>" onclick="editEmployee('<?php echo $each_emp['id']; ?>', 'team')"></i></span>
                                                    <span><i style="padding-top: 9px;" class="btn btn-danger remove fa fa-trash-o empDelete"  data-id="<?php echo $each_emp['id']; ?>" onclick="removeEmp(<?php echo $each_emp['id']; ?>, '<?= $each_emp['fname'] . ' ' . $each_emp['lname']; ?>')"></i></span>
                                                </td>

                                            </tr>
                                            <?php
//                            }
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <!--No record found for.-->
                                <?php
                                $isNotValue++;
                                if (count($team) == $isNotValue) {
                                    ?>
                                    <script>
                                        var loc =<?php echo $each_location['id'] ?>;
                                        var team =<?php echo $each_team['id'] ?>;
                                        $("#LOC_" + loc).remove();
                                    </script>
                                    <?php
                                } else {
                                    ?>
                                    <script>
                                        var loc =<?php echo $each_location['id'] ?>;
                                        var team =<?php echo $each_team['id'] ?>;
                                        $("#Team_" + loc + "_" + team).remove();
                                    </script>
                                    <?php
                                }
                            endif;
                            ?>        
                        </div>
                    </div>

                    <?php
                    $idcount++;
                endforeach;
                ?>   
            </div>

        </div>
    <?php endforeach; ?>    
</div>
<script>
    $(document).ready(function () {
        $('.accordion').accordion({
            collapsible: true
        });
        $('.accordion .ui-accordion-content').css('height', 'auto');
        $(".summaryTable").each(function () {
//            var id = $(this).attr("id");
            $(this).dataTable();
        });
        $("#SearchAll").keyup(function () {
            // Filter on the column (the index) of this element
            $(".summaryTable").DataTable().search(this.value).draw();
//            var search = this.value;
//            $(".summaryTable").each(function () {
//                var id = $(this).attr("id");
//
////            oTable0.fnFilterAll(this.value);
//                $(".dataTables_filter .form-control").val($(this).val()).fnFilter();
////            i++;
//            });

//            oTable0.fnFilterAll(this.value);



        });
    });
</script>
<script>
    $.fn.dataTableExt.oApi.fnFilterAll = function (oSettings, sInput, iColumn, bRegex, bSmart) {
        var settings = $.fn.dataTableSettings;

        for (var i = 0; i < settings.length; i++) {
            settings[i].oInstance.fnFilter(sInput, iColumn, bRegex, bSmart);
        }
    };



//    $(document).ready(function () {
//        $('#table2').dataTable({
//            "bPaginate": false,
//
//        });
//        var oTable1 = $("#table1").dataTable();
//
//        $("#Search_All").keyup(function () {
//            // Filter on the column (the index) of this element
//            oTable1.fnFilterAll(this.value);
//        });
//    });
</script>
<style>
    .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {
        /*background: #00a792 none repeat scroll 0 0;*/
        /*background: #9797B8 none repeat scroll 0 0;*/
        /*background: #00bcb4 none repeat scroll 0 0;*/
        background: #02e2c6 none repeat scroll 0 0;
        border: 1px solid #003eff;
        color: #fff;
        font-weight: normal;
    }
    /* Primary background color */


    .ui-accordion-header.ui-accordion-header-active,
    #nav-toggle.collapsed span,
    #nav-toggle span:before,
    #nav-toggle span:after {
        color: #fff;
        /*background: #00bcb4;*/
        /*background: #9797B7;*/
    }
</style>
