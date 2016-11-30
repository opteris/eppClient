$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2013',
            coffee: 2666,
            maize: null,
            beans: 2647
        }, {
            period: '2014',
            coffee: 2778,
            maize: 2294,
            beans: 2441
        }, {
            period: '2015',
            coffee: 4912,
            maize: 1969,
            beans: 2501
        }, {
            period: '2016',
            coffee: 3767,
            maize: 3597,
            beans: 5689
        }, {
            period: '2017',
            coffee: 6810,
            maize: 1914,
            beans: 2293
        }, {
            period: '2018',
            coffee: 5670,
            maize: 4293,
            beans: 1881
        }],
        xkey: 'period',
        ykeys: ['coffee', 'maize', 'beans'],
        labels: ['Coffee', 'Maize', 'Beans'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Coffee",
            value: 12
        }, {
            label: "Beans",
            value: 30
        }, {
            label: "Maize",
            value: 20
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 100,
            b: 90
        }, {
            y: '2007',
            a: 75,
            b: 65
        }, {
            y: '2008',
            a: 50,
            b: 40
        }, {
            y: '2009',
            a: 75,
            b: 65
        }, {
            y: '2010',
            a: 50,
            b: 40
        }, {
            y: '2011',
            a: 75,
            b: 65
        }, {
            y: '2012',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });

});
