function alert(message, bscolor) {
    $("#alertPlaceholder").append(`<div class="alert alert-${bscolor} alert-dismissible fade show mt-1" role="alert">
                                        <i class="fas fa-circle-info text-${bscolor}"></i>
                                        <span> ${message}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>`);
};
function alert(message, bscolor, id) {
    $(`${id} .alert`).remove();
    $(`${id}`).append(`<div class="alert alert-${bscolor} alert-dismissible fade show mt-1" id="alertAuth" role="alert">
                                <i class="fas fa-circle-info text-${bscolor}"></i>
                                <span> ${message}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`);
    setTimeout(function () {
        $(`${id} .alert`).alert('close');
    }, 3000);
};