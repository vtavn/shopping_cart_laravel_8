
function actionDelete(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let element = $(this);
    Swal.fire({
        title: 'Bạn có muốn xoá sản phẩm này?',
        text: "Sản phẩm sẽ biến mất.!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý!',
        cancelButtonText: 'Huỷ'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function (data){
                    if (data.code == 200){
                        element.parent().parent().remove();
                    }
                    Swal.fire(
                        'Thành Công!',
                        'Đã xoá sản phẩm thành công.',
                        'success'
                    )
                },
                error: function (){
                    Swal.fire(
                        'Lỗi!',
                        'Có lỗi xảy ra vui lòng thử lại.',
                        'errors'
                    )
                }
            })

        }
    })
}

$(function (){
    $(document).on('click', '.action_delete', actionDelete);
});
