const moneyMask = (value) => {
    value = value ? value.replace('.', '').replace(',', '').replace(/\D/g, '') : 0
  
    const options = { minimumFractionDigits: 2 }
    const result = new Intl.NumberFormat('en-US').format(
      parseFloat(value)
    )
  
    console.log(result)
  
    return result
}

const paymentModal = new bootstrap.Modal(document.getElementById("payment-modal"), {
    backdrop: 'static'
})

function modalPayment(){
    paymentModal.show()
}

$(document).ready(function(){
    $('.get-zakat-type').click(function(){
        var el = $(this);
        var value = el.data('value');

        $('.get-zakat-type').removeClass('active');
        el.addClass('active');
        $('[name=zakat_type]').val(value);

        if(value == 'fitrah'){
            $('.niat-fitrah').show()
            $('.niat-non-fitrah').hide()
        }else{
            $('.niat-fitrah').hide()
            $('.niat-non-fitrah').show()
        }
    })

    $('[name=zakat_nominal]').keyup(function(){
        var el = $(this);
        var value = el.val().replace(',','').toString();
        console.log(value)
        el.val(moneyMask(el.val()));
    })

    $('.sapaan').click(function(){
        var el = $(this);
        var value = el.data('value');

        $('.sapaan').removeClass('oc-radio-box-active')
        el.addClass('oc-radio-box-active');
        $('[name=sapaan]').val(value)
    })

    $('.select-payment').click(function(){
        var el = $(this);
        var img = el.find('img').attr('src');
        var text = el.find('.oc-bank-item').text();

        var payment = $('#payment-method');
        payment.find('img').attr('src', img)
        payment.find('img').attr('width', '60px')
        payment.find('span').html(text)
        $('[name=payment_method]').val(el.data('value'))
        paymentModal.hide()
    })
})