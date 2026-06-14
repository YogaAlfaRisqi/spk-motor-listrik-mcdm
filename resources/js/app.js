import "./bootstrap";
import ApexCharts from "apexcharts";
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import { Calendar } from "@fullcalendar/core";

window.ApexCharts = ApexCharts;
window.flatpickr = flatpickr;
window.FullCalendar = Calendar;

// 🔥 GLOBAL CONFIG
window.Apex = {
    chart: {
        height: 160,
        toolbar: { show: false },
        zoom: { enabled: false },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: 2,
    },
};

// ================= WEIGHT CHART =================
function initWeightChart() {
    console.log("INIT WEIGHT");

    const el = document.getElementById("weightData");
    const chartEl = document.getElementById("weightChart");

    if (!el || !chartEl) {
        console.warn("Weight chart element not found");
        return;
    }

    const labels = JSON.parse(el.dataset.labels || "[]");
    const ew = JSON.parse(el.dataset.ew || "[]");
    const rs = JSON.parse(el.dataset.rs || "[]");
    const rr = JSON.parse(el.dataset.rr || "[]");
    const roc = JSON.parse(el.dataset.roc || "[]");

    if (!labels.length) {
        console.warn("No data");
        return;
    }

    // ✅ SAFE DESTROY
    if (
        window.weightChart &&
        typeof window.weightChart.destroy === "function"
    ) {
        window.weightChart.destroy();
    }

    // ✅ RESET
    window.weightChart = null;
    chartEl.innerHTML = "";

    // ✅ CREATE NEW
    window.weightChart = new ApexCharts(chartEl, {
        series: [
            { name: "EW", data: ew },
            { name: "RS", data: rs },
            { name: "RS", data: rr },
            { name: "ROC", data: roc },
        ],
        chart: {
            type: "bar",
            height: 350,
            toolbar: { show: false },
        },
        xaxis: {
            categories: labels,
            labels: {
                rotate: -45,
            },
        },
        legend: {
            position: "bottom",
            offsetY: 30,
        },
    });

    window.weightChart.render();
}

// ================= SPK CHART =================
function initSPKChart() {
    const dataEls = document.querySelectorAll('[id^="spk-chart-data-"]');

    dataEls.forEach((el) => {
        const id = el.id.replace("spk-chart-data-", "");
        const lineEl = document.getElementById(`chart-line-${id}`);

        if (!lineEl) return;

        if (window[`chart_${id}`]) {
            window[`chart_${id}`].destroy();
        }

        lineEl.innerHTML = "";

        const labels = JSON.parse(el.dataset.labels || "[]");
        const ew = JSON.parse(el.dataset.ew || "[]");
        const rs = JSON.parse(el.dataset.rs || "[]");
        const rr = JSON.parse(el.dataset.rr || "[]");
        const roc = JSON.parse(el.dataset.roc || "[]");

        if (!labels.length) return;

        window[`chart_${id}`] = new ApexCharts(lineEl, {
            series: [
                { name: "EW", data: ew },
                { name: "RS", data: rs },
                { name: "RR", data: rr },
                { name: "ROC", data: roc },
            ],
            chart: {
                type: "line",
                height: 320,
                toolbar: { show: false },
            },
            stroke: {
                curve: "smooth",
                width: 3,
            },
            xaxis: {
                categories: labels,
                labels: {
                    rotate: -45,
                },
            },
            legend: {
                position: "bottom",
                offsetY: 50,
            },
        });

        window[`chart_${id}`].render();
    });
}

// ================= GLOBAL INIT =================
function initCharts() {
    console.log("INIT ALL CHARTS");

    setTimeout(() => {
        initWeightChart();
        initSPKChart();
    }, 200);
}

// Jalankan saat first load
initCharts();

// Jalankan ulang setiap kali Livewire navigate (SPA-style navigation)
document.addEventListener("livewire:navigated", initCharts);