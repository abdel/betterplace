$(".filters div").click(function() {
	setGetParameter('status',  $(this).data('status'));
});

$(".filtersort select#sort_order").change(function() {
	setGetParameter('order_by', $('#sort_order').val());
});


$(".filtersort select#sort_key").change(function() {
	setGetParameter('field', $('#sort_key').val());
});

$('#updatePopover').popover({ 
    trigger: "hover", 
    placement: 'bottom',
    toggle : "popover",
    content : "Data is updated automatically via a scheduled task every hour. Click here to manually update.",
    title: "Manual Data Update",
    container: 'body',
    template: '<div class="popover popover-medium"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>',
});

function viewProject(id) {
	window.open($('#project_'+id).data('location'),'_blank');
}

function setGetParameter(paramName, paramValue)
{
    var url = window.location.href;
    if (url.indexOf(paramName + "=") >= 0)
    {
        var prefix = url.substring(0, url.indexOf(paramName));
        var suffix = url.substring(url.indexOf(paramName));
        suffix = suffix.substring(suffix.indexOf("=") + 1);
        suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
        url = prefix + paramName + "=" + paramValue + suffix;
    }
    else
    {
    if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
    else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url;
}