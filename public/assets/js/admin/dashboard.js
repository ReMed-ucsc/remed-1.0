
    /* click cards */
    document.querySelector('.green').addEventListener('click', function() {
        window.location.href = ROOT+'/admin/pharmacyDetails'
    });

    document.querySelector('.blue').addEventListener('click', function() {
        window.location.href = ROOT+'/admin/user'
    });

    document.querySelector('.red').addEventListener('click', function() {
        window.location.href =ROOT+'/admin/pendingPharmacy'
    });
