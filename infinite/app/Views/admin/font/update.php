<div class="row">
    <div class="col-lg-5 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans("update_font"); ?></h3>
            </div>
            <form action="<?= base_url('AdminController/editFontPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $font->id; ?>">
                <div class="box-body">
                    <?php view('admin/includes/_messages'); ?>
                    <div class="form-group">
                        <label><?= trans("name"); ?></label>
                        <input type="text" class="form-control" name="font_name" value="<?= esc($font->font_name); ?>" placeholder="<?= trans("name"); ?>" maxlength="200" required>
                        <small>(E.g: Open Sans)</small>
                    </div>

                    <?php if ($font->is_default != 1): ?>
                        <div class="form-group">
                            <label class="control-label"><?= trans("url"); ?> </label>
                            <textarea name="font_url" class="form-control" placeholder="<?= trans("url"); ?>" required><?= $font->font_url; ?></textarea>
                            <small>(E.g: <?= esc('<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">'); ?>)</small>
                        </div>
                    <?php else: ?>
                        <input type="hidden" name="font_url" value="">
                    <?php endif; ?>

                    <div class="form-group">
                        <label class="control-label"><?= trans("font_family"); ?> </label>
                        <input type="text" class="form-control" name="font_family" value="<?= esc($font->font_family); ?>" placeholder="<?= trans("font_family"); ?>" maxlength="500"required>
                        <small>(E.g: font-family: "Open Sans", Helvetica, sans-serif)</small>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans("save_changes"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>