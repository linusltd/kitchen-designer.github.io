const _token = "{{ csrf_token() }}";

function btnDisableHandler(button, disabled, text) {
    if (disabled) {
        $(button).html(
            `<i class="fa fa-spinner fa-spin" style="font-size:20px"></i> ${text}`
        );
        $(button).css({ cursor: "not-allowed", opacity: ".7" });
        $(button).attr("disabled", true);
    } else {
        $(button).attr("disabled", false);
        $(button).html(text);
        $(button).css({ cursor: "pointer", opacity: "1" });
    }
}

function sweetAlertMessage(type, message) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: type,
        title: message,
    });
}
