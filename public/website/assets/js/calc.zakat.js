$(function(){
    maskMoney = function(value){
        return new Intl.NumberFormat().format(value)
    }
    unmaskMoney = function(value){
        return value ? value.replace('.', '').replace(',', '').replace(/\D/g, '') : 0
    }
    nisab_emas = function(){
        var fHarga = $('#harga_emas')
        var fNisab = $('#nisab')
        var harga = fHarga.val().replace('.', '').replace(',', '').replace(/\D/g, '')
        var nisab = 85 * harga

        fHarga.attr('data-value', harga)
        fNisab.attr('data-value', nisab)
        $('#nisab_float').val(nisab)
        fNisab.val(maskMoney(nisab))
    }

    hitung_zakat = function(){
        var jenis = $('[name=zakat_type]').val()
        var nisab = $('#nisab_float').val()
        var zakat = 0

        if(jenis == 'maal'){
            var income = unmaskMoney($('[name=value_treasure_gold]').val())
            var bonus = unmaskMoney($('[name=value_treasure_saving]').val())
            var other = unmaskMoney($('[name=value_treasure_other]').val())
            var debt = unmaskMoney($('[name=value_treasure_debt]').val())
            selisih = parseFloat(income) + parseFloat(bonus) + parseFloat(other) - debt
        }else{
            var income = unmaskMoney($('[name=value_income]').val())
            var bonus = unmaskMoney($('[name=value_bonus]').val())
            var debt = unmaskMoney($('[name=value_debt]').val())
            selisih = parseFloat(income) + parseFloat(bonus) - debt
        }
        
        nisab = nisab / 12;
        if(nisab == 0 || nisab == null || nisab == ''){
            zakat = 0
            
            $('#zakat-alert').html('<div class="alert alert-danger">Harga emas harus diisi terlebih dahulu.</div>')
        }else{
            if(selisih >= nisab){
                zakat = 0.025 * selisih
                $('#zakat-alert').html('<div class="alert alert-info">Harta SUDAH mencapai nishab. Dikenakan KEWAJIBAN ZAKAT</div>')
            }else{
                zakat = 0.00
                $('#zakat-alert').html('<div class="alert alert-warning">Harta BELUM mencapai nishab. Tidak dikenakan kewajiban zakat</div>')
            }
        }
        

        $('#zakat-total').html('Rp '+maskMoney(zakat))
        $('#zakat-total').attr('data-value', zakat)
    }

})