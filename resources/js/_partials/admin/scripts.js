function confirmLogout(id) {
    if (confirm("Apakah Anda ingin keluar dari sesi saat ini?")) {
        document.getElementById(id).submit();
    }
}

const observer = lozad("img");
observer.observe();
