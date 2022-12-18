function bpModalAlert(data){
    var newFunction = data.onSuccess;
    var cancelFunction = data.onCancel;

    /*
        cancelType -> jenis tombol untuk batal
        cancelText -> text tombol untuk batal
        type -> jenis tombol action
        buttonText -> text tombol untuk action
        cancelNone -> false
    */
    switch(data.cancelType){
        case 'primary':
            var cancelTypeClass = 'btn-primary';
            break;
        case 'danger':
            var cancelTypeClass = 'btn-danger';
            break;
        case 'success':
            var cancelTypeClass = 'btn-success';
            break;
        case 'warning':
            var cancelTypeClass = 'btn-warning';
            break;
        case 'info':
            var cancelTypeClass = 'btn-info';
            break;
        default:
            var cancelTypeClass = 'btn-secondary';
            break;
    }

    switch(data.type){
        case 'danger':
            var typeClass = 'btn-danger';
            break;
        case 'success':
            var typeClass = 'btn-success';
            break;
        case 'warning':
            var typeClass = 'btn-warning';
            break;
        case 'info':
            var typeClass = 'btn-info';
            break;
        default:
            var typeClass = 'btn-primary';
            break;
    }

    $('body').append('<div class="modal fade" id="dynamic-alert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
        '<div class="modal-dialog modal-dialog-centered">'+
        '<div class="modal-content">'+
            '<div class="modal-header">'+
            '<h5 class="modal-title" id="staticBackdropLabel">'+data.title+'</h5>'+
            '<button type="button" class="btn-close dynamic-alert-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
            '</div>'+
            '<div class="modal-body">'+data.message+'</div>'+
            '<div class="modal-footer">'+
            '<button type="button" class="btn '+cancelTypeClass+' dynamic-alert-close" data-bs-dismiss="modal" '+(data.cancelNone == true ? 'style="display: none"' : '')+'>'+(data.cancelText ? data.cancelText : 'Batal')+'</button>'+
            '<button type="button" class="btn '+typeClass+' dynamic-alert-action" '+(newFunction ? '' : 'style="display: none"')+' id="dynamic-alert-action" data-bs-dismiss="modal">'+data.buttonText+'</button>'+
            '</div>'+
        '</div>'+
        '</div>'+
    '</div>');

    $('#dynamic-alert').modal('show');

    function removeModal(){
        $('#dynamic-alert').fadeOut(200, function(){
            if(cancelFunction){
                cancelFunction();
            }
            $(this).remove();
        });
    }

    var fireButton = document.getElementById('dynamic-alert-action');

    fireButton.onclick = function(){
        newFunction();
        removeModal();
    }

    $(document).on('click', '.dynamic-alert-close', function(){
        removeModal();
    });

}