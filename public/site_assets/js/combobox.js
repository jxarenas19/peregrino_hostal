// CSS handles the dropdown behavior, but
// Javascript is still needed to change the
// non-popup area to match the popup area.
function parentComboBox(el) {
    for (el = el.parentNode; el != null && Array.prototype.indexOf.call(el.classList, "combobox") <= -1;)
        el = el.parentNode;
    return el;
}

// Use jQuery for slightly simpler code.
$(".combobox.withtextlist > select").change(function() {
    var textbox = parentComboBox(this).firstElementChild;
    textbox.value = this[this.selectedIndex].text;
});
$(".combobox.withtextlist > select").keypress(function(e) {
    if (e.keyCode == 13)
        parentComboBox(this).firstElementChild.focus();
});
$(".combobox .cb-item").mousedown(function() {
    parentComboBox(this).firstElementChild.innerHTML = this.innerHTML;
});
$(".combobox .color").mousedown(function() {
    var c = this.style.backgroundColor;
    $(parentComboBox(this)).find(".color")[0].style.backgroundColor = c;
});
$(".combobox").find(".hour,.minute,.am,.pm").change(
    function() {
        var cb = parentComboBox(this);
        var hourE = $(cb).find(".hour")[0];
        var minuteE = $(cb).find(".minute").get(0);
        var pmE = $(cb).find(".pm").get(0);
        var hour = hourE.options[hourE.selectedIndex].value;
        var minute = minuteE.options[minuteE.selectedIndex].value;
        var pm = pmE.checked;
        var hour24 = hour == "12" ? (pm ? "12": "00") : pm ? parseInt(hour)+12 : hour;
        //alert(hour24+":"+minute);
        $(cb).find("input")[0].value = hour24+":"+minute;
    });