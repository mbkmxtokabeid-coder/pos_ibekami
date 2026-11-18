(function () {
  function initLaporanTabTransition() {
    var switcher = document.querySelector('.ibk-tab-switch');
    if (!switcher) return;
    var glider = switcher.querySelector('.ibk-tab-glider');
    var activeLink = switcher.querySelector('.ibk-tab-link.is-active');
    var stage = document.getElementById('ibkTabStage');
    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function positionGlider(target, animate) {
      if (!glider || !target) return;
      if (animate && !prefersReduced) {
        glider.classList.add('is-animated');
      } else {
        glider.classList.remove('is-animated');
      }
      glider.style.width = target.offsetWidth + 'px';
      glider.style.transform = 'translateX(' + target.offsetLeft + 'px)';
      glider.style.opacity = '1';
    }

    switcher.classList.add('has-glider');

    var prevRect = null;
    var wasLeaving = false;
    try {
      var raw = sessionStorage.getItem('ibk_laporan_tab_rect');
      if (raw) prevRect = JSON.parse(raw);
      wasLeaving = sessionStorage.getItem('ibk_laporan_tab_leaving') === '1';
      sessionStorage.removeItem('ibk_laporan_tab_rect');
      sessionStorage.removeItem('ibk_laporan_tab_leaving');
    } catch (e) {}

    if (prevRect && glider && activeLink && !prefersReduced) {
      glider.classList.remove('is-animated');
      glider.style.width = prevRect.width + 'px';
      glider.style.transform = 'translateX(' + prevRect.left + 'px)';
      glider.style.opacity = '1';
      requestAnimationFrame(function () {
        requestAnimationFrame(function () {
          positionGlider(activeLink, true);
          if (stage) stage.classList.remove('is-entering');
        });
      });
    } else {
      positionGlider(activeLink, false);
      if (stage && wasLeaving) {
        requestAnimationFrame(function () {
          stage.classList.remove('is-entering');
        });
      } else if (stage) {
        stage.classList.remove('is-entering');
      }
    }

    window.addEventListener('resize', function () {
      var currentActive = switcher.querySelector('.ibk-tab-link.is-active');
      positionGlider(currentActive, false);
    });

    switcher.querySelectorAll('.ibk-tab-link').forEach(function (link) {
      link.addEventListener('click', function (e) {
        if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey || e.button !== 0) return;
        if (link.classList.contains('is-active')) {
          e.preventDefault();
          return;
        }
        e.preventDefault();
        var targetUrl = link.getAttribute('href');
        var currentActive = switcher.querySelector('.ibk-tab-link.is-active');

        try {
          if (currentActive) {
            sessionStorage.setItem('ibk_laporan_tab_rect', JSON.stringify({
              left: currentActive.offsetLeft,
              width: currentActive.offsetWidth
            }));
          }
          sessionStorage.setItem('ibk_laporan_tab_leaving', '1');
        } catch (err) {}

        if (prefersReduced) {
          window.location.href = targetUrl;
          return;
        }

        if (currentActive) currentActive.classList.remove('is-active');
        link.classList.add('is-active');
        positionGlider(link, true);

        var pageStage = document.getElementById('ibkPageStage');
        if (pageStage) {
          pageStage.classList.remove('is-entering', 'is-entering-active');
          pageStage.classList.add('is-leaving');
        } else if (stage) {
          stage.classList.add('is-leaving');
        }

        setTimeout(function () {
          window.location.href = targetUrl;
        }, 270);
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initLaporanTabTransition);
  } else {
    initLaporanTabTransition();
  }
})();
