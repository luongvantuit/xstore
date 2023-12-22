<script src="/assets/js/jquery-3.3.1.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/jquery.magnific-popup.min.js"></script>
<script src="/assets/js/jquery.slicknav.js"></script>
<script src="/assets/js/owl.carousel.min.js"></script>
<script src="/assets/js/jquery.nice-select.min.js"></script>
<script src="/assets/js/mixitup.min.js"></script>
<script src="/assets/admin/js/fontawesome.min.js"></script>
<script src="/assets/js/main.js"></script>
<script>
    $("#btn-sign-out").on("click", () => {
        localStorage.clear();
        document.cookie =
            "accessToken=; expires=" +
            new Date(0).toUTCString() +
            ";path=/";
        window.location.href = "/login";
    });
</script>