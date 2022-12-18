/* toast */
function bpToast(types, message){
    switch(types){
      case 'success':
        var type = 'bg-success';
        break;
      case 'danger':
        var type = 'bg-danger';
        break;
      case 'warning':
        var type = 'bg-warning';
        break;
      default:
        var type = 'bg-primary';
        break;
    }

    var findContainer = $('body').find('.toast-container').length;
    var findToast = $('body').find('.toast-container').find('.toast').length;
    var numToast = findToast++;

    if(findContainer === 0){
      $('body').append('<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11"><div>');
    }

    $('<div id="dynamic-toast-'+numToast+'" class="toast align-items-center text-white '+type+' border-0" role="alert" aria-live="assertive" aria-atomic="true">'+
          '<div class="d-flex">'+
            '<div class="toast-body">'+message+'</div>'+
            '<button type="button" class="btn-close btn-close-white me-2 m-auto dynamic-toast" data-bs-dismiss="toast" aria-label="Close"></button>'+
          '</div>'+
        '</div>').appendTo('.toast-container');
    
    var toastLiveExample = document.getElementById('dynamic-toast-'+numToast)
    var toast = new bootstrap.Toast(toastLiveExample)
    toast.show();

    $(document).on('click', '.dynamic-toast', function(){
      $(this).parent().parent().remove();
    })
}