$(document).ready(function() {
//plugin script for gallery image popup.
//plugin does catch action click on selected element ( this time it is anchor tag element with class - thumbnail ) summoning 
//function magnificPopup where it does search image tag within anchor element, then load there pointer image file and does transformations
//with it.
    $(this).find('a.thumbnail').magnificPopup({
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1]
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
                return item.el.attr('title') + '<small>Laimas.lv</small>' + '';
            }
        }
    });

//plugin script for WYSIWYG editor implementation
//script does find all fields with selected class and replaces the content with 
//WYSIWYG editor, where field content is implemented into editors textfield.
    tinymce.init({
        selector: ".editor textarea"
    });


//basic script that helps power user to get along with employee entry edit,
//when editing employee entry, radio button is used to select whether user will upload new picture or 
//just leave the old one there. Script uses jquery to tooge two form input fields based on which 
//radio button is active for now.
    $("#upload-avatar").hide();

    $("#radio2").change(function() {
        $("#upload-avatar").toggle("slow");
    });
    $("#radio1").change(function() {
        $("#upload-avatar").toggle("slow");
    });
    
//script hides alerts ( successful )elements after 3 seconds by sliding them up
    $('.alert-success').delay(3000).slideUp('slow');
    
//lietotāja paneļa starpšķirkļu pārslēgšana.
    $('.tabs a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });
    
        $(".user-hidden").hide();
        
        $('#userpanel a').click(function() {
        $(".user-hidden").toggle();
    });
       
    

});