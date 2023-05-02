<div class="row">
    <div class="col-sm-12">
        <?= view('admin/includes/_messages'); ?>
    </div>
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans('ad_spaces'); ?></h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label><?= trans('select_ad_spaces'); ?></label>
                    <select class="form-control custom-select" name="parent_id" onchange="window.location.href = '<?= adminUrl(); ?>'+'/ad-spaces?ad_space='+this.value;">
                        <?php foreach ($arrayAdSpaces as $key => $value): ?>
                            <option value="<?= $key; ?>" <?= $key == $adCodes->ad_space ? 'selected' : ''; ?>><?= $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <form action="<?= base_url('AdminController/adSpacesPost'); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="ad_space" value="<?= $adCodes->ad_space; ?>">
                    <?php if ($adCodes->ad_space == "sidebar_top" || $adCodes->ad_space == "sidebar_bottom"): ?>
                        <div class="form-group">
                            <?php if (!empty($arrayAdSpaces[$adCodes->ad_space])): ?>
                                <h4><?= trans($adCodes->ad_space . "_ad_space"); ?></h4>
                            <?php endif; ?>

                            <p><label class="control-label label bg-red">300x250 <?= trans('banner'); ?></label></p>
                            <div class="row row-ad-space">
                                <div class="col-sm-6">
                                    <label class="control-label"><?= trans('paste_ad_code'); ?></label>
                                    <textarea class="form-control text-area-adspace" name="ad_code_300" placeholder="<?= trans('paste_ad_code'); ?>"><?= $adCodes->ad_code_300; ?></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label"><?= trans('upload_your_banner'); ?></label>
                                    <input type="text" class="form-control" name="url_ad_code_300" placeholder="<?= trans('paste_ad_url'); ?>">
                                    <div class="row m-t-15">
                                        <div class="col-sm-12">
                                            <a class='btn bg-olive btn-sm btn-file-upload'>
                                                <?= trans('select_image'); ?>
                                                <input type="file" name="file_ad_code_300" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info2').html($(this).val());">
                                            </a>
                                        </div>
                                    </div>
                                    <span class='label label-info' id="upload-file-info2"></span>
                                </div>
                            </div>

                            <p><label class="control-label label bg-red">234x60 <?= trans('banner'); ?></label></p>
                            <div class="row row-ad-space">
                                <div class="col-sm-6">
                                    <label class="control-label"><?= trans('paste_ad_code'); ?></label>
                                    <textarea class="form-control text-area-adspace" name="ad_code_234" placeholder="<?= trans('paste_ad_code'); ?>"><?= $adCodes->ad_code_234; ?></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label"><?= trans('upload_your_banner'); ?></label>
                                    <input type="text" class="form-control" name="url_ad_code_234" placeholder="<?= trans('paste_ad_url'); ?>">
                                    <div class="row m-t-15">
                                        <div class="col-sm-12">
                                            <a class='btn bg-olive btn-sm btn-file-upload'>
                                                <?= trans('select_image'); ?>
                                                <input type="file" name="file_ad_code_234" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info3').html($(this).val());">
                                            </a>
                                        </div>
                                    </div>
                                    <span class='label label-info' id="upload-file-info3"></span>
                                </div>
                            </div>
                            <div class="row row-ad-space row-button">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="form-group">
                            <?php if (!empty($arrayAdSpaces[$adCodes->ad_space])): ?>
                                <h4><?= trans($adCodes->ad_space . "_ad_space"); ?></h4>
                            <?php endif; ?>

                            <p><label class="control-label label bg-red">728x90 <?= trans('banner'); ?></label></p>
                            <div class="row row-ad-space">
                                <div class="col-sm-6">
                                    <label class="control-label"><?= trans('paste_ad_code'); ?></label>
                                    <textarea class="form-control text-area-adspace" name="ad_code_728" placeholder="<?= trans('paste_ad_code'); ?>"><?= $adCodes->ad_code_728; ?></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label"><?= trans('upload_your_banner'); ?></label>
                                    <input type="text" class="form-control" name="url_ad_code_728" placeholder="<?= trans('paste_ad_url'); ?>">
                                    <div class="row m-t-15">
                                        <div class="col-sm-12">
                                            <a class='btn bg-olive btn-sm btn-file-upload'>
                                                <?= trans('select_image'); ?>
                                                <input type="file" name="file_ad_code_728" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info1').html($(this).val());">
                                            </a>
                                        </div>
                                    </div>
                                    <span class='label label-info' id="upload-file-info1"></span>
                                </div>
                            </div>

                            <p><label class="control-label label bg-red">468x60 <?= trans('banner'); ?></label></p>
                            <div class="row row-ad-space">
                                <div class="col-sm-6">
                                    <label class="control-label"><?= trans('paste_ad_code'); ?></label>
                                    <textarea class="form-control text-area-adspace" name="ad_code_468" placeholder="<?= trans('paste_ad_code'); ?>"><?= $adCodes->ad_code_468; ?></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label"><?= trans('upload_your_banner'); ?></label>
                                    <input type="text" class="form-control" name="url_ad_code_468" placeholder="<?= trans('paste_ad_url'); ?>">
                                    <div class="row m-t-15">
                                        <div class="col-sm-12">
                                            <a class='btn bg-olive btn-sm btn-file-upload'>
                                                <?= trans('select_image'); ?>
                                                <input type="file" name="file_ad_code_468" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info2').html($(this).val());">
                                            </a>
                                        </div>
                                    </div>
                                    <span class='label label-info' id="upload-file-info2"></span>
                                </div>
                            </div>

                            <p><label class="control-label label bg-red">234x60 <?= trans('banner'); ?></label></p>
                            <div class="row row-ad-space">
                                <div class="col-sm-6">
                                    <label class="control-label"><?= trans('paste_ad_code'); ?></label>
                                    <textarea class="form-control text-area-adspace" name="ad_code_234" placeholder="<?= trans('paste_ad_code'); ?>"><?= $adCodes->ad_code_234; ?></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label"><?= trans('upload_your_banner'); ?></label>
                                    <input type="text" class="form-control" name="url_ad_code_234" placeholder="<?= trans('paste_ad_url'); ?>">
                                    <div class="row m-t-15">
                                        <div class="col-sm-12">
                                            <a class='btn bg-olive btn-sm btn-file-upload'>
                                                <?= trans('select_image'); ?>
                                                <input type="file" name="file_ad_code_234" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info3').html($(this).val());">
                                            </a>
                                        </div>
                                    </div>
                                    <span class='label label-info' id="upload-file-info3"></span>
                                </div>
                            </div>
                            <div class="row row-ad-space row-button">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans('google_adsense_code'); ?></h3>
            </div>
            <form action="<?= base_url('AdminController/googleAdsenseCodePost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <textarea name="google_adsense_code" class="form-control" placeholder="<?= trans('google_adsense_code'); ?>" style="min-height: 140px;"><?= $generalSettings->google_adsense_code; ?></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    h4 {
        color: #0d6aad;
        text-align: left;
        font-weight: 600;
        margin-bottom: 15px;
        margin-top: 30px;
    }

    .row-ad-space {
        padding: 15px 0;
        background-color: #f7f7f7;
        margin-bottom: 20px;
    }

    .row-button {
        background-color: transparent !important;
        min-height: 60px;
    }

    textarea {
        resize: vertical;
        min-height: 80px;
    }
</style>

<?php if ($activeLang->text_direction == "rtl"): ?>
    <style>
        h4 {
            text-align: right;
        }
    </style>
<?php endif; ?>
