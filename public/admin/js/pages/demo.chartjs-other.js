function hexToRGB(t, e) { var a = parseInt(t.slice(1, 3), 16), o = parseInt(t.slice(3, 5), 16), t = parseInt(t.slice(5, 7), 16); return e ? "rgba(" + a + ", " + o + ", " + t + ", " + e + ")" : "rgb(" + a + ", " + o + ", " + t + ")" } !function (a) { "use strict"; function t() { this.$body = a("body"), this.charts = [], this.defaultColors = ["#3e60d5", "#47ad77", "#fa5c7c", "#ffbc00"] } t.prototype.bubbleExample = function () { var t = document.getElementById("bubble-example"), e = t.getAttribute("data-colors"), e = e ? e.split(",") : this.defaultColors, t = t.getContext("2d"), t = new Chart(t, { type: "bubble", data: { labels: ["Jan", "Feb", "March", "April", "May", "June"], datasets: [{ label: "Fully Rounded", data: [{ x: 10, y: 20, r: 5 }, { x: 20, y: 10, r: 5 }, { x: 15, y: 15, r: 5 }], borderColor: e[0], backgroundColor: hexToRGB(e[0], .3), borderWidth: 2, borderSkipped: !1 }, { label: "Small Radius", data: [{ x: 12, y: 22 }, { x: 22, y: 20 }, { x: 5, y: 15 }], backgroundColor: hexToRGB(e[1], .3), borderColor: e[1], borderWidth: 2, borderSkipped: !1 }] }, options: { responsive: !0, maintainAspectRatio: !1, plugins: { legend: { display: !1, position: "top" } }, scales: { x: { grid: { display: !1 } }, y: { grid: { display: !1 } } } } }); this.charts.push(t) }, t.prototype.donutExample = function () { var t = document.getElementById("donut-example"), e = t.getAttribute("data-colors"), e = e ? e.split(",") : this.defaultColors, t = t.getContext("2d"), t = new Chart(t, { type: "doughnut", data: { labels: ["Direct", "Affilliate", "Sponsored", "E-mail"], datasets: [{ data: [300, 135, 48, 154], backgroundColor: e, borderColor: "transparent", borderWidth: "3" }] }, options: { responsive: !0, maintainAspectRatio: !1, cutoutPercentage: 60, plugins: { legend: { display: !1, position: "top" } } } }); this.charts.push(t) }, t.prototype.pieExample = function () { var t = document.getElementById("pie-example"), e = t.getAttribute("data-colors"), e = e ? e.split(",") : this.defaultColors, t = t.getContext("2d"), t = new Chart(t, { type: "pie", data: { labels: ["Jan", "Feb", "March", "April", "May"], datasets: [{ label: "Fully Rounded", data: [12, 19, 14, 15, 40], backgroundColor: e }] }, options: { indexAxis: "y", responsive: !0, maintainAspectRatio: !1, plugins: { legend: { display: !1 } } } }); this.charts.push(t) }, t.prototype.polarAreaExample = function () { var t = document.getElementById("polar-area-example"), e = t.getAttribute("data-colors"), e = e ? e.split(",") : this.defaultColors, t = t.getContext("2d"), t = new Chart(t, { type: "polarArea", data: { labels: ["Jan", "Feb", "March", "April", "May"], datasets: [{ label: "Dataset 1", data: [12, 19, 14, 15, 20], backgroundColor: e }] }, options: { responsive: !0, maintainAspectRatio: !1, plugins: { legend: { display: !1, position: "top" } }, scales: { r: { display: !1 } } } }); this.charts.push(t) }, t.prototype.radarExample = function () { var t = document.getElementById("radar-example"), e = t.getAttribute("data-colors"), e = e ? e.split(",") : this.defaultColors, t = t.getContext("2d"), t = new Chart(t, { type: "radar", data: { labels: ["Jan", "Feb", "March", "April", "May", "June"], datasets: [{ label: "Dataset 1", data: [12, 29, 39, 22, 28, 34], borderColor: e[0], backgroundColor: hexToRGB(e[0], .3) }, { label: "Dataset 2", data: [10, 19, 15, 28, 34, 39], borderColor: e[1], backgroundColor: hexToRGB(e[1], .3) }] }, options: { responsive: !0, maintainAspectRatio: !1, plugins: { legend: { display: !1 } } } }); this.charts.push(t) }, t.prototype.scatterExample = function () { var t = document.getElementById("scatter-example"), e = t.getAttribute("data-colors"), e = e ? e.split(",") : this.defaultColors, t = t.getContext("2d"), t = new Chart(t, { type: "scatter", data: { labels: ["Jan", "Feb", "March", "April", "May", "June", "July"], datasets: [{ label: "Dataset 1", data: [{ x: 10, y: 50 }, { x: 50, y: 10 }, { x: 15, y: 15 }, { x: 20, y: 45 }, { x: 25, y: 18 }, { x: 34, y: 38 }], borderColor: e[0], backgroundColor: hexToRGB(e[0], .3) }, { label: "Dataset 2", data: [{ x: 15, y: 45 }, { x: 40, y: 20 }, { x: 30, y: 5 }, { x: 35, y: 25 }, { x: 18, y: 25 }, { x: 40, y: 8 }], borderColor: e[1], backgroundColor: hexToRGB(e[1], .3) }] }, options: { responsive: !0, maintainAspectRatio: !1, plugins: { legend: { display: !1 } }, scales: { x: { grid: { display: !1 } }, y: { grid: { display: !1 } } } } }); this.charts.push(t) }, t.prototype.barLineExample = function () { var t = document.getElementById("bar-line-example"), e = t.getAttribute("data-colors"), e = e ? e.split(",") : this.defaultColors, t = t.getContext("2d"), t = new Chart(t, { type: "line", data: { labels: ["Jan", "Feb", "March", "April", "May", "June", "July"], datasets: [{ label: "Dataset 1", data: [10, 20, 35, 18, 15, 25, 22], backgroundColor: e[0], stack: "combined", type: "bar" }, { label: "Dataset 2", data: [13, 23, 38, 22, 25, 30, 28], borderColor: e[1], stack: "combined" }] }, options: { responsive: !0, maintainAspectRatio: !1, plugins: { legend: { display: !1 } }, scales: { x: { grid: { display: !1 } }, y: { stacked: !0, grid: { display: !1 } } } } }); this.charts.push(t) }, t.prototype.init = function () { var e = this; Chart.defaults.font.family = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif', Chart.defaults.color = "#8391a2", Chart.defaults.scale.grid.color = "#8391a2", this.bubbleExample(), this.donutExample(), this.pieExample(), this.polarAreaExample(), this.radarExample(), this.barLineExample(), this.scatterExample(), a(window).on("resizeEnd", function (t) { a.each(e.charts, function (t, e) { try { e.destroy() } catch (t) { } }), e.bubbleExample(), e.donutExample(), e.pieExample(), e.polarAreaExample(), e.radarExample(), e.barLineExample(), e.scatterExample() }), a(window).resize(function () { this.resizeTO && clearTimeout(this.resizeTO), this.resizeTO = setTimeout(function () { a(this).trigger("resizeEnd") }, 500) }) }, a.ChartJs = new t, a.ChartJs.Constructor = t }(window.jQuery), function () { "use strict"; window.jQuery.ChartJs.init() }();