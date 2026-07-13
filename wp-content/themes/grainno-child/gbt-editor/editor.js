(function(){
  'use strict';
  if (typeof gbtEditor === 'undefined') return;

  var HIDDEN = '__hidden__';
  var editing = false;
  var snapshot = {};   /* key -> innerHTML at edit start */
  var hiddenState = {};/* key -> bool at edit start + live */

  var editables = function(){ return document.querySelectorAll('[data-gbt-key]'); };

  /* ---------- toolbar ---------- */
  var bar = document.createElement('div');
  bar.className = 'gbt-toolbar';
  bar.innerHTML =
    '<button type="button" class="gbt-tb-btn gbt-tb-edit">&#9998; Edit page</button>' +
    '<button type="button" class="gbt-tb-btn gbt-tb-adcheck" title="Scan the page for text that can get flagged by Facebook/Meta ad review">&#9873; Ad check</button>' +
    '<span class="gbt-tb-group" hidden>' +
      '<button type="button" class="gbt-tb-btn gbt-tb-save">Save</button>' +
      '<button type="button" class="gbt-tb-btn gbt-tb-cancel">Cancel</button>' +
      '<button type="button" class="gbt-tb-btn gbt-tb-reset" title="Remove every saved change on this page and go back to the built-in copy">Reset all</button>' +
    '</span>' +
    '<span class="gbt-tb-msg" aria-live="polite"></span>';
  document.body.appendChild(bar);

  var btnEdit   = bar.querySelector('.gbt-tb-edit');
  var btnAd     = bar.querySelector('.gbt-tb-adcheck');
  var group     = bar.querySelector('.gbt-tb-group');
  var btnSave   = bar.querySelector('.gbt-tb-save');
  var btnCancel = bar.querySelector('.gbt-tb-cancel');
  var btnReset  = bar.querySelector('.gbt-tb-reset');
  var msg       = bar.querySelector('.gbt-tb-msg');

  function setMsg(text, ok){
    msg.innerHTML = text || '';
    msg.className = 'gbt-tb-msg' + (ok === false ? ' err' : '');
  }

  /* ================================================================
     META (FACEBOOK) AD-POLICY RISK SCANNER
     Patterns derived from Meta's Personal Health & Appearance,
     misleading-claims, and restricted-categories policies.
     ================================================================ */
  var AD_RULES = [
    /* --- HIGH: likely rejection triggers --- */
    { re:/couldn'?t even look (at yourself|up)?\s?(in the mirror)?/i, level:3,
      why:'Negative self-perception — the #1 trigger under Meta’s Personal Health & Appearance policy' },
    { re:/\b(pills?|syrups?|apetamin)\b/i, level:3,
      why:'Mentions ingestible products — trips Meta’s supplement/drug classifiers even when you’re AGAINST them' },
    { re:/before\/?\s?after|before[- ]and[- ]after/i, level:3,
      why:'Before/after imagery is banned outright in Meta health & fitness ads' },
    { re:/heartburn|dr(y|ied|ies) you up/i, level:3,
      why:'Physical side-effect claims about products' },
    { re:/belly fat|flat(ter)? stomach|lose (the )?belly/i, level:3,
      why:'Spot-reduction / weight-loss claim — restricted ad category' },

    /* --- MEDIUM: risky, may pass or fail depending on reviewer --- */
    { re:/\bcertified\b/i, level:2,
      why:'Credential claim — must be literally provable or it’s a misleading-claims violation (account-level risk)' },
    { re:/\b(bumbum|bum|butt|hips|waist)\b/i, level:2,
      why:'Specific body-part focus — flagged under Personal Health & Appearance' },
    { re:/\b(7|seven)[- ]days?\b/i, level:2,
      why:'Results-timeframe reference — reads as an unrealistic-results signal to classifiers' },
    { re:/get snatched|snatch(ed)? (the )?waist/i, level:2,
      why:'“Ideal body” slang framing — body-image trigger' },

    /* --- LOW: mild, fix if convenient --- */
    { re:/\byou (didn'?t fail|don'?t lack)\b|you'?ve spent more|you'?ve been disappointed/i, level:1,
      why:'Second-person personal-attribute assertion (“you” + implied history/trait)' },
    { re:/shapewear|too skinny/i, level:1,
      why:'Body-image-sensitive phrasing' }
  ];
  var LEVEL_NAME  = {3:'HIGH', 2:'MEDIUM', 1:'LOW'};
  var LEVEL_CLASS = {3:'gbt-flag-high', 2:'gbt-flag-med', 1:'gbt-flag-low'};

  var adLayer = null;
  var adActive = false;

  function clearAdFlags(){
    adActive = false;
    btnAd.classList.remove('on');
    if (adLayer) { adLayer.remove(); adLayer = null; }
    editables().forEach(function(el){
      el.classList.remove('gbt-flag-high','gbt-flag-med','gbt-flag-low');
    });
  }

  function runAdCheck(){
    clearAdFlags();
    adActive = true;
    btnAd.classList.add('on');

    adLayer = document.createElement('div');
    adLayer.className = 'gbt-flags-layer';
    document.body.appendChild(adLayer);

    var counts = {3:0, 2:0, 1:0};

    editables().forEach(function(el){
      if (el.dataset.gbtHidden === '1') return; /* hidden = won't ship, skip */
      var text = el.textContent || '';
      var hits = [];
      AD_RULES.forEach(function(rule){
        var m = text.match(rule.re);
        if (m) hits.push({ term: m[0].trim(), level: rule.level, why: rule.why });
      });
      if (!hits.length) return;

      hits.sort(function(a,b){ return b.level - a.level; });
      var top = hits[0].level;
      counts[top]++;
      el.classList.add(LEVEL_CLASS[top]);

      var label = document.createElement('div');
      label.className = 'gbt-flag-label ' + LEVEL_CLASS[top];
      label.innerHTML = hits.map(function(h){
        return '<strong>' + LEVEL_NAME[h.level] + ' · “' + escapeHtml(h.term) + '”</strong> ' + escapeHtml(h.why);
      }).join('<br>');
      adLayer.appendChild(label);
      positionLabel(label, el);
    });

    var total = counts[3] + counts[2] + counts[1];
    if (total === 0) {
      setMsg('&#9873; No ad-policy triggers found. Nice.');
    } else {
      setMsg('&#9873; <b>' + counts[3] + ' high</b> · ' + counts[2] + ' medium · ' + counts[1] +
             ' low. Hover a flag for details. Edit the text, then re-run the check.');
    }
  }

  function positionLabel(label, el){
    var r = el.getBoundingClientRect();
    label.style.top  = (r.top + window.scrollY - 8) + 'px';
    label.style.left = Math.max(8, r.left + window.scrollX) + 'px';
    label.style.maxWidth = Math.max(260, r.width) + 'px';
  }

  function escapeHtml(s){
    return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
  }

  window.addEventListener('resize', function(){
    if (adActive) runAdCheck();
  });

  btnAd.addEventListener('click', function(){
    if (adActive) { clearAdFlags(); setMsg(''); }
    else { runAdCheck(); }
  });

  /* ---------- edit mode ---------- */
  function enterEdit(){
    editing = true;
    document.body.classList.add('gbt-editing');
    /* pressing Enter should insert <br>, not wrap lines in <div> blocks */
    try { document.execCommand('defaultParagraphSeparator', false, 'br'); } catch(e) {}
    btnEdit.hidden = true;
    group.hidden = false;
    if (!adActive) setMsg('Click any text to edit it. Placeholders have a Hide button.');

    editables().forEach(function(el){
      var key = el.dataset.gbtKey;
      snapshot[key] = el.innerHTML;
      hiddenState[key] = el.dataset.gbtHidden === '1';

      if (el.dataset.gbtHideable === '1') {
        if (hiddenState[key]) { el.style.display = ''; el.classList.add('gbt-ghost'); }
        addHideBtn(el);
      } else {
        el.setAttribute('contenteditable', 'true');
        el.setAttribute('spellcheck', 'false');
      }
    });

    document.addEventListener('click', interceptClicks, true);
  }

  function exitEdit(restore){
    editing = false;
    document.body.classList.remove('gbt-editing');
    btnEdit.hidden = false;
    group.hidden = true;
    setMsg('');

    editables().forEach(function(el){
      var key = el.dataset.gbtKey;
      el.removeAttribute('contenteditable');
      el.removeAttribute('spellcheck');
      el.classList.remove('gbt-ghost');
      var hb = el.querySelector(':scope > .gbt-hide-btn');
      if (hb) hb.remove();
      if (restore) {
        el.innerHTML = snapshot[key];
        el.dataset.gbtHidden = hiddenState[key] ? '1' : '';
        el.style.display = hiddenState[key] ? 'none' : '';
      }
    });
    document.removeEventListener('click', interceptClicks, true);
    if (adActive) runAdCheck(); /* re-scan against final text */
  }

  function interceptClicks(e){
    if (!editing) return;
    if (e.target.closest('.gbt-toolbar') || e.target.closest('.gbt-hide-btn')) return;
    var a = e.target.closest('a, button');
    if (a && !a.closest('.gbt-toolbar')) {
      e.preventDefault();
      e.stopPropagation();
      var ed = e.target.closest('[contenteditable="true"]');
      if (ed) ed.focus();
    }
  }

  /* ---------- hide/restore placeholders ---------- */
  function addHideBtn(el){
    if (getComputedStyle(el).position === 'static') el.style.position = 'relative';
    var b = document.createElement('button');
    b.type = 'button';
    b.className = 'gbt-hide-btn';
    syncHideBtn(b, el);
    b.addEventListener('click', function(ev){
      ev.preventDefault();
      ev.stopPropagation();
      var nowHidden = el.dataset.gbtHidden !== '1';
      el.dataset.gbtHidden = nowHidden ? '1' : '';
      el.classList.toggle('gbt-ghost', nowHidden);
      syncHideBtn(b, el);
    });
    el.appendChild(b);
  }
  function syncHideBtn(b, el){
    var hidden = el.dataset.gbtHidden === '1';
    b.textContent = hidden ? 'Restore' : 'Hide';
    b.classList.toggle('is-hidden', hidden);
  }

  /* ---------- save ---------- */
  /* contenteditable likes to wrap new lines in <div>s, which is invalid inside
     <p>/<h1> and breaks styling — normalise them to <br> before saving */
  function cleanHtml(html){
    return html
      .replace(/<div><br\s*\/?><\/div>/gi, '<br>')
      .replace(/<div>/gi, '<br>')
      .replace(/<\/div>/gi, '')
      .replace(/^(<br\s*\/?>)+/i, '');
  }

  function collectChanges(){
    var changes = {};
    editables().forEach(function(el){
      var key = el.dataset.gbtKey;
      var isHidden = el.dataset.gbtHidden === '1';
      if (el.dataset.gbtHideable === '1') {
        if (isHidden !== hiddenState[key]) changes[key] = isHidden ? HIDDEN : null;
        return;
      }
      var html = el.innerHTML.trim();
      if (html !== snapshot[key].trim()) changes[key] = cleanHtml(html);
    });
    return changes;
  }

  function post(action, extra){
    var data = new FormData();
    data.append('action', action);
    data.append('nonce', gbtEditor.nonce);
    data.append('post_id', gbtEditor.postId);
    Object.keys(extra || {}).forEach(function(k){ data.append(k, extra[k]); });
    return fetch(gbtEditor.ajaxUrl, { method: 'POST', credentials: 'same-origin', body: data })
      .then(function(r){ return r.json(); });
  }

  btnEdit.addEventListener('click', enterEdit);
  btnCancel.addEventListener('click', function(){ exitEdit(true); });

  btnSave.addEventListener('click', function(){
    var changes = collectChanges();
    if (!Object.keys(changes).length) { exitEdit(false); setMsg('No changes.'); return; }
    setMsg('Saving…');
    post('gbt_save_content', { changes: JSON.stringify(changes) }).then(function(res){
      if (res && res.success) { window.location.reload(); }
      else { setMsg('Save failed — try again.', false); }
    }).catch(function(){ setMsg('Save failed — network error.', false); });
  });

  btnReset.addEventListener('click', function(){
    if (!window.confirm('Remove ALL saved edits on this page and restore the built-in copy?')) return;
    setMsg('Resetting…');
    post('gbt_reset_content').then(function(res){
      if (res && res.success) { window.location.reload(); }
      else { setMsg('Reset failed.', false); }
    }).catch(function(){ setMsg('Reset failed — network error.', false); });
  });
})();
