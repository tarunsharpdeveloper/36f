  <table class="table table-striped responsive no-wrap">
                            <tr>
                                <th style="float:left;"><input type="checkbox" class="selectall" id="all"></th>
                                <th style="float:left;width:21%;">Name & Access</th>
                                <th id="tbl_1" class="tb-none tb-th">Main Location</th>
                                <!--<th id="tbl_2" class="tb-none tb-th">Status</th>-->
                                <th id="tbl_3" class="tb-none tb-th" style="width:14%;">Email Address</th>
                                <th id="tbl_4" class="tb-none tb-th">Mobile</th>
                                <th id="tbl_5" class="tb-none tb-th">Stress Profile</th>
                                <!--<th id="tbl_6" class="tb-none tb-th">Training</th>-->
                                <th id="tbl_7" class="tb-none tb-th">Pay Rates</th>
                                <!--<th id="tbl_8" class="tb-none tb-th">Time Sheet Export Code</th>-->
                                <th style="float:right;width:20%;text-align: center;">Actions</th>
                            </tr>
                            <?php if (empty($PostResult)) { ?>
                                <tr><td colspan="11"><?php echo "No Record Found!!!!!"; ?></td></tr>
                                <?php
                            } else {
                                foreach ($PostResult as $PostRow) {
                                    ?>
                                    <tr>

                                        <td style="float:left;"><input type="checkbox" name="nchild[]" class="child" value="<?php echo $PostRow['id']; ?>"></td>
                                        <td style="float:left;width: 21%">
                                            <div class="row">
                                                <div class="col-xs-3 col-md-3 on-break-tab"><?php echo substr(ucfirst($PostRow['fname']), 0, 1) . '' . substr(ucfirst($PostRow['lname']), 0, 1) ?></div>
                                                <div class="col-xs-9 col-md-9">
                                                    <div><b style="color: #1b92da;"><?php echo ucfirst($PostRow['fname']) . ' ' . ucfirst($PostRow['lname']) ?></b></div>
                                                    <div><a class="m-team-supportingLink" href="#" title="" style="font-size: 12px"><?php
                                                            if ($PostRow['access_level'] == "Location_Manager") {
                                                                $access_level = "Location Manager";
                                                            } else if ($PostRow['access_level'] == "System_Administrator") {
                                                                $access_level = "System Administrator";
                                                            } else {

                                                                $access_level = $PostRow['access_level'];
                                                            }
                                                            echo $access_level;
                                                            ?></a></div>
                                                </div>
                                            </div> 
                                        </td>
                                        <td class="tb-none tbl_sub_1 tb-sub" ><?php echo $PostRow['work_at']; ?></td>
                                        <!--<td class="tb-none tbl_sub_2 tb-sub"><?php echo $PostRow['access_level']; ?></td>-->
                                        <td class="tb-none tbl_sub_3 tb-sub" style="width: 14%"><?php echo $PostRow['email']; ?></td>
                                        <td class="tb-none tbl_sub_4 tb-sub"><?php echo $PostRow['mobile']; ?></td>
                                        <td class="tb-none tbl_sub_5 tb-sub"><?php echo $PostRow['stress_profile']; ?></td>
                                        <!--<td class="tb-none tbl_sub_6 tb-sub"><?php echo $PostRow['training']; ?></td>-->
                                        <td class="tb-none tbl_sub_7 tb-sub"><?php echo $PostRow['pay_rates']; ?></td>
                                        <!--<td class="tb-none tbl_sub_8"><?php echo $PostRow['time_s_e_code']; ?></td>-->
                                        <td style="float: right;width: 20%">
                                            <a class="btn btn-default" type="button" data-toggle="collapse" data-target="#" aria-expanded="true" >View</a>
                                    <li class="dropdown">
                                        <a href="#" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false">Options<b class="caret"></b></a>
                                        <ul class="dropdown-menu" style="display: none;">
                                            <li><a href="#" onclick="EditPeople(<?= $PostRow['id'] ?>)">Edit</a></li>
                                            <li><a href="#" onclick="discardPeople(<?= $PostRow['id'] ?>)">Discard</a></li>
                                            <li><a href="#">Invite</a></li>
                                        </ul>
                                    </li>
                                    </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>