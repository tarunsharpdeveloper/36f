<!--<div class="col-sm-8 " id="empDi"  >-->
<?php
$emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'".$lastQuery);
?>
<select class=" form-control multi-select" multiple name="selectEmp" id="selectEmp" style="min-height:  100px;">
<!--<select class=" form-control chosen-select"  name="selectEmp" id="selectEmp">-->
    <option selected value="*">All Employee</option>
    <?php foreach ($emp as $empval) {
        ?>

        <option value="<?= $empval['id'] ?>"  ><?php echo $empval['fname'] . ' ' . $empval['lname']; ?></option>
        <?php
    }
    ?>

</select>      
<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/multi-select/multiselect.css">

<script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/multi-select/multiselect.js"></script>
<!--</div>-->