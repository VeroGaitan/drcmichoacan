function validateForm(f) {
    var success = 0;
    f.find(":input").each(function () {
        if (this.type !== "button" &&
                this.type !== "submit" &&
                this.type !== "radio" &&
                this.type !== "checkbox" &&
                this.type !== "") {
            element_notnull = this.id.split('-');
            if (element_notnull[1] === "notnull") {
                switch (this.type) {
                    case 'select-one':
                        if (this.selectedIndex === 0) {
                            console.log("select-one: " + this.id);
                            inlineMsg(this.id, "<strong>Campo obligatorio</strong>");
                            success++;
                            return false;
                        }
                        break;
                    case 'password':
                    case 'textarea':
                    case 'file':
                    case 'email':
                    case 'text':
                        if (this.value === '') {
                            console.log("text: " + this.id);
                            inlineMsg(this.id, "<strong>Campo obligatorio</strong>");
                            success++;
                            return false;
                        }
                        break;
                }
            }
            if (element_notnull[2] === "email") {
                validateMail(this.value);
            } else if (element_notnull[3] === "onlyNumber") {
                validateOnlyNumbers(this.value);
            }

        }
    });
    if (success === 0) {
        return true;
    } else {
        return false;
    }
}
function validateMail(email) {

}
function validateOnlyNumbers() {

}
function inlineMsg(target, string) {
    var msg;
    var msgcontent;
    if ($("#msg").length === 1) {
        $("#msg, #msgcontent").remove();
    }
    msg = $("<div id='msg'></div>").css("display", "block");
    msgcontent = $("<div id='msgcontent'>" + string + "</div>");
    $("body").append(msg);
    msg.append(msgcontent);
    var msgheight = msg.height();
    var targetdiv = $("#" + target);
    targetdiv.focus();

    var targetheight = targetdiv.height() + 10;
    var targetwidth = targetdiv.width();
    var topposition = (targetdiv.offset().top) - ((msgheight - targetheight) / 2);
    var leftposition = (targetdiv.offset().left) + targetwidth + 5;

    console.log("targetheight: " + targetheight);
    console.log("targetwidth: " + targetwidth);
    console.log("topposition: " + topposition);
    console.log("leftposition: " + leftposition);

    msg.css("top", topposition + 'px');
    msg.css("left", leftposition + 'px');
    msg.fadeIn("slow").delay(1000).fadeOut("fast");
}