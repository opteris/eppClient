<!--indicator staffReporting_graph-->

<?php
foreach ($get_all_monthly_effort_in_hours as $rTotal) {
    $total = ($rTotal->loeMonthTotal);
}
?>
<!--start graph-staffReporting-->
<script type="text/javascript">
    $(function () {
        $('#staffReporting').highcharts({
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                }
            },
            title: {
                text: null
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                type: 'pie',
                name: 'Percentage LOE',
                data: [

                    {
                        <?php
                        foreach ($get_highest_monthly_single_user_loe as $rHighest) {
                        $highestName = $rHighest->fullNames;
                        $higestValue = $rHighest->loeMonth;

                            if($higestValue<=0){
                            continue;
                            }
                            $percentage=(((($higestValue)/($total))*100));
                            $higestValue=round($percentage,2);

                        }
                        ?>

                        name: '<?=$highestName;?>',
                        y: <?=$higestValue;?>,
                        sliced: true,
                        selected: true
                    },
                    <?php

                        foreach ($get_all_users_loe_without_highest as $rAll) {
                            $reportedDays=$rAll->loeMonthOthers;
                            if($reportedDays<=0){
                            continue;
                            }
                            $percentage=(((($reportedDays)/($total))*100));
                            $percentage=round($percentage,2);
                            $userName=$rAll->fullNames;

                           $userArray=array("['".$userName."',   ".$percentage."],");

                        $length = count($userArray);
                        for ($i = 0; $i < $length; $i++) {
                        echo $userArray[$i];
                        }
                        }//End of retrieving all but the highest percentage portions for the

                    ?>

                ]
            }]
        });
    });
</script>
<!--start graph-staffReporting-->

<!--start graph-annual LOE-->
<script type="text/javascript">
    $(function () {
        $('#annualLoe').highcharts({
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 15,
                    beta: 15
                }
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'nta, GDS-Regular, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'LoE (Hrs)'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'LOE : <b>{point.y:,.1f} Hours</b>'
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'LoE',
                data: [
                    <?php
                        foreach ($get_loe_foreach_month as $rLoe) {
                    ?>

                    ['JAN', <?=$rLoe->HoursJan;?>],
                    ['FEB', <?=$rLoe->HoursFeb;?>],
                    ['MAR', <?=$rLoe->HoursMar;?>],
                    ['APR', <?=$rLoe->HoursApr;?>],
                    ['MAY', <?=$rLoe->HoursMay;?>],
                    ['JUN', <?=$rLoe->HoursJun;?>],
                    ['JUL', <?=$rLoe->HoursJul;?>],
                    ['AUG', <?=$rLoe->HoursAug;?>],
                    ['SEP', <?=$rLoe->HoursSep;?>],
                    ['OCT', <?=$rLoe->HoursOct;?>],
                    ['NOV', <?=$rLoe->HoursNov;?>],
                    ['DEC', <?=$rLoe->HoursDec;?>]

                    <?php
                        }
                    ?>


                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: -10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'nta, GDS-Regular, sans-serif'
                    }
                }
            }]
        });
    });
</script>
<!--start graph-annual LOE-->

<!--start graph-lowest LOE-->
<script type="text/javascript">
    $(function () {
        Highcharts.setOptions({
            lang: {
                thousandsSep: ','
            }
        });
        $('#topFiveCostlyProjects').highcharts({
            chart: {
                type: 'bar',
                options3d: {
                    enabled: true,
                    alpha: 15,
                    beta: 15
                }
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    <?php
                        foreach ($get_five_profitable_projects as $rProfitable) {

                    $n=1;
                    echo "'".$rProfitable->projectName."',";
                    $n++;
                            }
                    ?>


                ],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Cost (Shillings)',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Project Cost UGX',

                data: [
                    <?php
                        foreach ($get_five_profitable_projects as $rProfitableCost) {

                    $n=1;
                    echo "".$rProfitableCost->projectCost.",";
                    $n++;
                            }
                    ?>
                ]
            },  {
                name: 'LoE in Hrs',
                data: [
                    <?php
                        foreach ($get_five_profitable_projects as $rProfitableLoe) {
                    $n=1;
                    echo "".$rProfitableLoe->loeInHours.",";
                    $n++;
                            }
                    ?>
                ]

            }]
        });
    });
</script>
<!--start graph-lowest LOE-->

<!--start graph highest loe-->
<script type="text/javascript">
    $(function () {
        Highcharts.setOptions({
            lang: {
                thousandsSep: ','
            }
        });
        // Create the chart
        $('#topFiveProfitableProjects').highcharts({
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 15,
                    beta: 15
                }
            },
            title: {
                text: ''
            },
            subtitle: {
                text: 'Click bar to drill down'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'nta, GDS-Regular, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Project Cost',
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:,.0f} UGX'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:,.0f} UGX</b> of total<br/>'
            },
            credits: {
                enabled: false
            },

            series: [{
                name: "Projects",
                colorByPoint: true,
                data: [<?php
							foreach ($get_five_costly_projects as $rCostlyName) {
						$n=1;
						echo '{
						name: "'.substr($rCostlyName->projectName, 0, 30).'...",
						y: '.$rCostlyName->projectCost.',
						drilldown: "'.$rCostlyName->projectName.'"
						},';
						$n++;
								}
						?>

                    {
                        name: "Prj_6 Undefined",
                        y: 0.2,
                        drilldown: null
                    }]
            }],

            drilldown: {
                series: [{
                    name: "Prj_1",
                    id: "Prj_1",
                    data: [
                        [
                            "v11.0",
                            24.13
                        ],
                        [
                            "v8.0",
                            17.2
                        ],
                        [
                            "v9.0",
                            8.11
                        ],
                        [
                            "v10.0",
                            5.33
                        ],
                        [
                            "v6.0",
                            1.06
                        ],
                        [
                            "v7.0",
                            0.5
                        ]
                    ]
                }, {
                    name: "Prj_2",
                    id: "Prj_2",
                    data: [
                        [
                            "v40.0",
                            5
                        ],
                        [
                            "v41.0",
                            4.32
                        ],
                        [
                            "v42.0",
                            3.68
                        ],
                        [
                            "v39.0",
                            2.96
                        ],
                        [
                            "v36.0",
                            2.53
                        ],
                        [
                            "v43.0",
                            1.45
                        ],
                        [
                            "v31.0",
                            1.24
                        ],
                        [
                            "v35.0",
                            0.85
                        ],
                        [
                            "v38.0",
                            0.6
                        ],
                        [
                            "v32.0",
                            0.55
                        ],
                        [
                            "v37.0",
                            0.38
                        ],
                        [
                            "v33.0",
                            0.19
                        ],
                        [
                            "v34.0",
                            0.14
                        ],
                        [
                            "v30.0",
                            0.14
                        ]
                    ]
                }, {
                    name: "Prj_3",
                    id: "Prj_3",
                    data: [
                        [
                            "v35",
                            2.76
                        ],
                        [
                            "v36",
                            2.32
                        ],
                        [
                            "v37",
                            2.31
                        ],
                        [
                            "v34",
                            1.27
                        ],
                        [
                            "v38",
                            1.02
                        ],
                        [
                            "v31",
                            0.33
                        ],
                        [
                            "v33",
                            0.22
                        ],
                        [
                            "v32",
                            0.15
                        ]
                    ]
                }, {
                    name: "Prj_4",
                    id: "Prj_4",
                    data: [
                        [
                            "v8.0",
                            2.56
                        ],
                        [
                            "v7.1",
                            0.77
                        ],
                        [
                            "v5.1",
                            0.42
                        ],
                        [
                            "v5.0",
                            0.3
                        ],
                        [
                            "v6.1",
                            0.29
                        ],
                        [
                            "v7.0",
                            0.26
                        ],
                        [
                            "v6.2",
                            0.17
                        ]
                    ]
                }, {
                    name: "Prj_5",
                    id: "Prj_5",
                    data: [
                        [
                            "v12.x",
                            0.34
                        ],
                        [
                            "v28",
                            0.24
                        ],
                        [
                            "v27",
                            0.17
                        ],
                        [
                            "v29",
                            0.16
                        ]
                    ]
                }]
            }
        });
    });
</script>

<!--end graph highest loe-->

<script>
    $(function () {

        $('#salesGraph').highcharts({
            chart: {
                type: 'funnel',
                marginRight: 100
            },
            title: {
                text: 'Sales funnel',
                x: -50
            },
            plotOptions: {
                series: {
                    dataLabels: {
                        rotation: 45,
                        enabled: true,
                        format: '<b>{point.name}</b> ({point.y:,.0f})',
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                        softConnector: true
                    },
                    neckWidth: '30%',
                    neckHeight: '25%'

//-- Other available options
// height: pixels or percent
// width: pixels or percent
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Unique users',
                data: [
                    ['Website visits', 15654],
                    ['Downloads', 4064],
                    ['Requested price list', 1987],
                    ['Invoice sent', 976],
                    ['Finalized', 846]
                ]
            }]
        });
    });
</script>