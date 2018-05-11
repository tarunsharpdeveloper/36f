<script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/jquery.toaster.js"></script>

<script>

    function _toast(priority, title, msg) {
        $.toaster({
            priority: priority, title: title, message: msg});
    }
</script>
<script>


    $(document).ready(function () {

        if (detectIE() === true) {
            $("#browserMessage").css("display", "block");
            $("#HideDataIE").addClass("hidden");
        } else {
            $("#HideDataIE").css("display", "block");
        }

// default hide and show for the ajax calls
        $(document).ajaxComplete(function (event, xhr, settings) {
            hideWait();
        });
        $(document).ajaxSend(function (event, xhr, settings) {
            try {
                console.log(settings.data.indexOf("silent"));
                if (settings.data.indexOf("silent") == -1) {
                    showWait();
                }
            } catch (e) {
            }
        });

//$('.search-bar-toggle').click(); 
//$(":input").inputmask();
    });

    function hideSideBar() {
        $(".onboarding_steps").hide();
        if ($("aside:visible").length > 0) {
            $("#toggleSideBar").click();
        } else {
            console.warn("sidebar is already hidden");
        }
    }
    function displaySideBar() {
        $(".onboarding_steps").show();
        if ($("aside:visible").length === 0) {
            $("#toggleSideBar").click();
        } else {
            console.warn("sidebar is already displayed");
        }
    }

    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    }
    function detectIE() {
        var ua = window.navigator.userAgent;

        var msie = ua.indexOf('MSIE ');
        if (msie > 0) {
// IE 10 or older => return version number
//            return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
            return true;
        }

        var trident = ua.indexOf('Trident/');
        if (trident > 0) {
// IE 11 => return version number
            var rv = ua.indexOf('rv:');
//            return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
            return true;

        }

        var edge = ua.indexOf('Edge/');
        if (edge > 0) {
// Edge (IE 12+) => return version number
//            return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
            return true;

        }

// other browser
        return false;
    }
</script>
<?php include _PATH . "instance/front/tpl/waitBar.php"; ?>