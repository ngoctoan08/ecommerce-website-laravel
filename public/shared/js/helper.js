function alertSuccess(text) {
    Swal.fire({
        position: 'top-middle',
        icon: 'success',
        title: text,
        showConfirmButton: false,
        timer: 3000,
    });
}

function alertError(text) {
    Swal.fire({
        icon: 'error',
        title: text,
        showConfirmButton: false,
        timer: 3000,
    });
}