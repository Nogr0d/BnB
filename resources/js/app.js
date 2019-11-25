

require('./bootstrap');


window.UI={
    showToast(msg){
        //TODO: lijepi toast!
        alert(msg);
    },
    basicValidation($form) {
        let errorMessage = "";
        $form.find("input").each(function () {
            let error = false;
            if ($(this).hasClass('required')) {
                switch (this.type) {
                    case "file":
                        if (this.files.length == 0) {
                            error = true;
                        }
                        break;
                    default:
                        if (this.value.length == 0) {
                            error = true;
                        }
                        break;
                }
                if (error) {
                    $(this).addClass("error")
                    let $label = $(this).siblings('label');
                    if ($label.length) errorMessage += ("The field " + $label[0].innerHTML + " is required. ");
                } else $(this).removeClass("error")
            }
        })
        let finalError = errorMessage.length > 0;
        if (finalError) {
            alert(errorMessage)
        }
        return !finalError
    }

}

require('simplelightbox/dist/simple-lightbox');
require('simplelightbox/dist/simplelightbox.min.css');
