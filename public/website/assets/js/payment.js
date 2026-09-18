const moneyMask = (value) => {
    value = value ? value.replace('.', '').replace(',', '').replace(/\D/g, '') : 0
  
    const options = { minimumFractionDigits: 2 }
    const result = new Intl.NumberFormat('en-US').format(
      parseFloat(value)
    )
  
    return result
}

const paymentModal = new bootstrap.Modal(document.getElementById("payment-modal"), {
    backdrop: 'static'
})

function separatePoint(val) {
    // remove sign if negative
    val = val.replace(/\D/g, '') //val.replace(/\./g,'')
    var sign = 1;
    if (val < 0) {
      sign = -1;
      val = -val;
    }
    // trim the number decimal point if it exists
    let num = val.toString().includes('.') ? val.toString().split('.')[0] : val.toString();
    let len = num.toString().length;
    let result = '';
    let count = 1;
    //console.log(len)
  
    for (let i = len - 1; i >= 0; i--) {
      result = num.toString()[i] + result;
      if (count % 3 === 0 && count !== 0 && i !== 0) {
        result = ',' + result;
      }
      count++;
    }
  
    // add number after decimal point
    if (val.toString().includes('.')) {
      result = result + '.' + val.toString().split('.')[1];
    }
    // return result with - sign if negative
    return sign < 0 ? '-' + result : result;
}

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
            $('.form-maal').find('input').val("")
            $('.form-profesi').find('input').val("")
            $('#zakat-alert').empty()
            $('#zakat-total').html('Rp')
            $('#zakat-total').attr('data-value', 0)
            if(value == 'profesi'){
                $('.nishab-profesi').show()
                $('.nishab-maal').hide()
                $('.desc-profesi').show()
                $('.desc-maal').hide()
                $('.form-profesi').show()
                $('.form-maal').hide()
            }else{
                $('.nishab-profesi').hide()
                $('.nishab-maal').show()
                $('.desc-profesi').hide()
                $('.desc-maal').show()
                $('.form-profesi').hide()
                $('.form-maal').show()
            }
            $('.niat-fitrah').hide()
            $('.niat-non-fitrah').show()
        }
    })

    $('.money').keyup(function(){
        var el = $(this);
        var value = separatePoint(el.val());
        el.val(value);
    })
    /*
    $('[name=zakat_nominal]').keyup(function(){
        var el = $(this);
        var value = el.val().replace(',','').toString();
        console.log(value)
        el.val(moneyMask(el.val()));
    })*/

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