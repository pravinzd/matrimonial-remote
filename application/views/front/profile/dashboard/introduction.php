<div class="mb-2 pl-3">
    <b><?= translate('Member ID') . ' - ' ?></b><b class="c-base-1"><?= $get_member[0]->member_profile_id ?></b>
</div>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_introduction">
        <div class="card-inner-title-wrapper pt-0">
            <div class="d-flex justify-content-between mb-2">
                <h3 class="card-inner-title">
                    <?php echo translate('introduction') ?>
                </h3>
                <div>
                    <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('introduction')">
                        <i class="ion-edit"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="table-full-width">
            <div class="profile-grid container-fluid profile-list-group mb-3">
                <div class="row profile-list-group-item g-0">
                    <div class="col-6 col-lg-3">
                        <?= $get_member[0]->introduction ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="edit_introduction" style="display: none">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('introduction') ?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow mb-1" onclick="save_section('introduction')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow mb-1" onclick="load_section('introduction')"><i class="ion-close"></i></button>
            </div>
        </div>

        <div class='clearfix'></div>
        <form id="form_introduction" class="form-default" role="form">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <textarea name="introduction" class="form-control no-resize" rows="5"><?= $get_member[0]->introduction ?></textarea>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>