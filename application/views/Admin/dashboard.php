<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Sertifikasi</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <style>
        .dashboard-card-estetik {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            /* Bayangan lembut */
            padding: 25px 20px;
            width: 100%;
            font-family: 'Nunito', sans-serif;
        }

        .dashboard-header-estetik {
            text-align: center;
            margin-bottom: 25px;
        }

        .dashboard-header-estetik h2 {
            color: #2c395c;
            font-weight: 800;
            margin: 0;
            font-size: 1.4rem;
        }

        .dashboard-header-estetik p {
            color: #858796;
            margin-top: 5px;
            font-size: 0.9rem;
        }
    </style>

    <?php
    // Data dari Controller
    $dataPoints = array(
        array("label" => "Tinjau Permohonan", "y" => $report_dashboard_admin->tinjau_permohonan),
        array("label" => "Invoice Ditagihkan", "y" => $report_dashboard_admin->invoice_ditagihkan),
        array("label" => "Belum Penunjukan Asesor", "y" => $report_dashboard_admin->belum_penunjukan_asesor),
        array("label" => "Asesmen", "y" => $report_dashboard_admin->asesmen),
        array("label" => "Penetapan Komite", "y" => $report_dashboard_admin->penetapan_komite),
        array("label" => "Quality Check", "y" => $report_dashboard_admin->quality_check),
        array("label" => "Sertifikat Terbit", "y" => $report_dashboard_admin->sertifikat_terbit)
    );
    ?>

    <div class="dashboard-card-estetik">
        <div class="dashboard-header-estetik">
            <h2>Statistik Proses Sertifikasi</h2>
            <p>Akumulasi data permohonan terkini</p>
        </div>

        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>

    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <script>
        window.onload = function () {

            // Palet warna estetik
            CanvasJS.addColorSet("modernPalette", [
                "#374774", "#EAB360", "#4e73df", "#1cc88a", "#e74a3b", "#f6c23e", "#36b9cc"
            ]);

            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light2",
                colorSet: "modernPalette",
                backgroundColor: "transparent",
                animationEnabled: true,
                animationDuration: 1200,

                toolTip: {
                    cornerRadius: 8,
                    fontFamily: "Nunito",
                    fontSize: 13,
                    backgroundColor: "rgba(255,255,255,0.95)",
                    borderThickness: 0,
                    fontColor: "#333",
                    boxShadow: "0 4px 10px rgba(0,0,0,0.1)"
                },

                data: [{
                    type: "doughnut",
                    innerRadius: "60%",
                    showInLegend: true,
                    legendText: "{label}",
                    indexLabel: "{label}: {y}",
                    indexLabelPlacement: "outside",
                    indexLabelFontFamily: "Nunito",
                    indexLabelFontWeight: "600",
                    indexLabelFontSize: 12,
                    indexLabelFontColor: "#5a5c69",
                    indexLabelLineColor: "#d1d3e2",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }],

                legend: {
                    fontFamily: "Nunito",
                    fontSize: 12,
                    fontColor: "#858796",
                    horizontalAlign: "center",
                    verticalAlign: "bottom",
                    cursor: "pointer",
                    itemclick: function (e) {
                        if (typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
                            e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
                        } else {
                            e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
                        }
                        e.chart.render();
                    }
                }
            });

            chart.render();
        }
    </script>
    </body>

</html>