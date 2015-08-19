/*
 copy clipboard
 http://help.dottoro.com/ljctuhrg.php
 */
$(window).ready(function(){

    $(".permalink .link").click(function(){
        CopyToClipboard();
    });

});

function CopyToClipboard () {
    var input = document.getElementById ("toClipboard");
    var textToClipboard = input.value;

    var success = true;
    if (window.clipboardData) { // Internet Explorer
        window.clipboardData.setData ("Text", textToClipboard);
    }
    else {
        // create a temporary element for the execCommand method
        var forExecElement = CreateElementForExecCommand (textToClipboard);

        /* Select the contents of the element
         (the execCommand for 'copy' method works on the selection) */
        SelectContent (forExecElement);

        var supported = true;

        // UniversalXPConnect privilege is required for clipboard access in Firefox
        try {
            if (window.netscape && netscape.security) {
                netscape.security.PrivilegeManager.enablePrivilege ("UniversalXPConnect");
            }

            // Copy the selected content to the clipboard
            // Works in Firefox and in Safari before version 5
            success = document.execCommand ("copy", false, null);
        }
        catch (e) {
            success = false;
        }

        // remove the temporary element
        document.body.removeChild (forExecElement);
    }

    if (success) {
        alert ("URL이 클립보드에 복사되었습니다!");
    }
    else {
        copyToClipboard(textToClipboard);
    }
}

function CreateElementForExecCommand (textToClipboard) {
    var forExecElement = document.createElement ("div");
    // place outside the visible area
    forExecElement.style.position = "absolute";
    forExecElement.style.left = "-10000px";
    forExecElement.style.top = "-10000px";
    // write the necessary text into the element and append to the document
    forExecElement.textContent = textToClipboard;
    document.body.appendChild (forExecElement);
    // the contentEditable mode is necessary for the  execCommand method in Firefox
    forExecElement.contentEditable = true;

    return forExecElement;
}

function SelectContent (element) {
    // first create a range
    var rangeToSelect = document.createRange ();
    rangeToSelect.selectNodeContents (element);

    // select the contents
    var selection = window.getSelection ();
    selection.removeAllRanges ();
    selection.addRange (rangeToSelect);
}

function copyToClipboard (text) {
    window.prompt ("Copy to clipboard: Ctrl+C, Enter", text);
}