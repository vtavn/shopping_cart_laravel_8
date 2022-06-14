$('.checkbox_wrapper').on('click', function (){
    $(this).parents('.module_parent').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
});
