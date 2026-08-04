</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>&copy; <?php echo date('Y'); ?> LSP BPSDM Kementerian PU
            </span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <div class="modal-header border-0 p-4 pb-2">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel"
                    style="font-weight: 700; color: #2d3748;">
                    Apakah Anda yakin untuk keluar?
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"
                    style="outline: none; opacity: 0.5;">
                    <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
                </button>
            </div>

            <div class="modal-footer border-0 p-4 pt-3">
                <button class="btn btn-light text-secondary font-weight-medium px-4 py-2 mr-2" type="button"
                    data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">
                    Batal
                </button>
                <a class="btn btn-danger px-4 py-2" href="<?php echo base_url('login/keluar'); ?>"
                    style="border-radius: 8px; font-weight: 600; box-shadow: 0 4px 6px rgba(220, 53, 69, 0.2);">
                    Keluar
                </a>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url('assets/vendor/chart.js/Chart.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url('assets/js/demo/chart-area-demo.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/demo/chart-pie-demo.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/demo/datatables-demo.js'); ?>"></script>
</body>

</html>