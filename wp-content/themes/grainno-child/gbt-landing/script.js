(function(){
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var burger = document.getElementById('burger');
  var mobileNav = document.getElementById('mobileNav');
  if (burger && mobileNav) {
    burger.addEventListener('click', function(){
      var open = mobileNav.classList.toggle('open');
      burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    mobileNav.querySelectorAll('a').forEach(function(a){
      a.addEventListener('click', function(){
        mobileNav.classList.remove('open');
        burger.setAttribute('aria-expanded', 'false');
      });
    });
  }

  if(!reduceMotion && 'IntersectionObserver' in window){
    var io = new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if(e.isIntersecting){ e.target.classList.add('in'); io.unobserve(e.target); }
      });
    }, {threshold:0.12});
    document.querySelectorAll('.gbt-page .reveal').forEach(function(el){ io.observe(el); });
  } else {
    document.querySelectorAll('.gbt-page .reveal').forEach(function(el){ el.classList.add('in'); });
  }

  var prepData = {
    boiled:  {kcal:118, protein:'2.1g', carbs:'27g', fat:'0.2g'},
    roasted: {kcal:155, protein:'2.3g', carbs:'33g', fat:'0.3g'},
    grilled: {kcal:170, protein:'2.4g', carbs:'30g', fat:'3g'},
    fried:   {kcal:260, protein:'2.6g', carbs:'32g', fat:'13g'}
  };
  var prepBtns = document.querySelectorAll('.prep-btn');
  var kcalEl = document.getElementById('calcKcal');
  var proteinEl = document.getElementById('calcProtein');
  var carbsEl = document.getElementById('calcCarbs');
  var fatEl = document.getElementById('calcFat');
  prepBtns.forEach(function(btn){
    btn.addEventListener('click', function(){
      prepBtns.forEach(function(b){ b.setAttribute('aria-pressed','false'); });
      btn.setAttribute('aria-pressed','true');
      var d = prepData[btn.dataset.prep];
      kcalEl.textContent = d.kcal;
      proteinEl.textContent = d.protein;
      carbsEl.textContent = d.carbs;
      fatEl.textContent = d.fat;
    });
  });

  function wireAccordion(selector, itemSelector){
    document.querySelectorAll(selector + ' ' + itemSelector).forEach(function(item){
      var btn = item.querySelector('button');
      btn.addEventListener('click', function(){
        var isOpen = item.getAttribute('data-open') === 'true';
        item.parentElement.querySelectorAll(itemSelector).forEach(function(i){ i.setAttribute('data-open','false'); });
        item.setAttribute('data-open', isOpen ? 'false' : 'true');
      });
    });
  }
  wireAccordion('.myth-list', '.myth-item');
  wireAccordion('.faq-list', '.faq-item');
})();
