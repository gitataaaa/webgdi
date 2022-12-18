$(document).ready(function(){
    $("#uploadImage").change(function(){
        readImageUrl(this, 'img', function(response){
            $('input[name="picture"]').val(response);
        });
        
    });

    $('#clearImage').click(function(){
        clearImageGenUrl('img');
        $('input[name="picture"]').val("");
    });
})