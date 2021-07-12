document.body.addEventListener("click", function (e) {
    if (e.target && e.target.nodeName == "A") {
        let check = checkLink(e.target);

        if (!check) {
            e.preventDefault();
            window.location.href=`redirect?link=${e.target}`;
        }
    }
});

function checkLink(link) {
    let url = new URL(link);

    if (url.host != window.location.host) {
        return false;
    }
    return true;
}