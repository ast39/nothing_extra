<h4 class="mt-3 pl-3"><?= $this->langLine('manage_robots_head') ?></h4>
<hr />

<?php if ($this->buffer->bad_log): ?>
    <div class="mt-3 p-2 bg-danger text-white text-center rounded"><?= $this->buffer->bad_log ?></div>
<?php else: ?>
    <form role="form" method="post">
        <label for="robots" class="pl-3"><?= $this->langLine('manage_edit') ?> robots.txt</label>
        <textarea id="robots" name="robots" class="form-control" rows="16"><?= $this->buffer->data ?></textarea>
        <div class="form-group mt-3">
            <button type="submit" id="save" name="save" class="btn btn-success"><?= $this->langLine('manage_save') ?></button>
            <button type="button" id="clear" class="btn btn-danger"><?= $this->langLine('manage_clean') ?></button>
        </div>
    </form>
<?php endif; ?>

<?php if ($this->buffer->good_log): ?>
    <div class="mt-3 p-2 bg-success text-white text-center rounded"><?= $this->buffer->good_log ?></div>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function() {

        var oldText = $('#robots').val();

        $('#clear').click(function () {
            $('#robots').html('');
        });
    });
</script>