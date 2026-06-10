(function ($) {
  'use strict';

  $(function () {

    /* =========================
     * PRO BANNER CLOSE
     * ========================= */
    const bannerClose = document.querySelector('#bannerClose');
    const proBanner = document.querySelector('#proBanner');

    if (bannerClose && proBanner) {
      bannerClose.addEventListener('click', function () {
        proBanner.classList.add('d-none');
      });
    }

    /* =========================
     * CIRCLE PROGRESS 6
     * ========================= */
    if ($('#circleProgress6').length && typeof ProgressBar !== 'undefined') {

      var bar6 = new ProgressBar.Circle(circleProgress6, {
        color: '#001737',
        strokeWidth: 10,
        trailWidth: 10,
        easing: 'easeInOut',
        duration: 1400,
        text: { autoStyleContainer: false },
        from: { color: '#aaa', width: 10 },
        to: { color: '#2617c9', width: 10 },
        step: function (state, circle) {
          circle.path.setAttribute('stroke', state.color);
          circle.path.setAttribute('stroke-width', state.width);

          var value = '<p class="text-center mb-0">Score</p>' +
            Math.round(circle.value() * 100) + "%";

          circle.setText(value);
        }
      });

      bar6.text.style.fontSize = '1.875rem';
      bar6.text.style.fontWeight = '700';
      bar6.animate(.75);
    }

    /* =========================
     * CIRCLE PROGRESS 7
     * ========================= */
    if ($('#circleProgress7').length && typeof ProgressBar !== 'undefined') {

      var bar7 = new ProgressBar.Circle(circleProgress7, {
        color: '#9c9fa6',
        strokeWidth: 10,
        trailWidth: 10,
        easing: 'easeInOut',
        trailColor: '#1f2130',
        duration: 1400,
        text: { autoStyleContainer: false },
        from: { color: '#aaa', width: 10 },
        to: { color: '#2617c9', width: 10 },
        step: function (state, circle) {
          circle.path.setAttribute('stroke', state.color);
          circle.path.setAttribute('stroke-width', state.width);

          var value = '<p class="text-center mb-0">Score</p>' +
            Math.round(circle.value() * 100) + "%";

          circle.setText(value);
        }
      });

      bar7.text.style.fontSize = '1.875rem';
      bar7.text.style.fontWeight = '700';
      bar7.animate(.75);
    }

    /* =========================
     * EVENT CHART
     * ========================= */
    if ($("#eventChart").length && typeof Chart !== 'undefined') {

      var ctx1 = $("#eventChart").get(0).getContext("2d");

      new Chart(ctx1, {
        type: 'line',
        data: {
          labels: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
          datasets: [{
            label: 'Critical',
            data: [20,35,15,45,35,40,25,44,20,30,38,15],
            borderColor: 'rgba(255,131,0)',
            backgroundColor: 'rgba(255,131,0,0.1)',
            borderWidth: 1,
            fill: true
          }]
        },
        options: {
          legend: { display: false },
          scales: {
            yAxes: [{ display: false }],
            xAxes: [{ display: false }]
          }
        }
      });
    }

    /* =========================
     * SALES ANALYTIC CHART
     * ========================= */
    if ($("#salesanalyticChart").length && typeof Chart !== 'undefined') {

      var ctx2 = $("#salesanalyticChart").get(0).getContext("2d");

      new Chart(ctx2, {
        type: 'line',
        data: {
          labels: ["Feb","Mar","Apr","May","Jun","Jul","Aug"],
          datasets: [{
            label: 'Critical',
            data: [24,23,22,24,26,23,28],
            borderColor: '#3022cb',
            borderWidth: 3,
            fill: false
          }]
        },
        options: {
          legend: { display: false }
        }
      });
    }

    /* =========================
     * SAFETY: GLOBAL GUARD END
     * ========================= */

  });

})(jQuery);