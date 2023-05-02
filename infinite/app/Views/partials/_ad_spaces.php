<?php if (!empty($adSpace)):
    $adCodes = getAdCodesClient($adSpaces, $adSpace);
    if (!empty($adCodes)):
        if ($adSpace == "sidebar_top" || $adSpace == "sidebar_bottom"):
            if (trim($adCodes->ad_code_300 ?? '') != ''):?>
                <div class="col-sm-12 col-xs-12 bn-lg-sidebar">
                    <div class="row">
                        <?= trim($adCodes->ad_code_300 ?? ''); ?>
                    </div>
                </div>
            <?php endif;
        else:
            if (trim($adCodes->ad_code_728 ?? '') != ''):?>
                <section class="col-sm-12 bn-lg bn-list p-t-0">
                    <div class="row">
                        <?= trim($adCodes->ad_code_728 ?? ''); ?>
                    </div>
                </section>
            <?php endif;

            if (trim($adCodes->ad_code_468 ?? '') != ''): ?>
                <section class="col-sm-12 bn-md bn-list p-t-0">
                    <div class="row">
                        <?= trim($adCodes->ad_code_468 ?? ''); ?>
                    </div>
                </section>
            <?php endif;
        endif;
        if (trim($adCodes->ad_code_234 ?? '') != ''): ?>
            <section class="col-sm-12 bn-sm bn-list p-t-0">
                <div class="row">
                    <?= trim($adCodes->ad_code_234 ?? ''); ?>
                </div>
            </section>
        <?php endif;
    endif;
endif; ?>