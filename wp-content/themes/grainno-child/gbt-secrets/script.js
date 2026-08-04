(function(){
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* reveal on scroll */
  var reveals = document.querySelectorAll('.gbt-secrets .reveal');
  if(!reduceMotion && 'IntersectionObserver' in window){
    var io = new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if(e.isIntersecting){ e.target.classList.add('in'); io.unobserve(e.target); }
      });
    }, {threshold:0.12});
    reveals.forEach(function(el){ io.observe(el); });
  } else {
    reveals.forEach(function(el){ el.classList.add('in'); });
  }

  /* FAQ accordion */
  document.querySelectorAll('.gbt-secrets .faq-item').forEach(function(item){
    var btn = item.querySelector('button');
    btn.addEventListener('click', function(){
      var isOpen = item.getAttribute('data-open') === 'true';
      item.parentElement.querySelectorAll('.faq-item').forEach(function(i){ i.setAttribute('data-open','false'); });
      item.setAttribute('data-open', isOpen ? 'false' : 'true');
    });
  });

  /* countdowns — each persists in localStorage per visitor so a page reload
     doesn't reset the deadline (same pattern as the gbt-sales promo timer) */
  function startCountdown(clockEl, storeKey, durationMs, onExpire){
    if(!clockEl) return;
    var endsAt = parseInt(localStorage.getItem(storeKey), 10);
    if(!endsAt || isNaN(endsAt)){
      endsAt = Date.now() + durationMs;
      localStorage.setItem(storeKey, String(endsAt));
    }
    function pad(n){ return String(n).padStart(2, '0'); }
    function render(){
      var remaining = endsAt - Date.now();
      if(remaining <= 0){
        clockEl.textContent = '00:00:00';
        if(onExpire) onExpire();
        clearInterval(interval);
        return;
      }
      var totalSecs = Math.floor(remaining / 1000);
      var h = Math.floor(totalSecs / 3600);
      var m = Math.floor((totalSecs % 3600) / 60);
      var s = totalSecs % 60;
      clockEl.textContent = pad(h) + ':' + pad(m) + ':' + pad(s);
    }
    render();
    var interval = setInterval(render, 1000);
  }

  var topbar = document.getElementById('gbtSecretsTopbar');
  startCountdown(document.getElementById('gbtSecretsTopClock'), 'gbtSecretsOfferEndsAt', 2 * 60 * 60 * 1000, function(){
    if(topbar) topbar.classList.add('expired');
  });
  startCountdown(document.getElementById('gbtSecretsStackClock'), 'gbtSecretsOfferEndsAt', 2 * 60 * 60 * 1000);

  /* sticky CTA — appears once the hero CTA scrolls out of view */
  var sticky = document.getElementById('gbtSecretsStickyCta');
  var heroCta = document.getElementById('gbtSecretsHeroCta');
  if(sticky && heroCta && 'IntersectionObserver' in window){
    var sio = new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        sticky.classList.toggle('show', !e.isIntersecting);
      });
    }, {threshold:0});
    sio.observe(heroCta);
  }
})();
