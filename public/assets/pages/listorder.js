function refreshData() {
    $.ajax({
        url: '/api/orders',
        method: 'GET',
        dataType: 'json',
        headers: {'token': window.localStorage['token']},
        success: (res) => {
            console.log(res);
            const data = res.data.data;
            let content = '';
            for (let i = 0; i < data.length; i++) {
                const item = data[i];
                const btnHapus = `<a href="#" class="link-hapus" data-id="${item.id}">Hapus</a>`
                const linkEdit = `<a href="#" class="link-edit" data-id="${item.id}">Edit</a>`

                content += `
                    <tr>
                        <td>${i+1}</td>
                        <td>${item.order_date} <br/> ${btnHapus} | ${linkEdit} </td>
                        <td>${item.product_title}</td>
                        <td>${item.price}</td>
                        <td>${item.qty}</td>
                        <td>${item.first_name} ${item.last_name}</td>
                    </tr>
                `
            }
            $('table.table tbody').html(content);
        },
        error: (res, status, err) => {
            console.log(res)
            alert('Terjadi kesalahan')
        }
    })
    
}

function hapus(id) {
    $.ajax({
        url: `/api/orders/${id}`,
        method: 'DELETE',
        type: 'json',
        headers: {'token': window.localStorage['token']},
        success: (res) => {
            alert('data berhasil dihapus');
            refreshData() // refresh data order
        },
        error: (res, status, err) => {
            console.log(res)
            alert('data Order gagal dihapus')
        }
    })
}

const changeSelected = (selector, value) => {
    const $select = document.querySelector(selector);
    const $option = document.querySelector(`option[value="${value}"]`);
    $select.value = $option.value;
};

function edit(id) {
    $.ajax({
        url: `/api/orders/${id}`,
        method: 'GET',
        type: 'json',
        headers: {'token': window.localStorage['token']},
        success: (res) => {

            $('#modalOrder').modal('show');
            $('input[name=id]').val(res.data.id);

            changeSelected('select[name=customer_id]', res.data.customer_id)
            changeSelected('select[name=product_id]', res.data.product_id)

            // var indiceCustomer = $('input[name=customer_id]').selectedIndex;
            // $('input[name=customer_id]').selectedIndex = indiceCustomer;
            
            // var indiceProduct = $('input[name=product_id]').selectedIndex;
            // $('input[name=product_id]').selectedIndex = indiceProduct;

            // $('input[name=customer_id]')[0].selectedIndex = res.data.customer_id;
            // $('input[name=product_id]')[0].selectedIndex = res.data.product_id;
            $('input[name=qty]').val(res.data.qty);
            console.log(res)
        },
        error: (res, status, err) => {
            console.log(res)
            alert('gagal ambil data')
        }
    })
}


// tunggu hingga dokumen selesai dimuat
document.addEventListener("DOMContentLoaded", (c) => {    
    refreshData();

    $('body').on('click', 'a.link-hapus', (e) => {
        const isConfirm = confirm('Apakah anda yakin ingin hapus data?')
        if (isConfirm) {
            const id = $(e.currentTarget).data('id');
            hapus(id)
        }
    })
    
    $('body').on('click', 'a.link-edit', (e) => {
        const id = $(e.currentTarget).data('id');
        edit(id)
    })
})


