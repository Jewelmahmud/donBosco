jQuery(document).ready(function() {
    
    if(!jQuery('input[name="acf[field_658a4cb148144]"]').is(':checked')) {
        jQuery('.acf-field-658a4e680d642, .acf-field-6625a316b5694').hide();
    }

    jQuery('input[name="acf[field_658a4cb148144]"]').change(function() {
        console.log('hello');
        if(jQuery(this).is(':checked')) {
            jQuery('.acf-field-658a4e680d642, .acf-field-6625a316b5694').show();
        } else {
            jQuery('.acf-field-658a4e680d642, .acf-field-6625a316b5694').hide();
        }
    });


    // Content Editor 
    // Check if we're in the WordPress post editor
    if ($('#wp-content-wrap').length > 0) {
        $('#wp-content-editor-container textarea.wp-editor-area').on('keydown', function(e) {
            if (e.keyCode === 13) {
                e.preventDefault();
                insertAtCursor('<br>');
            }
        });
        
        function insertAtCursor(html) {
            var editor = document.getElementById('content');
            if (editor) {
                // IE
                if (document.selection) {
                    editor.focus();
                    var sel = document.selection.createRange();
                    sel.text = html;
                }
                else if (editor.selectionStart || editor.selectionStart == '0') {
                    var startPos = editor.selectionStart;
                    var endPos = editor.selectionEnd;
                    var scrollTop = editor.scrollTop;
                    editor.value = editor.value.substring(0, startPos) + html + editor.value.substring(endPos, editor.value.length);
                    editor.focus();
                    editor.selectionStart = startPos + html.length;
                    editor.selectionEnd = startPos + html.length;
                    editor.scrollTop = scrollTop;
                } else {
                    editor.value += html;
                    editor.focus();
                }
            }
        }
    }
});