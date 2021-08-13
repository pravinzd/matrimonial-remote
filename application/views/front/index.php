<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'includes/top/' . $top; ?>

    <!-- Google Analytics -->
    <script>
        <?php $g_set = $this->db->get_where('third_party_settings', array('type' => 'google_analytics_set'))->row()->value;
        if ($g_set == "yes") {
            $g_key = $this->db->get_where('third_party_settings', array('type' => 'google_analytics_key'))->row()->value;
        } else {
            $g_key = " ";
        }
        ?>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', "<?php echo $g_key; ?>", 'auto');
        ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->


    <!-- Favicon -->
    <?php
    $favicon = $this->db->get_where('frontend_settings', array('type' => 'favicon'))->row()->value;
    $favicon = json_decode($favicon, true);
    if (!empty($favicon) && file_exists('uploads/favicon/' . $favicon[0]['image'])) {
    ?>
        <link href="<?= base_url() ?>uploads/favicon/<?= $favicon[0]['image'] ?>" rel="icon" type="image/png">
    <?php
    } else {
    ?>
        <link href="<?= base_url() ?>uploads/favicon/default_image.png" rel="icon" type="image/png">
    <?php
    }
    
    ?>



<link rel="apple-touch-icon" sizes="57x57" href="uploads/favicon/apple-icon-57x57.png">

<link rel="apple-touch-icon" sizes="60x60" href="uploads/favicon/apple-icon-60x60.png">

<link rel="apple-touch-icon" sizes="72x72" href="uploads/favicon/apple-icon-72x72.png">

<link rel="apple-touch-icon" sizes="76x76" href="uploads/favicon/apple-icon-76x76.png">

<link rel="apple-touch-icon" sizes="114x114" href="uploads/favicon/apple-icon-114x114.png">

<link rel="apple-touch-icon" sizes="120x120" href="uploads/favicon/apple-icon-120x120.png">

<link rel="apple-touch-icon" sizes="144x144" href="uploads/favicon/apple-icon-144x144.png">

<link rel="apple-touch-icon" sizes="152x152" href="uploads/favicon/apple-icon-152x152.png">

<link rel="apple-touch-icon" sizes="180x180" href="uploads/favicon/apple-icon-180x180.png">

<link rel="icon" type="image/png" sizes="192x192" href="uploads/favicon/android-icon-192x192.png">

<link rel="icon" type="image/png" sizes="32x32" href="uploads/favicon/favicon-32x32.png">

<link rel="icon" type="image/png" sizes="96x96" href="uploads/favicon/favicon-96x96.png">

<link rel="icon" type="image/png" sizes="16x16" href="uploads/favicon/favicon-16x16.png">

<link rel="manifest" href="/manifest.json">

<meta name="msapplication-TileColor" content="#ffffff">

<meta name="msapplication-TileImage" content="uploads/favicon/ms-icon-144x144.png">

<meta name="theme-color" content="#ffffff">

<link rel='mask-icon' href='uploads/favicon/logo.svg' color='#ff9e42'>





<title><?= $title ?></title>


<script data-ad-client="ca-pub-8134997030999128" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</head>

<body>
    <?php include 'preloader.php'; ?>
    <div class="container">
        <div class="row">
            <!-- Alerts for Member actions -->
            <div class="col-lg-3 col-md-4" id="success_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
                <div class="alert alert-success fade show" role="alert">
                    <!-- Success Alert Content -->
                </div>
            </div>
            <div class="col-lg-3 col-md-4" id="danger_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
                <div class="alert alert-danger fade show" role="alert">
                    <!-- Danger Alert Content -->
                </div>
            </div>
            <!-- Alerts for Member actions -->
        </div>
    </div>
    <?php
    include_once 'header/header.php';
    include_once $page . '/index.php';
    include_once 'footer/footer.php';
    include_once 'includes/bottom/' . $bottom;
    ?>
    <a href="#" class="btn-shadow back-to-top btn-back-to-top"></a>
    <button class="open_modal" style="display: none"><?php echo translate('open') ?></button>
</body>

</html>
<!-- Bootstrap Modal -->
<div class="modal fade" id="active_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" style="max-width: 400px; margin-top: 30vh;">
        <div class="modal-content">
            <div class="modal-header text-center" style="display: block; border-bottom: 1px solid transparent">
                <span class="modal-title" id="modal_header"><?php echo translate('title') ?></span>
                <button type="button" class="close" id="modal_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center" id="modal_body">
                <div class='text-center' id='payment_loader'><i class='fa fa-refresh fa-5x fa-spin'></i>
                    <p><?php echo translate('please_wait_...') ?></p>
                </div>
            </div>
            <div class="text-center" id="modal_buttons">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><?php echo translate('close') ?></button>
            </div>
        </div>
    </div>
</div>
<div id="test"></div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.top_bar_right').load('<?php echo base_url(); ?>home/top_bar_right');
    });
</script>
<!-- Bootstrap Modal -->

<script>
    var isloggedin = "<?= $this->session->userdata('member_id') ?>";

    var right_click = "<?= $this->db->get_where('general_settings', array('type' => 'right_click_option'))->row()->value ?>"
    if (right_click == "on") {
        $('body').on('contextmenu', function(e) {
            return false;
        });
    }


    function confirm_accept(id) {
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("Please Login");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_accept_this_request') ?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'>Close</button> <a href='<?= base_url() ?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'>Log In</a>");
        } else {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("Confirm Accept Request");
            $("#modal_body").html("<p class='text-center'><?php echo translate('are_you_sure_that_you_want_to_accept_this_request') ?>?</p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'>Close</button> <a href='#' id='confirm_accept' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_accept(" + id + ")' style='width:25%'>Confirm</a>");
        }
    }

    function do_accept(id) {
        $("#confirm_accept").removeAttr("onclick");
        $("#confirm_accept").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing') ?>..");
        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>home/accept_interest/" + id,
                cache: false,
                success: function(response) {
                    $("#active_modal .close").click();
                    $(".text_" + id).html("<small class='sml_txt'><i class='fa fa-check-circle'></i> <?php echo translate('you_have_accepted_the_interest') ?></small>");
                    $(".text_" + id).attr('class', 'text-center text-success text_' + id);
                    $("#success_alert").show();
                    $(".alert-success").html("<?php echo translate('you_have_accepted_the_request') ?>!");
                    $('#danger_alert').fadeOut('fast');
                    setTimeout(function() {
                        $('#success_alert').fadeOut('fast');
                    }, 5000); // <-- time in milliseconds
                },
                fail: function(error) {
                    alert(error);
                }
            });
        }, 500); // <-- time in milliseconds
    }

    function confirm_reject(id) {
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in') ?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_reject_this_request') ?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close') ?></button> <a href='<?= base_url() ?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in') ?></a>");
        } else {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('confirm_reject_request') ?>");
            $("#modal_body").html("<p class='text-center'<?php echo translate('are_you_sure_that_you_want_to_reject_this_request?') ?>>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close') ?></button> <a href='#' id='confirm_reject' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_reject(" + id + ")' style='width:25%'><?php echo translate('confirm') ?></a>");
        }
    }

    function do_reject(id) {
        $("#confirm_reject").removeAttr("onclick");
        $("#confirm_reject").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing') ?>..");
        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>home/reject_interest/" + id,
                cache: false,
                success: function(response) {
                    $("#active_modal .close").click();
                    $(".text_" + id).html("<small class='sml_txt'><i class='fa fa-times-circle'></i><?php echo translate('you_have_rejected_the_interest') ?></small>");
                    $(".text_" + id).attr('class', 'text-center text-danger text_' + id);
                    $("#danger_alert").show();
                    $(".alert-danger").html("<?php echo translate('you_have_rejected_this_request!') ?>");
                    $('#success_alert').fadeOut('fast');
                    setTimeout(function() {
                        $('#danger_alert').fadeOut('fast');
                    }, 5000); // <-- time in milliseconds
                },
                fail: function(error) {
                    alert(error);
                }
            });
        }, 500); // <-- time in milliseconds
    }
</script>

    <!-- <script src="/serviceWorker.js"></script> -->

    <script src="/upup.min.js"></script>

    <script>
        UpUp.start({

            'content-url': 'home/',

            'content-url': 'home/listing',

            'content-url': 'home/listing/free_members',

            'assets': [

                'template/front/vendor/pace/css/pace-minimal.css',

                'template/front/vendor/bootstrap/css/bootstrap.min.css',

                'template/front/vendor/hamburgers/hamburgers.min.css',

                'template/front/vendor/swiper/css/swiper.min.css',

                'template/front/vendor/animate/animate.min.css',

                'template/front/vendor/lightgallery/css/lightgallery.min.css',

                'template/front/fonts/font-awesome/css/font-awesome.min.css',

                'template/front/fonts/ionicons/css/ionicons.min.css',

                'template/front/fonts/line-icons/line-icons.css',

                'template/front/fonts/line-icons-pro/line-icons-pro.css',

                'template/front/css/global-style.css',

                'template/front/css/global-style-purple.css',

                'template/front/css/custom-style.css',



                'template/front/vendor/pace/js/pace.min.js',

                'template/front/vendor/jquery/jquery.min.js',

                'template/front/js/jquery.inputmask.bundle.min.js',

                'template/front/vendor/popper/popper.min.js',

                'template/front/vendor/bootstrap/js/bootstrap.min.js',

                'template/front/js/vendor/jquery.easing.js',

                'template/front/js/slidebar/slidebar.js',

                'template/front/js/classie.js',

                'template/front/vendor/bootstrap-dropdown-hover/js/bootstrap-dropdown-hover.js',

                'template/front/vendor/bootstrap-notify/bootstrap-growl.min.js',

                'template/front/vendor/scrollpos-styler/scrollpos-styler.js',

                'template/front/vendor/flatpickr/flatpickr.min.js',

                'template/front/vendor/easy-pie-chart/jquery.easypiechart.min.js',

                'template/front/vendor/footer-reveal/footer-reveal.min.js',

                'template/front/vendor/sticky-kit/sticky-kit.min.js',

                'template/front/vendor/swiper/js/swiper.min.js',

                'template/front/vendor/viewport-checker/viewportchecker.min.js',

                'template/front/vendor/milestone-counter/jquery.countTo.js',

                'template/front/vendor/countdown/js/jquery.countdown.min.js',

                'template/front/vendor/typed/typed.min.js',

                'template/front/vendor/instafeed/instafeed.js',

                'template/front/vendor/gradientify/jquery.gradientify.min.js',

                'template/front/vendor/nouislider/js/nouislider.min.js',

                'template/front/vendor/isotope/isotope.min.js',

                'template/front/vendor/imagesloaded/imagesloaded.pkgd.min.js',

                'template/front/vendor/lightgallery/js/lightgallery.min.js',

                'template/front/vendor/lightgallery/js/lg-thumbnail.min.js',

                'template/front/vendor/lightgallery/js/lg-video.js',

                'template/front/js/wpx.app.js',

                '',

                '',

                'uploads/header_logo/header_logo_1599145390.png',

                '/manifest.json',



            ],

            // "share_target": {

            //     "action": "compose/tweet",

            //     "enctype": "multipart/form-data",

            //     "method": "POST",

            //     "params": {

            //         "title": "title",

            //         "text": "text",

            //         "url": "url",

            //         "files": [{

            //             "name": "externalMedia",

            //             "accept": [

            //                 "image/jpeg",

            //                 "image/png",

            //                 "image/gif",

            //                 "video/quicktime",

            //                 "video/mp4"

            //             ]

            //         }]

            //     }

            // },

        });
    </script>


    <!-- facebook chat Start -->


    <?php if ($this->db->get_where('third_party_settings', array('type' => 'facebook_chat_set'))->row()->value == "yes") { ?>

        <?php $facebook_chat_page_id = $this->db->get_where('third_party_settings', array('type' => 'facebook_chat_page_id'))->row()->value; ?>

        <?php $facebook_chat_theme_color = $this->db->get_where('third_party_settings', array('type' => 'facebook_chat_theme_color'))->row()->value; ?>

        <?php $facebook_chat_logged_in_greeting = $this->db->get_where('third_party_settings', array('type' => 'facebook_chat_logged_in_greeting'))->row()->value; ?>

        <?php $facebook_chat_logged_out_greeting = $this->db->get_where('third_party_settings', array('type' => 'facebook_chat_logged_out_greeting'))->row()->value; ?>

        <!-- facebook chat starts -->
        <!-- Load Facebook SDK for JavaScript -->
        <div id="fb-root"></div>
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    xfbml: true,
                    version: 'v6.0'
                });
            };
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <div class="fb-customerchat" attribution=setup_tool page_id="<?= $facebook_chat_page_id ?>" <?php if (!empty($facebook_chat_theme_color)) { ?> theme_color="<?= $facebook_chat_theme_color ?>" <?php } ?> <?php if (!empty($facebook_chat_logged_in_greeting)) { ?> logged_in_greeting="<?= $facebook_chat_logged_in_greeting ?>" <?php } ?> <?php if (!empty($facebook_chat_logged_out_greeting)) { ?> logged_out_greeting="<?= $facebook_chat_logged_out_greeting ?>"> <?php } ?> </div>
        <!-- facebook chat ends -->
    <?php } ?>

    <!-- facebook chat ends -->
    <!-- responsive ads -->
    <!-- <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8134997030999128" data-ad-slot="1127704493" data-ad-format="auto"></ins>
    <script>
        // (adsbygoogle = window.adsbygoogle || []).push({});
    </script> -->
    </body>


</html>