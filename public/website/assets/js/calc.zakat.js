$(function(){
    maskMoney = function(value){
        return new Intl.NumberFormat('en-US').format(value)
    }
    nisab_emas = function(){
        var fHarga = $('#harga_emas')
        var fNisab = $('#nisab')
        var harga = fHarga.val().replace('.', '').replace(',', '').replace(/\D/g, '')
        var nisab = 85 * harga

        fHarga.attr('data-value', harga)
        fNisab.attr('data-value', nisab)
        fNisab.val(maskMoney(nisab))
    }

    zakat_profesi = function(){
        var nisab = $('#nisab').data('value')
        var income = $('[name=value_income]').val().replace('.', '').replace(',', '').replace(/\D/g, '')
        var bonus = $('[name=value_bonus]').val().replace('.', '').replace(',', '').replace(/\D/g, '')
        var debt = $('[name=value_debt]').val().replace('.', '').replace(',', '').replace(/\D/g, '')

        selisih = (parseFloat(income) + parseFloat(bonus)) - debt
        console.log(selisih)
        if(selisih >= nisab){
            zakat = 0.025 * selisih
            $('#zakat-alert').html('<div class="alert alert-info">Harta SUDAH mencapai nishab. Dikenakan KEWAJIBAN ZAKAT</div>')
        }else{
            zakat = 0.00
            $('#zakat-alert').html('<div class="alert alert-warning">Harta BELUM mencapai nishab. Tidak dikenakan kewajiban zakat</div>')
        }

        $('#zakat-total').html('Rp '+maskMoney(zakat))
        $('#zakat-total').attr('data-value', zakat)
    }
})