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
            if(value == 'profesi'){
                $('.nishab-profesi').show()
                $('.nishab-maal').hide()
                $('.desc-profesi').show()
                $('.desc-maal').hide()
            }else{
                $('.nishab-profesi').hide()
                $('.nishab-maal').show()
                $('.desc-profesi').hide()
                $('.desc-maal').show()
            }
            $('.niat-fitrah').hide()
            $('.niat-non-fitrah').show()
        }
    })

    $('.money').keyup(function(){
        var el = $(this);
        var value = el.val().replace(',','').toString();
        console.log(value)
        el.val(moneyMask(el.val()));
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
        $('[name=bank_id]').val(el.data('value'))
        paymentModal.hide()
    })

    $('#formZakat').submit(function(e){
        e.preventDefault();

        var fr = $(this);
        var data = fr.serializeArray();
        var url = '/api/store/payment';

        var bank = $('[name=bank_id]').val();
        var pronoun = $('[name=sapaan]').val();
        var status = true;
        $('.invalid-feedback-pronoun, .invalid-feedback-payment').hide();
        if(pronoun == '' || pronoun == null){
            $('.invalid-feedback-pronoun').show();
            status = false;
        }
        if(bank == '' || bank == null){
            $('.invalid-feedback-payment').show();
            status = false;
        }

        if(status == false){
            return false;
        }

        

        $.post(url, data, function(result){
            window.location.href = '/app/zakat/iq/'+result.code
        }, 'json');
    })
})