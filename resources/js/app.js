import Dropzone from "dropzone";

tinymce.init({
    selector: "#editor",
    hidden_input: false,
    plugins:
        "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount",
    toolbar:
        "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat",
});

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Imagen aquí",
    acceptedFiles: ".png,.jpg,.jpeg..gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            (imagenPublicada.size = 1234),
                (imagenPublicada.name =
                    document.querySelector('[name="imagen"]').value);

            //opciones de dropzone
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(
                this,
                imagenPublicada,
                `/uploads/${imagenPublicada.name}`
            );

            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        }

    },
});

dropzone.on("success", function (file, response) {
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on("removedfile", function () {
  document.querySelector('[name="imagen"]').value = "";
  fetch(`/imagenes/eliminar`)
      .then((res) => res.json());
});