function fillCustomer() {
    $.ajax({
        url: '/api/customers',
        method: 'GET',
        dataType: 'json',
        headers: {'token': window.localStorage['token']},
        success: (res) => {
            const data = res.data;
            let content = '';
            for (let i = 0; i < data.length; i++) {
                const item = data[i];
                content += `
                    <option value="${item.id}">${item.first_name} ${item.last_name}</option>
                `
            }
            $('select[name=customer_id]').html(content);
        },
        error: (res, status, err) => {
            console.log(res)
            alert('Terjadi kesalahan baca data isi customer')
        }
    })
}

function fillProduct() {
    $.ajax({
        url: '/api/products',
        method: 'GET',
        dataType: 'json',
        headers: {'token': window.localStorage['token']},
        success: (res) => {
            const data = res.data;
            let content = '';
            for (let i = 0; i < data.length; i++) {
                const item = data[i];
                content += `
                    <option value="${item.id}">${item.title} ${item.category}</option>
                `
            }
            $('select[name=product_id]').html(content);
        },
        error: (res, status, err) => {
            console.log(res)
            alert('Terjadi kesalahan baca data isi product')
        }
    })
}

function save(id) {
    $.ajax({
        url: `/api/orders/${id !== undefined ? id : '' }`,
        method: id !== undefined ? 'PATCH' : 'POST',
        dataType: 'json',
        data: {
            product_id: $('select[name=product_id').val(),
            customer_id: $('select[name=customer_id').val(),
            qty: $('input[name=qty').val()
        },
        headers: {'token': window.localStorage['token']},
        success: (res) => {
            console.log('success '+ res)
            alert('data berhasil direkam');
            $('#modalOrder').modal('hide'); // tutup modal
            refreshData() // refresh data order
        },
        error: (res, status, err) => {
            console.log(res)
            alert('data Order gagal direkam')
        }
    })
}

document.addEventListener('DOMContentLoaded', (c) => {
    fillCustomer()
    fillProduct()
    
    $('button#simpan').on('click', (e) => {
        const id = $('input[name=id]').val()
        console.log(id)
        if(id){
            save(id)
        } else {
            save()
        }
    })
})