<?php
$home_slider_image = $this->db->get_where('frontend_settings', array('type' => 'home_slider_image'))->row()->value;
$home_searching_heading = $this->db->get_where('frontend_settings', array('type' => 'home_searching_heading'))->row()->value;

$slider_image = json_decode($home_slider_image, true);

// for slider dynamic margin
$found = 0;
if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value != "yes") {
    $found++;
}
if ($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value != "yes") {
    $found++;
};
?>
<style>
    /*  @media (min-width: 567px) and (max-width: 991px) {
        .outer-search {

            <?php if ($found == 1) { ?>margin-left: -25px !important;
            <?php } elseif ($found == 2) { ?>margin-left: 40px !important;
            <?php } else { ?>margin-left: -25px !important;
            <?php } ?>
        }
    }

    @media (min-width: 992px) and (max-width: 1199px) {
        .outer-search {

            <?php if ($found == 1) { ?>margin-left: 8.5% !important;
            <?php } elseif ($found == 2) { ?>margin-left: 15% !important;
            <?php } else { ?>margin-left: 1.5% !important;
            <?php } ?>
        }
    }


    .outer-search {
        position: absolute;
        top: 45%;
        z-index: 1;
        <?php if ($found == 1) { ?>margin-left: 165px;
        <?php } elseif ($found == 2) { ?>margin-left: 240px;
        <?php } else { ?>margin-left: 95px;
        <?php } ?>
    } */
</style>
<div class="col-lg-12">
    <div style="position: relative;">
        <div class="swiper-js-container background-image-holder">
            <div class="swiper-container" data-swiper-autoplay="true" data-swiper-effect="coverflow" data-swiper-items="1" data-swiper-space-between="0">
                <div class="swiper-wrapper">
                    <!-- Slide -->
                    <?php foreach ($slider_image as $image) : ?>
                        <div class="swiper-slide" data-swiper-autoplay="10000">
                            <div class="slice px-3 holder-item holder-item-light has-bg-cover bg-size-cover same-height" data-same-height="#div_properties_search" style="height: 650px; background-size: cover; background-position: center; background-image: url(<?= base_url() ?>uploads/home_page/slider_image/<?= $image['img'] ?>); background-position: center bottom;">
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button swiper-button-next">
                </div>
                <div class="swiper-button swiper-button-prev">
                </div>
            </div>
        </div>
        <div class="outer-search">
            <div class="container-lg px-0 position-relative">
                <div class="col-12">
                    <h4 class="text-white text-center mb-4">
                        <span style="text-shadow: 4px 3px 6px #000;"><?= $home_searching_heading ?></span>
                    </h4>
                </div>
                <div class="col-12">
                    <div class="feature feature--boxed-border feature--bg-1 z-depth-2-bottom px-3 py-4 animated animation-ended s-search" data-animation-in="zoomIn" data-animation-delay="400" style="background: #1b1e23b3;">
                        <form class="mt-4" data-toggle="validator" role="form" action="<?= base_url() ?>home/listing/home_search" method="POST" style="margin-top: 0px !important;">
                            <div class="row align-items-end">
                                <?php if (!empty($this->session->userdata['member_id'])) { ?>
                                    <div class="col-6 col-md col-lg mb-3 mb-md-0">
                                        <div class="form-group has-feedback">
                                            <label class="text-uppercase text-white">I'm Looking For A</label>
                                            <select name="gender" onChange="(this.value,this)" class="form-control form-control-sm selectpicker" data-placeholder="Choose a gender" tabindex="2" data-hide-disabled="true">
                                                <?php $member_gender = $this->db->get_where('member', array('member_id' => $this->session->userdata['member_id']))->row()->gender; ?>
                                                <?php if ($member_gender == '2') { ?>
                                                    <option value="1">Male</option>
                                                <?php } elseif ($member_gender == '1') { ?>
                                                    <option value="2">Female</option>
                                                <?php } ?>
                                            </select>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>

                                <?php } else { ?>
                                    <div class="col-3 col-md col-lg mb-3 mb-md-0">
                                        <div class="form-group has-feedback">
                                            <label class="text-uppercase text-white"><?php echo translate("i'm_looking_for_a") ?></label>
                                            <?= $this->Crud_model->select_html('gender', 'gender', 'name', 'edit', 'form-control form-control-sm selectpicker', '', '', '', ''); ?>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="col-3 col-md col-lg mb-3 mb-md-0">
                                    <div class="form-group has-feedback">
                                        <label for="" class="text-uppercase text-white"><?php echo translate('aged_from') ?></label>
                                        <input type="number" class="form-control form-control-sm" name="aged_from" id="aged_from" value="">
                                        <div class="help-block with-errors">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md col-lg mb-3 mb-md-0">
                                    <div class="form-group has-feedback">
                                        <label for="" class="text-uppercase text-white"><?php echo translate('to') ?></label>
                                        <input type="number" class="form-control form-control-sm" name="aged_to" id="aged_to" value="">
                                    </div>
                                    <div class="help-block with-errors">
                                    </div>
                                </div>
                                <?php
                                if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value == "yes") {
                                ?>
                                    <div class="col-6 col-md col-lg mb-3 mb-md-0">
                                        <div class="form-group has-feedback">
                                            <label for="" class="text-uppercase text-white"><?php echo translate('religion') ?></label>
                                            <?= $this->Crud_model->select_html('religion', 'religion', 'name', 'edit', 'form-control form-control-sm selectpicker s_religion', '', '', '', ''); ?>
                                            <div class="help-block with-errors">
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                if ($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value == "yes") {
                                ?>
                                    <div class="col-6 col-md col-lg mb-3 mb-md-0">
                                        <div class="form-group has-feedback">
                                            <label for="" class="text-uppercase text-white"><?php echo translate('mother_tongue') ?></label>
                                            <?= $this->Crud_model->select_html('language', 'language', 'name', 'edit', 'form-control form-control-sm selectpicker', '', '', '', ''); ?>
                                            <div class="help-block with-errors">
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="col-12 col-md col-lg mb-0 mb-md-0">
                                    <button type="submit" class="btn btn-styled btn-sm btn-block btn-base-1 btn-search w-100"><?php echo translate('search') ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>