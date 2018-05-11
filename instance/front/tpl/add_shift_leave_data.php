<h3>Leave date arrives in your shift date </h3>
<br>
<?php foreach ($leaveData as $value) { ?>
<label>
<input type="checkbox" class="dateCon" name='chk[]' value="<?= $value['date']?>"><?= date('Y M,d', strtotime($value['date'])). " <b>".$value['reason']."</b>";?>
</label>
<br/>
<?php } ?> 

<a href="javascript:void(0);" onclick="$('.dateCon').prop('checked','checked')">Check All</a>&nbsp;<a href="javascript:void(0);" onclick="$('.dateCon').prop('checked','')">Clear Check </a>
