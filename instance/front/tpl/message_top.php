<style type="text/css">
    .top-bar{
        position: fixed;
        top: -11px;
        height:1px;
        padding: 10px;
        left: 0px;
        right: 0px;
        bottom: 0px;
        width: 100%;


    }
    .top-meaasge{
        border-radius: 10px;
        bottom: 0;
        color: white !important;
        display: block;
        height: 51px;
        left: 45%;
        padding: 16px;
        position: fixed;
        right: 40%;
        top: -3px;
        text-align:center;
    }
    .alert-success-top {
        z-index: 10000 !important;
        background-color: #00A65A;
    }
    .alert-error-top {
        z-index: 10000 !important;
        background-color: #DD4B39;
        
    }
    .alert-warning-top {
        z-index: 10000 !important;
        background-color: #F39C12;
    }
    .loader-top {
        border: 6px solid #f3f3f3;
        border-radius: 50%;
        border-top: 6px solid #3C8DBC;
        border-bottom: 6px solid #3C8DBC;
        width: 20px;
        height: 20px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<!--<div class="col-lg-12">
    <span class="btn btn-default" onclick="topmsgdemo(2)">Show Wait</span>&nbsp;&nbsp;&nbsp;
    <span class="btn btn-default" onclick="topmsgdemo(3)">Hide Wait</span>&nbsp;&nbsp;&nbsp;
    <span class="btn btn-default" onclick="topmsgdemo(0)">View SuccessMsg</span>&nbsp;&nbsp;&nbsp;
    <span class="btn btn-default" onclick="topmsgdemo(1)">View ErrorMsg</span>
</div>-->

<div style="display:none;" class="top-bar alert-error-top" id="error_top_jquery_msg">
    <div class="top-meaasge alert-error-top">
        <strong><span id="error_top_msg_content"></span></strong>
    </div>
</div>
<div style="display:none;" class="top-bar alert-success-top" id="success_top_jquery_msg">
    <div class="top-meaasge alert-success-top">
        <strong><span id="success_top_msg_content"></span></strong>
    </div>
</div>
<div style="display:none;" class="top-bar alert-warning-top" id="wait_top_jquery_msg">
    <div class="top-meaasge alert-warning-top" >
        <div class="loader-top" style="position:absolute;"></div>
        <strong><span id="wait_top_msg_content" style="margin-left:-15px;position:relative;"></span></strong>
    </div>
</div>


<script type="text/javascript">

    function topmsgdemo(val) {
        if (val == '0') {
            _successTop("Success");
        } else if (val == '2') {
            _showwaitTop("Loading...");

        } else if (val == '3') {
            _hidewaitTop();
        } else {
            _errorTop("Fail to load");
        }

    }

    function _showwaitTop(msg) {
        var msgnew = typeof msg == 'undefined' ? "Wait..." : msg
        try {
            $("#wait_top_msg_content").html(msgnew);

            $("#wait_top_jquery_msg").show();
        } catch (e) {
        }
    }
    function _hidewaitTop() {
        $("#wait_top_jquery_msg").hide();
    }
    function _errorTop(msg) {
        var msgnew = typeof msg == 'undefined' ? "Error!  " : msg
        try {
            $("#error_top_msg_content").html(msg);
            $("#error_top_jquery_msg").show();
            setTimeout(function () {
                $("#error_top_jquery_msg").hide('slow');
            }, 2000);
        } catch (e) {

        }
    }

    function _successTop(msg) {
        var msgnew = typeof msg == 'undefined' ? "Success!  " : msg
        try {
            $("#success_top_msg_content").html(msg);
            $("#success_top_jquery_msg").show();
            setTimeout(function () {
                $("#success_top_jquery_msg").hide();
            }, 2000);
        } catch (e) {

        }
    }
</script>