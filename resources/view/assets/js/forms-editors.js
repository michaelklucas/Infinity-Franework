"use strict";
var quill = new Quill("#snow-editor", {
    bounds: "#snow-editor",
    modules: {
        formula: !0,
        toolbar: "#snow-toolbar"
    },
    theme: "snow"
});

quill.on('text-change', function() {
    document.getElementById('editor-content').value = quill.root.innerHTML;
});