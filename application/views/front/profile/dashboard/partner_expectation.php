<?php
$partner_expectation = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'partner_expectation');
$partner_expectation_data = json_decode($partner_expectation, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_partner_expectation">
        <div class="card-inner-title-wrapper pt-0">

            <div class="d-flex justify-content-between mb-2">
                <h3 class="card-inner-title ">
                    <?php echo translate('partner_expectation') ?>
                </h3>
                <div>
                    <button type="button" id="unhide_partner_expectation" <?php if ($privacy_status_data[0]['partner_expectation'] == 'yes') { ?> style="display: none" <?php } ?> class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="unhide_section('partner_expectation')">
                        <i class="fa fa-unlock"></i> <?= translate('show') ?>
                    </button>
                    <button type="button" id="hide_partner_expectation" <?php if ($privacy_status_data[0]['partner_expectation'] == 'no') { ?> style="display: none" <?php } ?> class="btn btn-dark btn-sm btn-icon-only btn-shadow mb-1" onclick="hide_section('partner_expectation')">
                        <i class="fa fa-lock"></i> <?= translate('hide') ?>
                    </button>
                    <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('partner_expectation')">
                        <i class="ion-edit"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="table-full-width">
            <div class="profile-grid container-fluid profile-list-group mb-3">

                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('general_requirement') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $partner_expectation_data[0]['general_requirement'] ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('age') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $partner_expectation_data[0]['partner_age'] ?>
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('height') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $partner_expectation_data[0]['partner_height'] ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('weight') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $partner_expectation_data[0]['partner_weight'] ?>
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('marital_status') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $this->Crud_model->get_type_name_by_id('marital_status', $partner_expectation_data[0]['partner_marital_status']) ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('with_children_acceptables') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $this->Crud_model->get_type_name_by_id('decision', $partner_expectation_data[0]['with_children_acceptables']) ?>
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('country_of_residence') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_country_of_residence']) ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('religion') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $this->Crud_model->get_type_name_by_id('religion', $partner_expectation_data[0]['partner_religion']) ?>
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('caste_/_sect') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?php
                        if ($partner_expectation_data[0]['partner_caste'] != null) {
                            echo $this->db->get_where('caste', array('caste_id' => $partner_expectation_data[0]['partner_caste']))->row()->caste_name;
                        }
                        ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('sub_caste') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?php
                        if ($partner_expectation_data[0]['partner_sub_caste'] != null) {
                            $this->db->get_where('sub_caste', array('sub_caste_id' => $partner_expectation_data[0]['partner_sub_caste']))->row()->sub_caste_name;
                        }
                        ?>
                    </div>

                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('education') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $partner_expectation_data[0]['partner_education'] ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('profession') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $partner_expectation_data[0]['partner_profession'] ?>
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('drinking_habits') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $this->Crud_model->get_type_name_by_id('decision', $partner_expectation_data[0]['partner_drinking_habits']) ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('smoking_habits') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $this->Crud_model->get_type_name_by_id('decision', $partner_expectation_data[0]['partner_smoking_habits']) ?>
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('diet') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $partner_expectation_data[0]['partner_diet'] ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('body_type') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $partner_expectation_data[0]['partner_body_type'] ?>
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('personal_value') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $partner_expectation_data[0]['partner_personal_value'] ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('manglik') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $this->Crud_model->get_type_name_by_id('decision', $partner_expectation_data[0]['manglik']) ?>
                        <!-- <?php $manglik = $partner_expectation_data[0]['manglik'];

                                if ($manglik == 1) {
                                    echo "Yes";
                                } elseif ($manglik == 2) {
                                    echo "No";
                                } elseif ($manglik == 3) {
                                    echo "I don't know";
                                } else {
                                    echo " ";
                                }
                                ?> -->
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('any_disability') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $partner_expectation_data[0]['partner_any_disability'] ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('mother_tongue') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $this->Crud_model->get_type_name_by_id('language', $partner_expectation_data[0]['partner_mother_tongue']) ?>
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('family_value') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $partner_expectation_data[0]['partner_family_value'] ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('prefered_country') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['prefered_country']) ?>
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('prefered_state') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $this->Crud_model->get_type_name_by_id('state', $partner_expectation_data[0]['prefered_state']) ?>
                    </div>
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('prefered_status') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $partner_expectation_data[0]['prefered_status'] ?>
                    </div>
                </div>
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <span class="td-label"><?php echo translate('complexion') ?></span>
                    </div>
                    <div class="col-6 col-lg-3">
                        <?= $partner_expectation_data[0]['partner_complexion'] ?>
                    </div>
                    <div class="col-6 col-lg-3"></div>
                    <div class="col-6 col-lg-3"></div>
                </div>

            </div>
        </div>

    </div>

    <div id="edit_partner_expectation" style="display: none;">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('partner_expectation') ?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('partner_expectation')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('partner_expectation')"><i class="ion-close"></i></button>
            </div>
        </div>

        <div class='clearfix'></div>
        <form id="form_partner_expectation" class="form-default" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="general_requirement" class="text-uppercase c-gray-light"><?php echo translate('general_requirement') ?></label>
                        <input type="text" class="form-control no-resize" name="general_requirement" value="<?= $partner_expectation_data[0]['general_requirement'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_age" class="text-uppercase c-gray-light"><?php echo translate('age') ?></label>
                        <input type="text" class="form-control no-resize" name="partner_age" value="<?= $partner_expectation_data[0]['partner_age'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_height" class="text-uppercase c-gray-light"><?php echo translate('height') ?></label>
                        <input type="text" class="form-control no-resize" name="partner_height" value="<?= $partner_expectation_data[0]['partner_height'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_weight" class="text-uppercase c-gray-light"><?php echo translate('weight') ?></label>
                        <input type="text" class="form-control no-resize" name="partner_weight" value="<?= $partner_expectation_data[0]['partner_weight'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_marital_status" class="text-uppercase c-gray-light"><?php echo translate('marital_status') ?></label>
                        <?php
                        echo $this->Crud_model->select_html('marital_status', 'partner_marital_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_marital_status'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="with_children_acceptables" class="text-uppercase c-gray-light"><?php echo translate('with_children_acceptables') ?></label>
                        <?php
                        echo $this->Crud_model->select_html('decision', 'with_children_acceptables', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['with_children_acceptables'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_country_of_residence" class="text-uppercase c-gray-light"><?php echo translate('country_of_residence') ?></label>
                        <?php
                        echo $this->Crud_model->select_html('country', 'partner_country_of_residence', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_country_of_residence'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="religion" class="text-uppercase c-gray-light"><?php echo translate('religion') ?></label>
                        <?php
                        echo $this->Crud_model->select_html('religion', 'partner_religion', 'name', 'edit', 'form-control form-control-sm selectpicker prefered_religion_edit', $partner_expectation_data[0]['partner_religion'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="caste" class="text-uppercase c-gray-light"><?php echo translate('caste') ?></label>
                        <?php
                        if (!empty($partner_expectation_data[0]['partner_religion'])) {
                            echo $this->Crud_model->select_html('caste', 'partner_caste', 'caste_name', 'edit', 'form-control form-control-sm selectpicker prefered_caste_edit', $partner_expectation_data[0]['partner_caste'], 'religion_id', $partner_expectation_data[0]['partner_religion'], '');
                        } else {
                        ?>
                            <select class="form-control form-control-sm selectpicker prefered_caste_edit" name="partner_caste">
                                <option value=""><?php echo translate('choose_a_religion_first') ?></option>
                            </select>
                        <?php
                        }
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="sub_caste" class="text-uppercase c-gray-light"><?php echo translate('sub_caste') ?></label>
                        <?php
                        if (!empty($partner_expectation_data[0]['partner_caste'])) {
                            echo $this->Crud_model->select_html('sub_caste', 'partner_sub_caste', 'sub_caste_name', 'edit', 'form-control form-control-sm selectpicker prefered_sub_caste_edit', $partner_expectation_data[0]['partner_sub_caste'], 'caste_id', $partner_expectation_data[0]['partner_caste'], '');
                        } else {
                        ?>
                            <select class="form-control form-control-sm selectpicker prefered_sub_caste_edit" name="partner_sub_caste">
                                <option value=""><?php echo translate('choose_a_caste_first') ?></option>
                            </select>
                        <?php
                        }
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_education" class="text-uppercase c-gray-light"><?php echo translate('education') ?></label>
                        <input type="text" class="form-control no-resize" name="partner_education" value="<?= $partner_expectation_data[0]['partner_education'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_profession" class="text-uppercase c-gray-light"><?php echo translate('profession') ?></label>
                        <input type="text" class="form-control no-resize" name="partner_profession" value="<?= $partner_expectation_data[0]['partner_profession'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_drinking_habits" class="text-uppercase c-gray-light"><?php echo translate('drinking_habits') ?></label>
                        <?php
                        echo $this->Crud_model->select_html('decision', 'partner_drinking_habits', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_drinking_habits'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_smoking_habits" class="text-uppercase c-gray-light"><?php echo translate('smoking_habits') ?></label>
                        <?php
                        echo $this->Crud_model->select_html('decision', 'partner_smoking_habits', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_smoking_habits'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_diet" class="text-uppercase c-gray-light"><?php echo translate('diet') ?></label>
                        <input type="text" class="form-control no-resize" name="partner_diet" value="<?= $partner_expectation_data[0]['partner_diet'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_body_type" class="text-uppercase c-gray-light"><?php echo translate('body_type') ?></label>
                        <input type="text" class="form-control no-resize" name="partner_body_type" value="<?= $partner_expectation_data[0]['partner_body_type'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_personal_value" class="text-uppercase c-gray-light"><?php echo translate('personal_value') ?></label>
                        <input type="text" class="form-control no-resize" name="partner_personal_value" value="<?= $partner_expectation_data[0]['partner_personal_value'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="manglik" class="text-uppercase c-gray-light"><?php echo translate('manglik') ?></label>

                        <?php
                        echo $this->Crud_model->select_html('decision', 'manglik', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['manglik'], '', '', '');
                        ?>
                        <!-- <select name="manglik" class="form-control form-control-sm selectpicker" data-placeholder="Choose a manglik" tabindex="2" data-hide-disabled="true">
                            <option value="">Choose one</option>
                            <option value="1" <?php if ($manglik == 1) {
                                                    echo 'selected';
                                                } ?>>Yes</option>
                            <option value="2" <?php if ($manglik == 2) {
                                                    echo 'selected';
                                                } ?>>No</option>
                            <option value="3" <?php if ($manglik == 3) {
                                                    echo 'selected';
                                                } ?>>I don't know</option>
                        </select> -->

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_any_disability" class="text-uppercase c-gray-light"><?php echo translate('any_disability') ?></label>
                        <input type="text" class="form-control no-resize" name="partner_any_disability" value="<?= $partner_expectation_data[0]['partner_any_disability'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_mother_tongue" class="text-uppercase c-gray-light"><?php echo translate('mother_tongue') ?></label>
                        <?php
                        echo $this->Crud_model->select_html('language', 'partner_mother_tongue', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_mother_tongue'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_family_value" class="text-uppercase c-gray-light"><?php echo translate('family_value') ?></label>
                        <input type="text" class="form-control no-resize" name="partner_family_value" value="<?= $partner_expectation_data[0]['partner_family_value'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="prefered_country" class="text-uppercase c-gray-light"><?php echo translate('prefered_country') ?></label>
                        <?php
                        echo $this->Crud_model->select_html('country', 'prefered_country', 'name', 'edit', 'form-control form-control-sm selectpicker prefered_country_edit', $partner_expectation_data[0]['prefered_country'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="prefered_state" class="text-uppercase c-gray-light"><?php echo translate('prefered_state') ?></label>
                        <?php
                        if (!empty($partner_expectation_data[0]['prefered_country'])) {
                            echo $this->Crud_model->select_html('state', 'prefered_state', 'name', 'edit', 'form-control form-control-sm selectpicker prefered_state_edit', $partner_expectation_data[0]['prefered_state'], 'country_id', $partner_expectation_data[0]['prefered_country'], '');
                        } else {
                        ?>
                            <select class="form-control form-control-sm selectpicker prefered_state_edit" name="prefered_state">
                                <option value=""><?php echo translate('choose_a_country_first') ?></option>
                            </select>
                        <?php
                        }
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="prefered_status" class="text-uppercase c-gray-light"><?php echo translate('prefered_status') ?></label>
                        <input type="text" class="form-control no-resize" name="prefered_status" value="<?= $partner_expectation_data[0]['prefered_status'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="partner_complexion" class="text-uppercase c-gray-light"><?php echo translate('complexion') ?></label>
                        <input type="text" class="form-control no-resize" name="partner_complexion" value="<?= $partner_expectation_data[0]['partner_complexion'] ?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(".prefered_country_edit").change(function() {
        var country_id = $(".prefered_country_edit").val();
        if (country_id == "") {
            $(".prefered_state_edit").html("<option value=''><?php echo translate('choose_a_country_first') ?></option>");
        } else {
            $.ajax({
                url: "<?= base_url() ?>home/get_dropdown_by_id/state/country_id/" + country_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $(".prefered_state_edit").html(data);
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
    $(".prefered_religion_edit").change(function() {
        var religion_id = $(".prefered_religion_edit").val();
        if (religion_id == "") {
            $(".prefered_caste_edit").html("<option value=''><?php echo translate('choose_a_religion_first') ?></option>");
            $(".prefered_sub_caste_edit").html("<option value=''><?php echo translate('choose_a_caste_first') ?></option>");
        } else {
            $.ajax({
                url: "<?= base_url() ?>home/get_dropdown_by_id_caste/caste/religion_id/" + religion_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $(".prefered_caste_edit").html(data);
                    $(".prefered_sub_caste_edit").html("<option value=''><?php echo translate('choose_a_caste_first') ?></option>");
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
    $(".prefered_caste_edit").change(function() {
        var caste_id = $(".prefered_caste_edit").val();
        if (caste_id == "") {
            $(".prefered_sub_caste_edit").html("<option value=''><?php echo translate('choose_a_caste_first') ?></option>");
        } else {
            $.ajax({
                url: "<?= base_url() ?>home/get_dropdown_by_id_caste/sub_caste/caste_id/" + caste_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $(".prefered_sub_caste_edit").html(data);
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
</script>