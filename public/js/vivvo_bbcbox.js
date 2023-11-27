
window.vivvoBBCBox = {
    tags: [
        {selector: '.tag_bold', prefix: '[b]', suffix: '[/b]'},
        {selector: '.tag_italic', prefix: '[i]', suffix: '[/i]'},
        {selector: '.tag_underline', prefix: '[u]', suffix: '[/u]'},
        {selector: '.tag_strike', prefix: '[s]', suffix: '[/s]'},
        {selector: '.tag_quote', prefix: '[quote]', suffix: '[/quote]'},
        {selector: '.tag_img', content: '.tag_img_src', prefix: '[img]', suffix: '[/img]'},
        {
            selector: '.tag_link',
            value: '.tag_link_href',
            content: '.tag_link_content',
            prefix: '[url=$1]',
            suffix: '[/url]',
            filter: function(data) {
                if ('value' in data && !data.value.match(/^[^:\/\.\?]+:/)) {
                    data.value = 'http://' + data.value;
                }
                return data;
            }
        }
    ],

    instances: {},

    insertQuote: function(editor, author, text) {

        if (editor in this.instances) {
            this.instances[editor].insertTag('[quote]', '[/quote]', '[b]' + author + '[/b]\n' + text);
        }
    }
};

Event.observe(window, 'load', function(){

    var insertTag;

    if (window.getSelection) {
        insertTag = function(textarea, prefix, suffix, clean) {

            var contents = clean ? clean : textarea.value.substr(textarea.selectionStart, textarea.selectionEnd - textarea.selectionStart);
            textarea.value = textarea.value.substr(0, textarea.selectionStart) + prefix +
                             contents + suffix + textarea.value.substr(textarea.selectionEnd);
        };
    } else if (document.selection) {
        insertTag = function(textarea, prefix, suffix, clean){

            var range = document.selection.createRange(),
                duplicate = range.duplicate();

            duplicate.moveToElementText(textarea);
            duplicate.setEndPoint('EndToEnd', range);

            var selectionStart = duplicate.text.length - range.text.length;
            var selectionEnd = selectionStart + range.text.length;
            var contents = clean ? clean : textarea.value.substr(selectionStart, selectionEnd - selectionStart);

            textarea.value = textarea.value.substr(0, selectionStart) + prefix +
                             contents + suffix + textarea.value.substr(selectionEnd);
        };
    } else {
        insertTag = function(textarea, prefix, suffix, clean) {
            textarea.value += prefix + (clean || '') + suffix;
        };
    }

    $$('.bbcodebox').each(function(box) {

        var textarea = box.select('.bbcodearea')[0];

        textarea.value = textarea.value.replace(/(^\s+)|(\s+^)/, '');

        vivvoBBCBox.instances[textarea.identify()] = textarea;
        textarea.insertTag = insertTag.bind(textarea, textarea);

        $A(vivvoBBCBox.tags).each(function(tag) {

            var trigger = box.select(tag.selector);

            if (trigger.length > 0 && (trigger = trigger[0])) {

                var fn;

                if (tag.value && tag.content) {
                    fn = function(tag) {
                        var data = {
                            value: box.select(tag.value)[0].value,
                            content: box.select(tag.content)[0].value || box.select(tag.value)[0].value
                        };
                        if (tag.filter && tag.filter.call) {
                            data = tag.filter(data);
                        }
                        insertTag(
                            textarea,
                            tag.prefix.replace('$1', data.value),
                            tag.suffix,
                            data.content
                        );
                    }.bind(this, tag);
                } else if (tag.content) {
                    var data = {
                        content: box.select(tag.content)[0].value
                    };
                    if (tag.filter && tag.filter.call) {
                        data = tag.filter(data);
                    }
                    fn = function(tag) {
                        insertTag(
                            textarea,
                            tag.prefix,
                            tag.suffix,
                            data.content
                        );
                    }.bind(this, tag);
                } else {
                    fn = insertTag.bind(this, textarea, tag.prefix, tag.suffix, '');
                }

                trigger.observe('click', fn);
            }
        });
    });
});
