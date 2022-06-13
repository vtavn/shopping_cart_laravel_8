$(function (){
    $(".tags_select_choose").select2({
        tags: true,
        tokenSeparators: [',']
    })
    $(".select2_parent_id").select2({
        placeholder: "Chọn Danh Mục",
        allowClear: true
    })

    // Define function to open filemanager window
    let lfm = function(options, cb) {
        let route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = cb;
    };

    // Define LFM summernote button
    let LFMButton = function(context) {
        let ui = $.summernote.ui;
        let button = ui.button({
            contents: '<i class="note-icon-picture"></i> ',
            tooltip: 'Insert image with filemanager',
            click: function() {

                lfm({type: 'image', prefix: '/filemanager'}, function(lfmItems, path) {
                    lfmItems.forEach(function (lfmItem) {
                        context.invoke('insertImage', lfmItem.url);
                    });
                });

            }
        });
        return button.render();
    };

    // Initialize summernote with LFM button in the popover button group
    // Please note that you can add this button to any other button group you'd like
    $('#contents').summernote({
        toolbar: [
            ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['font', ['strikethrough', 'superscript', 'subscript', 'bold', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'video']],
            ['popovers', ['lfm']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
        buttons: {
            lfm: LFMButton
        },
        height: 300
    })

});

