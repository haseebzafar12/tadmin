$(document).ready(function () {
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
            // var newEditor = $(".quill-editor-default").last()[0];
            // // newEditor.style.height = "200px";
            // var quill = new Quill(newEditor, {
            //     theme: "snow",
            // });
            tinymce.init({ selector: "textarea.tinymce-editor" });
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
