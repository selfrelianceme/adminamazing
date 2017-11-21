/*
Template Name: Monster Admin
Author: Themedesigner
Email: niravjoshi87@gmail.com
File: js
*/
$(document).ready(function () {
    "use strict";
    // ============================================================== 
    // Total revenue chart
    // ============================================================== 
    new Chartist.Line('.total-revenue', {
        labels: ['0', '4', '8', '12', '16', '20']
        , series: [
        [4, 2, 3.5, 1.5, 4, 3]
        , [2, 4, 2, 4, 2, 4]
      ]
    }, {
        high: 5
        , low: 1
        , fullWidth: true
        , plugins: [
        Chartist.plugins.tooltip()
      ]
        , // As this is axis specific we need to tell Chartist to use whole numbers only on the concerned axis
        axisY: {
            onlyInteger: true
            , offset: 20
            , labelInterpolationFnc: function (value) {
                return (value / 1) + 'k';
            }
        }
    });
});