function remover(myThis, title, confirmButtonText, cancelButtonText) {
    let form =  myThis.closest("form");
    event.preventDefault();
    Swal.fire({
        title: title,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText
    })
        .then((willDelete) => {
            if (willDelete.isConfirmed) {
                form.submit();
            }
        });
}
