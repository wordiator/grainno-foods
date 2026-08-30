/*
 * First-touch marketing attribution.
 *
 * The Paystack hosted Payment Page (paystack.shop/pay/...) drops every
 * query param we send it, so utm_source / utm_campaign / click ids never
 * reach the server on their own — the sale row ends up with no source.
 *
 * This captures them from the very first grainnofoods.com URL a visitor
 * lands on and stores them in a cookie scoped to `.grainnofoods.com`, so
 * it is also readable by the app on bodyrecomp.grainnofoods.com. There,
 * PaymentSuccess forwards it into /api/checkout/complete alongside the
 * _fbc/_fbp cookies it already sends, and the sale is written with its
 * real source. First touch wins — a later untagged pageview never
 * overwrites the original attribution.
 */
(function () {
  try {
    var KEY = 'gbt_attribution';
    if (document.cookie.indexOf(KEY + '=') !== -1) return; // first touch already recorded

    var qs = new URLSearchParams(window.location.search);
    var data = {};
    var got = false;

    ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'].forEach(function (k) {
      var v = qs.get(k);
      if (v) { data[k] = v.slice(0, 120); got = true; }
    });
    var fbclid = qs.get('fbclid');
    if (fbclid) { data.fbclid = fbclid.slice(0, 255); got = true; }
    var ttclid = qs.get('ttclid');
    if (ttclid) { data.ttclid = ttclid.slice(0, 255); got = true; }

    if (!got) return;

    data.t = Date.now();
    data.lp = window.location.pathname.slice(0, 255);

    var secure = window.location.protocol === 'https:' ? ';secure' : '';
    document.cookie =
      KEY + '=' + encodeURIComponent(JSON.stringify(data)) +
      ';path=/;max-age=' + (60 * 60 * 24 * 90) +
      ';domain=.grainnofoods.com;samesite=lax' + secure;
  } catch (e) {
    /* attribution must never break a page */
  }
})();
