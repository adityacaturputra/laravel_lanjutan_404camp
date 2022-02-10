// tunggu hingga dokumen selesai dimuat
document.addEventListener("DOMContentLoaded", (c) => {
    
    
    const handleSuccess = (msg) => {
        alert(`selamat datang ${msg.data.first_name} ${msg.data.last_name}`)
        window.localStorage.setItem('token', msg.data.token)
        window.location = '/list-order'
    }
    
    const handleError = (req, status, err) => {
        console.log(req)
        alert(req.responseJSON.error[0])
    }
    
    $('button#btn-login').on('click', () => {
        const email = $('input[name=email]').val();
        const password = $('input[name=password]').val();
        console.log(email, password)
        $.ajax({
            url: '/api/auth',
            dataType: 'json',
            method: 'GET',
            headers: { // kirim header Authorization = base bae64encode (email:password)
                'Authorization': `basic ${window.btoa(`${email}:${password}`)}`
            },
            success: handleSuccess,
            error: handleError,
        })
    })
})


