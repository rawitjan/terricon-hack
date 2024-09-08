import "./bootstrap";

var urlParams = new URLSearchParams(window.location.search);
var tabId = urlParams.get("tab");
if (tabId) {
    $('#pills-tab a[href="#' + tabId + '"]').tab("show");
}

$("#pills-tab a").on("click", function (e) {
    var tabId = $(this).attr("href").substr(1);
    history.pushState({}, "", window.location.pathname + "?tab=" + tabId);
});
