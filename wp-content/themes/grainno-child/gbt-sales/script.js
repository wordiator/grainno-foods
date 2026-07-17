(function(){
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* reveal on scroll */
  var reveals = document.querySelectorAll('.gbt-sales .reveal');
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

  /* count-up on proof numbers */
  var counters = document.querySelectorAll('.gbt-sales .proof-num[data-count]');
  function runCount(el){
    var target = parseInt(el.dataset.count, 10);
    var suffix = el.dataset.suffix || '';
    var start = null;
    var dur = 900;
    function tick(ts){
      if(!start) start = ts;
      var p = Math.min((ts - start) / dur, 1);
      el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3))) + suffix;
      if(p < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }
  if(!reduceMotion && 'IntersectionObserver' in window){
    var cio = new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if(e.isIntersecting){ runCount(e.target); cio.unobserve(e.target); }
      });
    }, {threshold:0.5});
    counters.forEach(function(el){ cio.observe(el); });
  } else {
    counters.forEach(function(el){ el.textContent = el.dataset.count + (el.dataset.suffix || ''); });
  }

  /* FAQ accordion */
  document.querySelectorAll('.gbt-sales .faq-item').forEach(function(item){
    var btn = item.querySelector('button');
    btn.addEventListener('click', function(){
      var isOpen = item.getAttribute('data-open') === 'true';
      item.parentElement.querySelectorAll('.faq-item').forEach(function(i){ i.setAttribute('data-open','false'); });
      item.setAttribute('data-open', isOpen ? 'false' : 'true');
    });
  });

  /* sticky mobile CTA — appears once the hero CTA scrolls out of view */
  var sticky = document.getElementById('gbtStickyCta');
  var heroCta = document.getElementById('gbtHeroCta');
  if(sticky && heroCta && 'IntersectionObserver' in window){
    var sio = new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        sticky.classList.toggle('show', !e.isIntersecting);
      });
    }, {threshold:0});
    sio.observe(heroCta);
  }
})();
