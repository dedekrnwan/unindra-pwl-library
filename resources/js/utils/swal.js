
export const sAlertError = (vm, error, message = 'Something went wrong!') => {
    if (error) console.error(error);
    message = message ? message : 'Something went wrong!'
    return vm.$swal.fire({
        type: 'error',
        title: 'Oops...',
        html: message,
        allowOutsideClick: false,
        showCloseButton: true,
    });
};
export const sAlertSuccess = (vm, message) => {
    return vm.$swal.fire({
        type: 'success',
        title: 'Good job!',
        html: message,
        allowOutsideClick: false,
        showCloseButton: true,
    });
};
export const sAlertInfo = (vm, message) => {
    return vm.$swal.fire({
        title: 'For your information',
        type: 'info',
        html: message,
        allowOutsideClick: false,
        showCloseButton: true,
    });
};

export const sAlertWarning = (vm, message) => {
    return vm.$swal.fire({
        title: 'For your information',
        type: 'warning',
        html: message,
        allowOutsideClick: false,
        showCloseButton: true,
    });
};
export const sAlertConfirmation = (vm, message = '', preConfirm) => {
    return vm.$swal.fire({
        icon: 'question',
        type: 'question',
        title: 'Are you sure?',
        text: message,
        showCancelButton: true,
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        preConfirm,
    });
};
