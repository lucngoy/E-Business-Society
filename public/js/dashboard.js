$(function () {
    const createChart = (selector, data, alertId, seriesName, categories = null) => {
        // Vérification de la présence des données
        if (!data || Object.keys(data).length === 0) {
            $(alertId).removeClass("d-none");
            $(selector).hide();
            return;
        }

        // Si les catégories sont spécifiées, utiliser directement celles-ci
        let dataCategories, dataValues;
        if (categories) {
            dataCategories = categories;
            dataValues = Array.isArray(data) ? data : Object.values(data);
        } else {
            // Sinon, dériver les catégories des clés
            const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            dataCategories = Object.keys(data).map(key => months[Number(key) - 1]);
            dataValues = Object.values(data);
        }

        // Calcul de la valeur maximale et de l'intervalle
        const maxDataValue = Math.max(...dataValues);
        const range = maxDataValue;
        const interval = range <= 100 ? 10 : range <= 1000 ? 50 : range <= 10000 ? 100 : 500;
        const maxVal = Math.ceil(maxDataValue / interval) * interval;

        // Configuration du graphique
        const options = {
            series: [{ name: seriesName, data: dataValues }],
            chart: {
                type: "bar",
                height: 345,
                offsetX: -15,
                toolbar: { show: true },
                foreColor: "#adb0bb",
                fontFamily: 'inherit',
            },
            colors: ["#83d504"],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "30%",
                    borderRadius: [6],
                    borderRadiusApplication: 'end',
                },
            },
            markers: { size: 0 },
            dataLabels: { enabled: false },
            grid: {
                borderColor: "rgba(0,0,0,0.1)",
                strokeDashArray: 5,
                xaxis: { lines: { show: false } },
            },
            xaxis: { categories: dataCategories },
            yaxis: {
                show: true,
                min: 0,
                max: maxVal,
                tickAmount: 4,
                labels: { style: { cssClass: "grey--text lighten-2--text fill-color" } },
            },
            tooltip: { theme: "light" },
        };

        // Création du graphique
        const chart = new ApexCharts(document.querySelector(selector), options);
        chart.render();
    };

    // Graphique des catégories
    createChart("#chartCategories", businessCounts, "#categoriesAlert", "Businesses per Category", categories);

    // Graphique des enregistrements d'entreprises par mois
    createChart("#chartBusinesses", businessCountsByMonth, "#businessAlert", "Businesses Registered");

    // Graphique des enregistrements de reviews par mois
    createChart("#chartReviews", reviewsCountsByMonth, "#reviewsAlert", "Reviews Submitted");
});