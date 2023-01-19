<script src="{{ asset('js/flatpickr.js') }}"></script>
<script src="{{ asset('aos/aos.js') }}"></script>
<script>
    AOS.init({
        duration: 1000, // values from 0 to 3000, with step 50ms
        easing: 'linear', // default easing for AOS animations
        anchorPlacement: 'center-center', // defines which position of the element regarding to window should trigger the animation
    });
</script>
<script>
    flatpickr('.datepicker', {
        altInput: true,
        altFormat: 'F j, Y',
        dateFormat: 'Y-m-d'
    });
</script>
<script>
    document.getElementById('gambar').addEventListener('change', function(e) {
        // Mengambil file gambar yang dipilih
        let file = e.target.files[0];
        // Membuat objek FileReader
        let reader = new FileReader();
        // Menentukan callback untuk file yang sudah selesai dibaca
        reader.onload = function(e) {
            // Menampilkan preview gambar pada elemen img
            document.getElementById('preview-gambar').src = e.target.result;
        }
        // Membaca file gambar yang dipilih
        reader.readAsDataURL(file);
    });
</script>
<script>
    // document.querySelector('select[name="kode_rental"]').addEventListener('change', function() {
    //     const kode_rental = this.value;
    //     fetch(`/denda/getData/${kode_rental}`)
    //         .then(response => response.json())
    //         .then(data => {
    //             // do something with data, such as update input tanggal_kembali
    //             document.querySelector('input[name="tanggal_kembali"]').value = data.tanggal_kembali;
    //         })
    // });
    document.addEventListener('DOMContentLoaded', function() {
        const kode_rental = document.querySelector('select[name="kode_rental"]').value;
        if (kode_rental) {
            fetch(`/denda/getData/${kode_rental}`)
                .then(response => response.json())
                .then(data => {
                    // do something with data, such as update input tanggal_kembali
                    document.querySelector('input[name="tanggal_kembali"]').value = data.tanggal_kembali;
                })
        }
        document.querySelector('select[name="kode_rental"]').addEventListener('change', function() {
            const kode_rental = this.value;
            fetch(`/denda/getData/${kode_rental}`)
                .then(response => response.json())
                .then(data => {
                    // do something with data, such as update input tanggal_kembali
                    document.querySelector('input[name="tanggal_kembali"]').value = data
                        .tanggal_kembali;
                })
        });
    });
</script>
@livewireScripts
