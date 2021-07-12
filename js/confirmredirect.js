let linkObj = document.body.getElementsByClassName('redirect__link');
let link = linkObj[0].textContent;

setTimeout(() => {
    if (confirm(`Вы уверены, что хотите покинуть сайт и перейти по потенциально небезопасной ссылке на сторонний ресурс ${link}?`)) {
        window.location.href = link;
    } else {
        window.location.href = history.go(-1);
    }
}, 1);