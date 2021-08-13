<?php
$physical_attributes = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'physical_attributes');
$physical_attributes_data = json_decode($physical_attributes, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_physical_attributes">
        <div class="card-inner-title-wrapper pt-0">
            <div class="d-flex justify-content-between mb-2">
                <h3 class="card-inner-title">
                    <?php echo translate('physical_attributes') ?>
                </h3>
                <div>
                    <button type="button" id="unhide_physical_attributes" <?php if ($privacy_status_data[0]['physical_attributes'] == 'yes') { ?> style="display: none" <?php } ?> class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="unhide_section('physical_attributes')">
                        <i class="fa fa-unlock"></i> <?= translate('show') ?>
                    </button>
                    <button type="button" id="hide_physical_attributes" <?php if ($privacy_status_data[0]['physical_attributes'] == 'no') { ?> style="display: none" <?php } ?> class="btn btn-dark btn-sm btn-icon-only btn-shadow mb-1" onclick="hide_section('physical_attributes')">
                        <i class="fa fa-lock"></i> <?= translate('hide') ?>
                    </button>
                    <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('physical_attributes')">
                        <i class="ion-edit"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="table-full-width">
            <div class="profile-grid container-fluid profile-list-group mb-3">
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('height') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $get_member[0]->height . " " . translate('feet') ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('weight') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $physical_attributes_data[0]['weight'] ?>
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('eye_color') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $physical_attributes_data[0]['eye_color'] ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('hair_color') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $physical_attributes_data[0]['hair_color'] ?>
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('complexion') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $physical_attributes_data[0]['complexion'] ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('blood_group') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $physical_attributes_data[0]['blood_group'] ?>
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('body_type') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $physical_attributes_data[0]['body_type'] ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('body_art') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $physical_attributes_data[0]['body_art'] ?>
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('any_disability') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $physical_attributes_data[0]['any_disability'] ?>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div id="edit_physical_attributes" style="display: none">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('physical_attributes') ?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('physical_attributes')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('physical_attributes')"><i class="ion-close"></i></button>
            </div>
        </div>

        <div class='clearfix'></div>
        <form id="form_physical_attributes" class="form-default" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="height" class="text-uppercase c-gray-light"><?php echo translate('height') ?></label>
                        <div class="input-group">
                            <input type="text" class="form-control no-resize height_mask" aria-describedby="text-feet" name="height" value="<?= $get_member[0]->height ?>">
                            <div class="input-group-append">
                                <span class="input-group-text small ml-2" id="text-feet"><?= translate('feet') ?></span>
                            </div>
                        </div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="weight" class="text-uppercase c-gray-light"><?php echo translate('weight') ?></label>
                        <input type="text" class="form-control no-resize" name="weight" value="<?= $physical_attributes_data[0]['weight'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="eye_color" class="text-uppercase c-gray-light"><?php echo translate('eye_color') ?></label>
                        <input type="text" class="form-control no-resize" name="eye_color" value="<?= $physical_attributes_data[0]['eye_color'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="hair_color" class="text-uppercase c-gray-light"><?php echo translate('hair_color') ?></label>
                        <input type="text" class="form-control no-resize" name="hair_color" value="<?= $physical_attributes_data[0]['hair_color'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="complexion" class="text-uppercase c-gray-light"><?php echo translate('complexion') ?></label>
                        <input type="text" class="form-control no-resize" name="complexion" value="<?= $physical_attributes_data[0]['complexion'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="blood_group" class="text-uppercase c-gray-light"><?php echo translate('blood_group') ?></label>
                        <input type="text" class="form-control no-resize" name="blood_group" value="<?= $physical_attributes_data[0]['blood_group'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="body_type" class="text-uppercase c-gray-light"><?php echo translate('body_type') ?></label>
                        <input type="text" class="form-control no-resize" name="body_type" value="<?= $physical_attributes_data[0]['body_type'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="body_art" class="text-uppercase c-gray-light"><?php echo translate('body_art') ?></label>
                        <input type="text" class="form-control no-resize" name="body_art" value="<?= $physical_attributes_data[0]['body_art'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="any_disability" class="text-uppercase c-gray-light"><?php echo translate('any_disability') ?></label>
                        <input type="text" class="form-control no-resize" name="any_disability" value="<?= $physical_attributes_data[0]['any_disability'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="<?= base_url() ?>template/front/js/jquery.inputmask.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $(".height_mask").inputmask({
            mask: "9.99",
            greedy: false,
            definitions: {
                '*': {
                    validator: "[0-9]"
                }
            }
        });
    });
</script>