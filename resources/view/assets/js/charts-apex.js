"use strict";
! function() {
    let e, o, s, r;
    r = isDarkStyle ? (e = config.colors_dark.cardColor, o = config.colors_dark.headingColor, s = config.colors_dark.axisColor, config.colors_dark.borderColor) : (e = config.colors.white, o = config.colors.headingColor, s = config.colors.axisColor, config.colors.borderColor);
    const a = {
            series1: "#826af9",
            series2: "#d2b0ff",
            bg: "#f8d3ff"
        },
        t = {
            series1: "#fee802",
            series2: "#3fd0bd",
            series3: "#826bf8",
            series4: "#2b9bf4",
            series5: "#f8d3ff",
            series6: "#d2b0ff",
            series7: "#60f2ca",
            series8: "#a5f8cd"
        },
        i = {
            series1: "#29dac7",
            series2: "#60f2ca",
            series3: "#a5f8cd"
        };

    function l(e, o) {
        let s = 0,
            r = [];
        for (; s < e;) {
            var a = "w" + (s + 1).toString(),
                t = Math.floor(Math.random() * (o.max - o.min + 1)) + o.min;
            r.push({
                x: a,
                y: t
            }), s++
        }
        return r
    }


    var n = document.querySelector("#lineAreaChart"),
        c = {
            chart: {
                height: 400,
                type: "area",
                parentHeightOffset: 0,
                toolbar: {
                    show: !1
                }
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                show: !1,
                curve: "straight"
            },
            legend: {
                show: !0,
                position: "top",
                horizontalAlign: "start",
                labels: {
                    colors: "#aab3bf",
                    useSeriesColors: !1
                }
            },
            grid: {
                borderColor: r,
                xaxis: {
                    lines: {
                        show: !0
                    }
                }
            },
            colors: [i.series3, i.series2, i.series1],
            series: [{
                name: "Visits",
                data: [100, 120, 90, 170, 130, 160, 140, 240, 220, 180, 270, 280, 375]
            }, {
                name: "Clicks",
                data: [60, 80, 70, 110, 80, 100, 90, 180, 160, 140, 200, 220, 275]
            }, {
                name: "Sales",
                data: [20, 40, 30, 70, 40, 60, 50, 140, 120, 100, 140, 180, 220]
            }],
            xaxis: {
                categories: ["7/12", "8/12", "9/12", "10/12", "11/12", "12/12", "13/12", "14/12", "15/12", "16/12", "17/12", "18/12", "19/12", "20/12"],
                axisBorder: {
                    show: !1
                },
                axisTicks: {
                    show: !1
                },
                labels: {
                    style: {
                        colors: s,
                        fontSize: "13px"
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: s,
                        fontSize: "13px"
                    }
                }
            },
            fill: {
                opacity: 1,
                type: "solid"
            },
            tooltip: {
                shared: !1
            }
        };


    if (null !== n) {
        const d = new ApexCharts(n, c);
        d.render()
    }


    const programadas = JSON.parse(document.querySelector("#barChart").getAttribute("data-programados"));
    const executadas = JSON.parse(document.querySelector("#barChart").getAttribute("data-executados"));

    const meses = [
        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho',
        'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
    ];

    n = document.querySelector("#barChart"), c = {
        chart: {
            height: 400,
            type: "bar",
            stacked: 0,
            parentHeightOffset: 0,
            toolbar: {
                show: 1
            }
        },
        plotOptions: {
            bar: {
                columnWidth: "30%",
                colors: {

                    backgroundBarRadius: 10
                }
            }
        },
        dataLabels: {
            enabled: !1
        },
        legend: {
            show: !0,
            position: "top",
            horizontalAlign: "start",
            labels: {
                colors: "#aab3bf",
                useSeriesColors: !1
            }
        },
        colors: [a.series1, a.series2],
        stroke: {
            show: !0,
            colors: ["transparent"]
        },
        grid: {
            borderColor: r,
            xaxis: {
                lines: {
                    show: !0
                }
            }
        },
        series: [{
            name: "Programadas",
            data:programadas
        }, {
            name: "Executadas",
            data: executadas
        }],
        xaxis: {
            categories: meses,
            axisBorder: {
                show: !1
            },
            axisTicks: {
                show: !1
            },
            labels: {
                style: {
                    colors: s,
                    fontSize: "13px"
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: s,
                    fontSize: "13px"
                }
            }
        },
        fill: {
            opacity: 1
        }
    };








    if (null !== n) {
        const h = new ApexCharts(n, c);
        h.render()
    }
    n = document.querySelector("#scatterChart"), c = {
        chart: {
            height: 400,
            type: "scatter",
            zoom: {
                enabled: !0,
                type: "xy"
            },
            parentHeightOffset: 0,
            toolbar: {
                show: !1
            }
        },
        grid: {
            borderColor: r,
            xaxis: {
                lines: {
                    show: !0
                }
            }
        },
        legend: {
            show: !0,
            position: "top",
            horizontalAlign: "start",
            labels: {
                colors: "#aab3bf",
                useSeriesColors: !1
            }
        },
        colors: [config.colors.warning, config.colors.primary, config.colors.success],
        series: [{
            name: "Angular",
            data: [
                [5.4, 170],
                [5.4, 100],
                [5.7, 110],
                [5.9, 150],
                [6, 200],
                [6.3, 170],
                [5.7, 140],
                [5.9, 130],
                [7, 150],
                [8, 120],
                [9, 170],
                [10, 190],
                [11, 220],
                [12, 170],
                [13, 230]
            ]
        }, {
            name: "Vue",
            data: [
                [14, 220],
                [15, 280],
                [16, 230],
                [18, 320],
                [17.5, 280],
                [19, 250],
                [20, 350],
                [20.5, 320],
                [20, 320],
                [19, 280],
                [17, 280],
                [22, 300],
                [18, 120]
            ]
        }, {
            name: "React",
            data: [
                [14, 290],
                [13, 190],
                [20, 220],
                [21, 350],
                [21.5, 290],
                [22, 220],
                [23, 140],
                [19, 400],
                [20, 200],
                [22, 90],
                [20, 120]
            ]
        }],
        xaxis: {
            tickAmount: 10,
            axisBorder: {
                show: !1
            },
            axisTicks: {
                show: !1
            },
            labels: {
                formatter: function(e) {
                    return parseFloat(e).toFixed(1)
                },
                style: {
                    colors: s,
                    fontSize: "13px"
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: s,
                    fontSize: "13px"
                }
            }
        }
    };
    if (null !== n) {
        const p = new ApexCharts(n, c);
        p.render()
    }
    n = document.querySelector("#lineChart"), c = {
        chart: {
            height: 400,
            type: "line",
            parentHeightOffset: 0,
            zoom: {
                enabled: !1
            },
            toolbar: {
                show: !1
            }
        },
        series: [{
            data: [280, 200, 220, 180, 270, 250, 70, 90, 200, 150, 160, 100, 150, 100, 50]
        }],
        markers: {
            strokeWidth: 7,
            strokeOpacity: 1,
            strokeColors: [config.colors.white],
            colors: [config.colors.warning]
        },
        dataLabels: {
            enabled: !1
        },
        stroke: {
            curve: "straight"
        },
        colors: [config.colors.warning],
        grid: {
            borderColor: r,
            xaxis: {
                lines: {
                    show: !0
                }
            },
            padding: {
                top: -20
            }
        },
        tooltip: {
            custom: function({
                series: e,
                seriesIndex: o,
                dataPointIndex: s
            }) {
                return '<div class="px-3 py-2"><span>' + e[o][s] + "%</span></div>"
            }
        },
        xaxis: {
            categories: ["7/12", "8/12", "9/12", "10/12", "11/12", "12/12", "13/12", "14/12", "15/12", "16/12", "17/12", "18/12", "19/12", "20/12", "21/12"],
            axisBorder: {
                show: !1
            },
            axisTicks: {
                show: !1
            },
            labels: {
                style: {
                    colors: s,
                    fontSize: "13px"
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: s,
                    fontSize: "13px"
                }
            }
        }
    };
    if (null !== n) {
        const b = new ApexCharts(n, c);
        b.render()
    }
    n = document.querySelector("#horizontalBarChart"), c = {
        chart: {
            height: 400,
            type: "bar",
            toolbar: {
                show: !1
            }
        },
        plotOptions: {
            bar: {
                horizontal: !0,
                barHeight: "30%",
                startingShape: "rounded",
                borderRadius: 8
            }
        },
        grid: {
            borderColor: r,
            xaxis: {
                lines: {
                    show: !1
                }
            },
            padding: {
                top: -20,
                bottom: -12
            }
        },
        colors: config.colors.info,
        dataLabels: {
            enabled: !1
        },
        series: [{
            data: [700, 350, 480, 600, 210, 550, 150]
        }],
        xaxis: {
            categories: ["MON, 11", "THU, 14", "FRI, 15", "MON, 18", "WED, 20", "FRI, 21", "MON, 23"],
            axisBorder: {
                show: !1
            },
            axisTicks: {
                show: !1
            },
            labels: {
                style: {
                    colors: s,
                    fontSize: "13px"
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: s,
                    fontSize: "13px"
                }
            }
        }
    };
    if (null !== n) {
        const f = new ApexCharts(n, c);
        f.render()
    }
    n = document.querySelector("#candleStickChart"), c = {
        chart: {
            height: 410,
            type: "candlestick",
            parentHeightOffset: 0,
            toolbar: {
                show: !1
            }
        },
        series: [{
            data: [{
                x: new Date(15387786e5),
                y: [150, 170, 50, 100]
            }, {
                x: new Date(15387804e5),
                y: [200, 400, 170, 330]
            }, {
                x: new Date(15387822e5),
                y: [330, 340, 250, 280]
            }, {
                x: new Date(1538784e6),
                y: [300, 330, 200, 320]
            }, {
                x: new Date(15387858e5),
                y: [320, 450, 280, 350]
            }, {
                x: new Date(15387876e5),
                y: [300, 350, 80, 250]
            }, {
                x: new Date(15387894e5),
                y: [200, 330, 170, 300]
            }, {
                x: new Date(15387912e5),
                y: [200, 220, 70, 130]
            }, {
                x: new Date(1538793e6),
                y: [220, 270, 180, 250]
            }, {
                x: new Date(15387948e5),
                y: [200, 250, 80, 100]
            }, {
                x: new Date(15387966e5),
                y: [150, 170, 50, 120]
            }, {
                x: new Date(15387984e5),
                y: [110, 450, 10, 420]
            }, {
                x: new Date(15388002e5),
                y: [400, 480, 300, 320]
            }, {
                x: new Date(1538802e6),
                y: [380, 480, 350, 450]
            }]
        }],
        xaxis: {
            type: "datetime",
            axisBorder: {
                show: !1
            },
            axisTicks: {
                show: !1
            },
            labels: {
                style: {
                    colors: s,
                    fontSize: "13px"
                }
            }
        },
        yaxis: {
            tooltip: {
                enabled: !0
            },
            labels: {
                style: {
                    colors: s,
                    fontSize: "13px"
                }
            }
        },
        grid: {
            borderColor: r,
            xaxis: {
                lines: {
                    show: !0
                }
            },
            padding: {
                top: -20
            }
        },
        plotOptions: {
            candlestick: {
                colors: {
                    upward: config.colors.success,
                    downward: config.colors.danger
                }
            },
            bar: {
                columnWidth: "40%"
            }
        }
    };
    if (null !== n) {
        const m = new ApexCharts(n, c);
        m.render()
    }
    n = document.querySelector("#heatMapChart"), c = {
        chart: {
            height: 350,
            type: "heatmap",
            parentHeightOffset: 0,
            toolbar: {
                show: !1
            }
        },
        plotOptions: {
            heatmap: {
                enableShades: !1,
                colorScale: {
                    ranges: [{
                        from: 0,
                        to: 10,
                        name: "0-10",
                        color: "#90B3F3"
                    }, {
                        from: 11,
                        to: 20,
                        name: "10-20",
                        color: "#7EA6F1"
                    }, {
                        from: 21,
                        to: 30,
                        name: "20-30",
                        color: "#6B9AEF"
                    }, {
                        from: 31,
                        to: 40,
                        name: "30-40",
                        color: "#598DEE"
                    }, {
                        from: 41,
                        to: 50,
                        name: "40-50",
                        color: "#4680EC"
                    }, {
                        from: 51,
                        to: 60,
                        name: "50-60",
                        color: "#3474EA"
                    }]
                }
            }
        },
        dataLabels: {
            enabled: !1
        },
        grid: {
            show: !1
        },
        legend: {
            show: !0,
            position: "top",
            horizontalAlign: "start",
            labels: {
                colors: s,
                useSeriesColors: !1
            }
        },
        stroke: {
            curve: "smooth",
            width: 4,
            lineCap: "round",
            colors: [e]
        },
        series: [{
            name: "SUN",
            data: l(24, {
                min: 0,
                max: 60
            })
        }, {
            name: "MON",
            data: l(24, {
                min: 0,
                max: 60
            })
        }, {
            name: "TUE",
            data: l(24, {
                min: 0,
                max: 60
            })
        }, {
            name: "WED",
            data: l(24, {
                min: 0,
                max: 60
            })
        }, {
            name: "THU",
            data: l(24, {
                min: 0,
                max: 60
            })
        }, {
            name: "FRI",
            data: l(24, {
                min: 0,
                max: 60
            })
        }, {
            name: "SAT",
            data: l(24, {
                min: 0,
                max: 60
            })
        }],
        xaxis: {
            labels: {
                show: !1,
                style: {
                    colors: s,
                    fontSize: "13px"
                }
            },
            axisBorder: {
                show: !1
            },
            axisTicks: {
                show: !1
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: s,
                    fontSize: "13px"
                }
            }
        }
    };


    if (null !== n) {
        const x = new ApexCharts(n, c);
        x.render()
    }
    n = document.querySelector("#radialBarChart"), c = {
        chart: {
            height: 385,
            type: "radialBar"
        },
        colors: [t.series1, t.series2, t.series4],
        plotOptions: {
            radialBar: {
                size: 185,
                hollow: {
                    size: "40%"
                },
                track: {
                    margin: 10,
                    background: config.colors_label.secondary
                },
                dataLabels: {
                    name: {
                        fontSize: "2rem",
                        fontFamily: "Public Sans"
                    },
                    value: {
                        fontSize: "1.2rem",
                        color: o,
                        fontFamily: "Public Sans"
                    },
                    total: {
                        show: !0,
                        fontSize: "1.3rem",
                        color: t.series1,
                        label: "Comments",
                        formatter: function(e) {
                            return "80%"
                        }
                    }
                }
            }
        },
        grid: {
            borderColor: r,
            padding: {
                top: -25,
                bottom: -20
            }
        },
        legend: {
            show: !0,
            position: "bottom",
            labels: {
                colors: "#aab3bf",
                useSeriesColors: !1
            }
        },
        stroke: {
            lineCap: "round"
        },
        series: [80, 50, 35],
        labels: ["Comments", "Replies", "Shares"]
    };




// graficos radar

    if (null !== n) {
        const g = new ApexCharts(n, c);
        g.render()
    }
    n = document.querySelector("#radarChart"), c = {
        chart: {
            height: 350,
            type: "radar",
            toolbar: {
                show: 1
            },
            dropShadow: {
                enabled: 1,
                blur: 8,
                left: 1,
                top: 1,
                opacity: .2
            }
        },
        legend: {
            show: !0,
            position: "bottom",
            labels: {
                colors: "#aab3bf",
                useSeriesColors: !1
            }
        },
        plotOptions: {
            radar: {
                polygons: {
                    strokeColors: r,
                    connectorColors: r
                }
            }
        },
        yaxis: {
            show: !1
        },
        series: [{
            name: "EPC",
            data: [41, 64, 81, 60, 42, 42, 33, 23, 81, 60, 42, 81, 60, 42, 10, 65, 46, 42, 25, 58, 63, 76, 43, 76, 43, 76, 43, 76, 43, 10]
        }, {
            name: "EPI",
            data: [65, 46, 42, 25, 58, 63, 76, 43, 76, 43, 76, 43, 76, 43, 10, 41, 64, 81, 60, 42, 42, 33, 23, 81, 60, 42, 81, 60, 42, 10]
        }],
        colors: [t.series1, t.series3],
        xaxis: {
            categories: ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"],
            labels: {
                show: !0,
                style: {
                    colors: [s, s, s, s, s, s, s, s, s, s],
                    fontSize: "13px",
                    fontFamily: "Open Sans"
                }
            }
        },
        fill: {
            opacity: [1, .8]
        },
        stroke: {
            show: !1,
            width: 0
        },
        markers: {
            size: 0
        },
        grid: {
            show: !1,
            padding: {
                top: 0,
                bottom: -20
            }
        }
    };

// Graficos de rosca

    if (null !== n) {
        const u = new ApexCharts(n, c);
        u.render()
    }

    const numeros = JSON.parse(document.querySelector("#donutChart").getAttribute("data-series"));
    const texto = JSON.parse(document.querySelector("#donutChart").getAttribute("data-labels"));

    const numerosOk = numeros.map(Number);
    const quantidadeSeries = numerosOk.length;

    n = document.querySelector("#donutChart"), c = {
        chart: {
            height: 385,
            type: "donut",
            toolbar: {
                show: 1
            },
        },
        labels: texto,
        series: numerosOk,
        stroke: {
            show: !0,
            curve: "straight"
        },
        dataLabels: {
            enabled: !0,
            formatter: function(e, o) {
                return parseInt(e) + "%"
            }
        },
        legend: {
            show: !0,
            position: "bottom",
            labels: {
                colors: "#aab3bf",
                useSeriesColors: !0
            }
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: !0,
                        name: {
                            fontSize: "2rem",
                            color: s,
                            fontFamily: "Public Sans"
                        },
                        value: {
                            fontSize: "1.2rem",
                            color: s,
                            fontFamily: "Public Sans",
                            formatter: function(e) {
                                return parseInt(e) + " APR"
                            }
                        },
                        total: {
                            show: !0,
                            fontSize: "15",
                            color: o,
                            label: "APR",
                            formatter: function(e) {
                                return quantidadeSeries + " APR's"
                            }
                        }
                    }
                }
            }
        },
        responsive: [{
            breakpoint: 992,
            options: {
                chart: {
                    height: 380
                },
                legend: {
                    position: "bottom",
                    labels: {
                        colors: "#aab3bf",
                        useSeriesColors: !1
                    }
                }
            }
        }, {
            breakpoint: 576,
            options: {
                chart: {
                    height: 320
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: !0,
                                name: {
                                    fontSize: "1.5rem"
                                },
                                value: {
                                    fontSize: "1rem"
                                },
                                total: {
                                    fontSize: "1.5rem"
                                }
                            }
                        }
                    }
                },
                legend: {
                    position: "bottom",
                    labels: {
                        colors: "#aab3bf",
                        useSeriesColors: !1
                    }
                }
            }
        }, {
            breakpoint: 420,
            options: {
                chart: {
                    height: 280
                },
                legend: {
                    show: !1
                }
            }
        }, {
            breakpoint: 360,
            options: {
                chart: {
                    height: 250
                },
                legend: {
                    show: !1
                }
            }
        }]
    };
    if (null !== n) {
        const w = new ApexCharts(n, c);
        w.render()
    }
}();