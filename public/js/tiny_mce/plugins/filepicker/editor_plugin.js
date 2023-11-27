(function () {
    var file_picker, input;
    tinymce.create('tinymce.plugins.VivvoFilePicker', {
        init: function (ed, url) {
            ed.addCommand('mceFilePicker', function () {
                if (ed.dom.getAttrib(ed.selection.getNode(), 'class').indexOf('mceItem') != -1) {
                    return
                }
                if (!file_picker) {
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
                }
                file_picker.modal.open()
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