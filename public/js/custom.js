function deleteTag(id) {
    Swal.fire({
        title: 'Tem certeza que desea remover este item?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Deletar`,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        denyButtonText: `Cancelar`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (!!result.value) {

            event.preventDefault();
            document.getElementById('delete-form-' + id).submit();
            Swal.fire('Deletado!', '', 'success')

        } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
        }
    })
}