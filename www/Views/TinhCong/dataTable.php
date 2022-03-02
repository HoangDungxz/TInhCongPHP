<div class="centered" >
    <table class="table table-striped custab">

        <tr>
            <?php foreach ($datas[0] as $value) : ?>
                <th class="text-nowrap"><?= $value; ?></th>
            <?php endforeach; ?>
        </tr>

        <?php unset($datas[0]); ?>

        <?php foreach ($datas as $data) : ?>
            <tr>
                <?php foreach ($data as $value) : ?>

                    <td class="text-nowrap"><?= $value; ?></td>

                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<script>
    $('#title').html('<?= ucfirst($file_name) ?>' );
    $('#title_value').val('<?= ($file_fullname) ?>' );
</script>