$(document).ready(function () {
    async function initTinyMCE() {
        await new Promise((resolve) => {
            tinymce.init({
                selector: "textarea.tinymce-editor",
                plugins:
                    "powerpaste casechange searchreplace autolink directionality visualblocks code visualchars image link media mediaembed codesample table charmap pagebreak nonbreaking anchor tableofcontents insertdatetime advlist lists checklist wordcount tinymcespellchecker editimage help formatpainter permanentpen charmap linkchecker emoticons advtable export autosave advcode fullscreen",
                editimage_cors_hosts: ["picsum.photos"],
                menubar: "file edit view insert format tools table help",
                toolbar:
                    "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl | visualblocks code",
                autosave_ask_before_unload: true,
                autosave_interval: "30s",
                autosave_prefix: "{path}{query}-{id}-",
                autosave_restore_when_empty: false,
                autosave_retention: "2m",
                image_advtab: true,
                link_list: [
                    { title: "My page 1", value: "https://www.tiny.cloud" },
                    { title: "My page 2", value: "http://www.moxiecode.com" },
                ],
                image_list: [
                    { title: "My page 1", value: "https://www.tiny.cloud" },
                    { title: "My page 2", value: "http://www.moxiecode.com" },
                ],
                image_class_list: [
                    { title: "None", value: "" },
                    { title: "Some class", value: "class-name" },
                ],
                importcss_append: true,
                advcode_inline: true,
                file_picker_callback: (callback, value, meta) => {
                    if (meta.filetype === "file") {
                        callback("https://www.google.com/logos/google.jpg", {
                            text: "My text",
                        });
                    }
                    if (meta.filetype === "image") {
                        callback("https://www.google.com/logos/google.jpg", {
                            alt: "My alt text",
                        });
                    }
                    if (meta.filetype === "media") {
                        callback("movie.mp4", {
                            source2: "alt.ogg",
                            poster: "https://www.google.com/logos/google.jpg",
                        });
                    }
                },
                height: 600,
                image_caption: true,
                quickbars_selection_toolbar:
                    "bold italic | quicklink h2 h3 blockquote quickimage quicktable",
                noneditable_class: "mceNonEditable",
                toolbar_mode: "sliding",
                contextmenu: "link image table",
                content_style:
                    "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",
                setup: (editor) => {
                    editor.on("init", () => {
                        resolve(); // Resolve the promise when TinyMCE is fully initialized
                    });
                },
            });
        });
    }
    $(document).on("click", ".removePermission", function (e) {
        e.preventDefault();

        let permissionId = $(this).data("id"); // Get the permission ID
        let deleteUrl = `/permissions/${permissionId}`; // Define the delete URL

        if (confirm("Are you sure you want to delete this permission?")) {
            $.ajax({
                url: deleteUrl,
                type: "DELETE", // DELETE method
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ), // Send CSRF token in header
                },
                success: function (response) {
                    if (response.success) {
                        alert("Permission deleted successfully!");
                        $(`a[data-id="${permissionId}"]`)
                            .closest("tr")
                            .remove(); // Assuming this is inside a table row
                    } else {
                        alert("Error deleting permission.");
                    }
                },
                error: function (xhr) {
                    alert("An error occurred. Please try again.");
                },
            });
        }
    });
    $(document).on("click", ".create_role", function (e) {
        e.preventDefault();
        var actionUrl = $("#role_form").data("action");
        var formData = {
            name: $('input[name="name"]').val(),
            permissions: [],
        };
        $(".permissions_id:checked").each(function () {
            formData.permissions.push($(this).val());
        });
        var token = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            url: actionUrl,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": token,
            },
            data: formData,
            success: function (response) {
                if (response.success) {
                    alert(
                        "Role created and permissions assigned successfully!"
                    );
                    $("#role_form")[0].reset();
                } else {
                    alert("Failed to create role or assign permissions.");
                }
            },
            error: function (xhr) {
                alert("An error occurred. Please try again.");
            },
        });
    });
    $(document).on("click", ".create_user", function (e) {
        e.preventDefault();
        var actionUrl = $("#user_form").data("action");
        var formData = {
            name: $('input[name="name"]').val(),
            email: $('input[name="email"]').val(),
            roles: [],
        };
        $(".roles_id:checked").each(function () {
            formData.roles.push($(this).val());
        });
        var token = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            url: actionUrl,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": token,
            },
            data: formData,
            success: function (response) {
                if (response.success) {
                    alert("User created and roles assigned successfully!");
                    $("#user_form")[0].reset();
                } else {
                    alert("Failed to create role or assign permissions.");
                }
            },
            error: function (xhr) {
                alert("An error occurred. Please try again.");
            },
        });
    });
    $(document).on("keyup", "#meta_title", function (e) {
        e.preventDefault();
        var text = $(this).val();
        var { characterCount, wordCount, extraSpaces } = counts(text);
        $(".title_characters.counter b").text(characterCount);
        $(".title_words.counter b").text(wordCount);
        $(".title_spaces.counter b").text(extraSpaces);
    });
    $(document).on("keyup", "#meta_desc", function (e) {
        e.preventDefault();
        var text = $(this).val();
        var { characterCount, wordCount, extraSpaces } = counts(text);
        $(".characters.counter b").text(characterCount);
        $(".words.counter b").text(wordCount);
        $(".spaces.counter b").text(extraSpaces);
    });
    $("#tool_name").on("keyup", function () {
        var toolName = $(this).val();
        var slug = toolName
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, "") // Remove all non-alphanumeric characters except spaces
            .replace(/\s+/g, "-") // Replace spaces with dashes
            .replace(/-+/g, "-"); // Ensure no multiple dashes in a row

        if (!$("#tool_slug").is(":disabled")) {
            $("#tool_slug").val(slug);
        }
    });
    $("#blog_name").on("keyup", function () {
        var blogName = $(this).val();
        var slug = blogName
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, "") // Remove all non-alphanumeric characters except spaces
            .replace(/\s+/g, "-") // Replace spaces with dashes
            .replace(/-+/g, "-"); // Ensure no multiple dashes in a row

        if (!$("#blog_slug").is(":disabled")) {
            $("#blog_slug").val(slug);
        }
    });
    $("#page-name").on("keyup", function () {
        var pageName = $(this).val();
        var slug = pageName
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, "") // Remove all non-alphanumeric characters except spaces
            .replace(/\s+/g, "-") // Replace spaces with dashes
            .replace(/-+/g, "-"); // Ensure no multiple dashes in a row

        if (!$("#page_slug").is(":disabled")) {
            $("#page_slug").val(slug);
        }
    });
    $(document).on("click", "#add_field", function (e) {
        e.preventDefault();
        var selectedType = $("#input_type").val();
        var newField = "";
        if (selectedType === "input") {
            newField = `
                <div class="row mb-3">
                    <div class="col-12 col-md-3">
                        <input type="text" class="form-control" name="key[]" placeholder="Key">
                    </div>
                    <div class="col-12 col-md-7">
                        <input type="text" class="form-control" name="value[]" placeholder="Value">
                    </div>
                    <div class="col-12 col-md-2">
                        <i class="bi bi-x-circle text-danger remove_field"></i>
                    </div>
                </div>
            `;
        } else if (selectedType === "textarea") {
            newField = `
                <div class="row mb-3">
                    <div class="col-12 col-md-3">
                        <input type="text" class="form-control" name="key[]" placeholder="Key">
                    </div>
                    <div class="col-12 col-md-7">
                        <textarea class="form-control" name="value[]" placeholder="Value"></textarea>
                    </div>
                    <div class="col-12 col-md-2">
                        <i class="bi bi-x-circle text-danger remove_field"></i>
                    </div>
                </div>
            `;
        } else if (selectedType === "editor") {
            newField = `
                <div class="row mb-3">
                    <div class="col-12 col-md-3">
                        <input type="text" class="form-control" name="key[]" placeholder="Key">
                    </div>
                    <div class="col-12 col-md-8">
                        
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Editor</h5>
                                    <textarea class="tinymce-editor" name="value[]"></textarea>
                                </div>
                            </div>
                        
                    </div>
                    <div class="col-12 col-md-1">
                        <i class="bi bi-x-circle text-danger remove_field"></i>
                    </div>
                </div>
            `;
        }
        $("#fields_container").append(newField);
        if (selectedType === "editor") {
            tinymce.remove(); // clean up any existing instances
            (async () => {
                await initTinyMCE();
                console.log("TinyMCE is ready!");
            })();
        }
        quill.on("text-change", function () {
            document.getElementById("editorContent").value =
                quill.root.innerHTML;
        });
    });
    $(document).on("click", ".remove_field", function () {
        $(this).closest(".row").remove();
    });
    $(document).on("click", ".delete-tool", function () {
        var toolId = $(this).data("id");
        var url = "/admin/tool/remove/" + toolId; // Absolute URL
        if (confirm("Are you sure you want to delete this tool?")) {
            $.ajax({
                url: url,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    $(".tool_" + toolId).remove();
                },
                error: function (response) {
                    alert(response.responseJSON.error);
                },
            });
        }
    });
    $(".quill-editor").each(function () {
        var editorContainer = $(this);
        var content = editorContainer.data("content");
        var quill = new Quill(this, {
            theme: "snow",
        });
        quill.root.innerHTML = content;
        quill.on("text-change", function () {
            document.getElementById("editorContent").value =
                quill.root.innerHTML;
        });
    });
    $(document).on("click", ".delete-page", function () {
        var pageID = $(this).data("id");
        if (confirm("Are you sure you want to delete this tool?")) {
            $.ajax({
                url: "/admin/custom_page/remove/" + pageID,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    $(".page_" + pageID).remove();
                },
                error: function (response) {
                    alert(response.responseJSON.error);
                },
            });
        }
    });
    $(document).on("click", ".delete-blog", function () {
        var blogID = $(this).data("id");
        if (confirm("Are you sure you want to delete this blog?")) {
            $.ajax({
                url: "/admin/blogs/" + blogID,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    $(".blog_" + blogID).remove();
                },
                error: function (response) {
                    alert(response.responseJSON.error);
                },
            });
        }
    });
});
