<div class="menu-content">
    <ul>
        <li><strong>Danh sách bảng chấm công</strong></li>
        <?php foreach ($files as $fileName) : ?>
            <div class="select-nemu">
                <label><?= $fileName ?></label>
                <input type="hidden"  value="<?= $fileName ?>">
            </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<script>
    $('.select-nemu').on('click', function() {
        $.ajax({
            url: './index.php?controller=TinhCong&action=menuReadExcel', // <-- point to server-side PHP script 
            dataType: 'text', // <-- what to expect back from the PHP script, if anything
            data: { 'filePath' : $(this).find('input').val()},
            type: 'post',
            success: function(php_script_response) {
                $('#content').html(php_script_response);
                $('#menu_bar').animate({
                width: 'hide'
            });
            }
        });
    });
</script>