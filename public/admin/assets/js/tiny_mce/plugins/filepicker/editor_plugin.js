(function () {
    function ReturnWord(text, caretPos) {
        var index = text.indexOf(caretPos);
        var preText = text.substring(0, caretPos);
        return preText;
    }
    function ReturnAfter(text, caretPos) {
        var index = text.indexOf(caretPos);
        var preText = text.substring(caretPos, (text.length - 1));
        return preText;
    }

    function AlertPrevWord() {
        var _content = tinyMCE.activeEditor.getContent();
        var sel = tinyMCE.activeEditor.selection.getRng();
        var caretPos = sel.anchorOffset;
        tinyMCE.activeEditor.execCommand('mceInsertContent', false,'<span class="marker">dinhbang</span>');
        var afterText = ReturnAfter(_content,caretPos);
        var beforeText = ReturnWord(_content,caretPos);
        console.log("beforeText:",beforeText);
        console.log("afterText:",afterText);
    }

    function GetCaretPosition(ctrl) {
        var CaretPos = 0;   // IE Support
        if (document.selection) {
            ctrl.focus();
            var Sel = document.selection.createRange();
            Sel.moveStart('character', -ctrl.value.length);
            CaretPos = Sel.text.length;
        }
        // Firefox support
        else if (ctrl.selectionStart || ctrl.selectionStart == '0')
            CaretPos = ctrl.selectionStart;
        return (CaretPos);
    }
    var file_picker, input;
    tinymce.create('tinymce.plugins.VivvoFilePicker', {
        init: function (ed, url) {
            ed.addCommand('mceFilePicker', function () {
                if (ed.dom.getAttrib(ed.selection.getNode(), 'class').indexOf('mceItem') != -1) {
                    return
                }
                /*if (!file_picker) {
                    file_picker = new vivvo.controls.filePicker(null, {
                        search_ext: 'jpg,png,gif,jpeg',
                        upload: true,
                        relative: true,
                        butonLabel: 'Select image',
                        noneSelected: 'No image selected',
                        onFileSelected: function (file) {
                            if (!file) {
                                return
                            }
                            var args = {src: vivvo.url + 'files.php?file=' + file};
                            ed.focus();
                            var el = ed.selection.getNode();
                            if (el && el.nodeName == 'IMG') {
                                ed.dom.setAttribs(el, args)
                            } else {
                                ed.execCommand('mceInsertContent', false, '<img class="__mce_image" src="' + args.src + '"/>', {skip_undo: 1});
                                ed.undoManager.add()
                            }
                        }
                    })
                }*/
                //file_picker.modal.open()
                /** select image **/
                var selectImageId = null;
                selectImageId = 'image';
                if($("#popup_file_modal .list-folder").html() == '' || _currentType != 100) {
                    getListFolder(100);
                    _currentType = 100;
                    $("#modal_loading").modal('toggle');
                } else {
                    $('#popup_file_modal').modal(true);
                }

            });
            ed.addButton('filepicker', {title: 'Filepicker', cmd: 'mceFilePicker', image: url + '/img/filepicker.gif'})
        }, getInfo: function () {
            return {
                longname: 'Vivvo CMS File Picker',
                author: 'Spoonlabs',
                authorurl: 'http://www.spoonlabs.com',
                infourl: 'http://www.vivvo.net',
                version: '0.1'
            }
        }
    });
    tinymce.PluginManager.add('filepicker', tinymce.plugins.VivvoFilePicker)
})();
