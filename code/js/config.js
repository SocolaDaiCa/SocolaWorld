'use strict';
var ace;
function createEditor(id = "editor", mode = "javascript") {
    var editor = ace.edit(id);
    editor.setTheme("ace/theme/monokai");
    editor.setOptions({
        fontSize: "16px"
    });
    var Mode = ace.require(`ace/mode/${mode}`).Mode;
    editor.session.setMode(new Mode());
    return editor;
}
var editor = createEditor("editor");
editor.setOptions({
	readOnly: true,
	wrap: true
});
// editor.destroy();
// editor.container.remove();