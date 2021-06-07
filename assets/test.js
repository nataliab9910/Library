function addEvents() {
    const changeStatusButtons = document.querySelectorAll(".js-status-btn");

    changeStatusButtons.forEach(button => button.addEventListener("click", changeStatus));
}

function changeStatus() {
    const rental = this;
    const container = rental.parentElement;
    const id = rental.getAttribute("id");
    fetch(`/admin/rental/change_status/${id}`)
        .then(function () {
            const role = container.querySelector(".js-changed");
            role.text = 'changed';
        })
}

function giveUser() {
    const user = this;
    const container = user.parentElement;
    const id = container.getAttribute("id");

    fetch(`/giveUser/${id}`)
        .then(function () {
            const role = container.querySelector(".role");
            role.innerHTML = 'user';
        })
}

setInterval(addEvents, 3000);