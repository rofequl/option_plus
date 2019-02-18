/*-----------------------------------------------------------------------------------

    Template Name: Option Plus
    Author: Md. Nayem
    Author URI:

-----------------------------------------------------------------------------------

    JAVASCRIPT INDEX
    ===================

    1.


-----------------------------------------------------------------------------------*/


/*============================================
/*      Register Page Script
/*=========================================== */

/*----------------------------------------*/
/*  1.  Image verify and show
/*----------------------------------------*/

// image upload file open
function logoUpload() {
    $("#CompanyLogo").click();
}

// Function to preview image after validation
$(function () {
    $("#CompanyLogo").change(function () {
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            alert("only jpeg, jpg and png Images type allowed");
            return false;
        }
        else {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function imageIsLoaded(e) {
    $('#previewLogo').attr('src', e.target.result).css("display","block");
}

$(document).ready( function () {
    $('.table').DataTable();
});
