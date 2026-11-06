<div>
    <script>
        $(document).ready(function () {

            let formSelector = "#{{ $formId }}";
            let btnSelector = "#{{ $btnId }}";
            let removeImageSelector = "#{{ $removeImageId }}";

            $(formSelector).on("submit", function (e) {
                e.preventDefault();

                // Call before-submit callback if it exists
                if (typeof window.beforeFormSubmit === 'function') {
                    const result = window.beforeFormSubmit(formSelector);
                    if (result === false) {
                        return; // Prevent submission
                    }
                }

                // Reset UI
                $(".invalid-feedback").remove();
                $("input, select, textarea").removeClass("is-invalid");
                $("input, select, textarea").prop("disabled", false);

                // Button loading state
                $(btnSelector).find("#btnSpinner").removeClass("d-none");
                $(btnSelector).find("#btnText").text("Processing...");
                $(btnSelector).prop("disabled", true);

                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr("action"),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",

                    success: function (response) {
                        showToast(response.status, response.message);

                        if (response.status === "success") {

                            // UPDATE → redirect
                            if (response.action === 'update' && response.redirect) {
                                window.location.href = response.redirect;
                                return;
                            }

                            // STORE → reset form
                            if(removeImageSelector){
                                $(removeImageSelector).click();
                            }
                            $(formSelector)[0].reset();

                            // Reset Select2 UI
                            $(formSelector).find('[data-toggle="select2"]').val(null).trigger('change');
                        }
                    },

                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.message;

                            $.each(errors, function (key, value) {
                                let field = $("[name='" + key + "']");
                                field.addClass("is-invalid");
                                field.after('<p class="invalid-feedback">' + value[0] + '</p>');
                            });

                            showToast("warning", "Please fix the highlighted errors.");
                        } else {
                            showToast("danger", "Something went wrong!");
                        }
                    },

                    complete: function () {
                        let originalText = $(btnSelector).data("original-text");
                        $(btnSelector).find("#btnSpinner").addClass("d-none");
                        $(btnSelector).find("#btnText").text(originalText);
                        $(btnSelector).prop("disabled", false);
                    }
                });
            });

            function showToast(type, message) {

                let bgClass = {
                    success: "bg-success text-white",
                    warning: "bg-warning text-dark",
                    error: "bg-danger text-white",
                    danger: "bg-danger text-white"
                }[type] || "bg-secondary text-white";

                let toastHtml = `
                    <div class="toast align-items-center ${bgClass} border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                ${message}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                `;

                let $toast = $(toastHtml);
                $("#toastContainer").append($toast);

                let toast = new bootstrap.Toast($toast[0], { delay: 4000 });
                toast.show();

                $toast.on("hidden.bs.toast", function () {
                    $(this).remove();
                });
            }

        });
    </script>
</div>