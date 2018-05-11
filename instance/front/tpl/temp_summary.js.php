<script type="text/javascript">
    function showAllSummaryByLocation() {
        console.log("here");
//        alert("here Loc");
        $(".alllocation_summary .active").removeClass("active");
        $("#tabAllSummaryLocation").addClass("active");
        $(".empAllSummary").hide();
        $(".allsummaryByLocation").show();
    }

    function showAllSummaryByTeam() {
        console.log("here 2");
//        alert("here team");
        $(".alllocation_summary .active").removeClass("active");
        $("#tabAllSummaryTeam").addClass("active");
        $(".empAllSummary").hide();
        $(".allsummaryByTeam").show();
    }
    function showAllSummaryByRemote() {
        console.log("here 3");
//        alert("here 3");
        $(".alllocation_summary .active").removeClass("active");
        $(".empAllSummary").hide();
        $("#tabAllSummaryRemote").addClass("active");

        $(".allsummaryByRemote").show();
    }
    $(document).ready(function () {
        $('.ui-accordion-content').css('height', 'auto');

        $('.allsummaryByTeam').accordion({
            collapsible: true,
        });
        $('#emp_accordion .ui-accordion-content').css('height', 'auto');
        $('.allsummaryByLocation').accordion({
            collapsible: true
        });
        $('.allsummaryByLocation .ui-accordion-content').css('height', 'fit-content');
        $('.allsummaryByRemote').accordion({
            collapsible: true
        });
        $('.allsummaryByRemote .ui-accordion-content').css('height', 'auto');

//        $('.accordion').accordion({
//            collapsible: true
//        });
    });
</script>