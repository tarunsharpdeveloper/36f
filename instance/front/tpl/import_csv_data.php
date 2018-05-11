<div class="col-lg-10 col-lg-offset-1">
    <div class="panel">
        <div class="panel-body">
            <div style="text-align: center"><h1>CSV DATA</h1></div>
            <table style="margin: auto">
                <?php
                if (!empty($file_content)) {
                    foreach ($file_content as $value) {
                        ?>
                        <tr>
                            <td style="border: 1px solid #dadada;padding: 10px"><?php echo $value ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>